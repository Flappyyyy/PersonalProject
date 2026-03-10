<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $currentMonth = $request->get('month', date('F'));
        $currentYear = date('Y'); // simplify to current year
        $search = $request->get('search');

        $clients = \App\Models\Client::whereHas('payments', function ($query) use ($currentMonth, $currentYear) {
            $query->where('month', $currentMonth)
                ->where('year', $currentYear);
        })->with(['payments' => function ($query) use ($currentMonth, $currentYear) {
            $query->where('month', $currentMonth)
                ->where('year', $currentYear);
        }])
            ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Calculate statuses
        foreach ($clients as $client) {
            $payment = $client->payments->first();
            $client->payment_for_month = $payment;

            if (!$payment) {
                // No payment record yet = Unpaid (default amounts will be 0)
                $client->payment_status = 'Unpaid';
                $client->day_15_amount = 0;
                $client->day_30_amount = 0;
            }
            else {
                $client->day_15_amount = $payment->day_15_amount;
                $client->day_30_amount = $payment->day_30_amount;

                $expectedHalf = $client->payment_amount / 2;

                $is15Paid = $client->day_15_amount >= $expectedHalf;
                $is30Paid = $client->day_30_amount >= $expectedHalf;

                if ($is15Paid && $is30Paid) {
                    $client->payment_status = 'Paid';
                }
                elseif ($is15Paid || $is30Paid) {
                    $client->payment_status = 'Partially Paid';
                }
                elseif ($client->day_15_amount > 0 || $client->day_30_amount > 0) {
                    $client->payment_status = 'Partially Paid';
                }
                else {
                    $client->payment_status = 'Unpaid';
                }
            }
        }

        return view('dashboard.index', compact('clients', 'months', 'currentMonth', 'search'));
    }
}
