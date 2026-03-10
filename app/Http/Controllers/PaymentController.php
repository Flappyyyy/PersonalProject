<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function update(Request $request, $client_id)
    {
        $validated = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
            'day_15_amount' => 'required|numeric|min:0',
            'day_30_amount' => 'required|numeric|min:0',
        ]);

        $payment = \App\Models\Payment::updateOrCreate(
        [
            'client_id' => $client_id,
            'month' => $validated['month'],
            'year' => $validated['year'],
        ],
        [
            'day_15_amount' => $validated['day_15_amount'],
            'day_30_amount' => $validated['day_30_amount'],
        ]
        );

        if ($request->ajax() || $request->wantsJson()) {
            $client = \App\Models\Client::find($client_id);
            $expectedHalf = $client->payment_amount / 2;

            $is15Paid = $payment->day_15_amount >= $expectedHalf;
            $is30Paid = $payment->day_30_amount >= $expectedHalf;

            if ($is15Paid && $is30Paid) {
                $status = 'Paid';
            }
            elseif ($is15Paid || $is30Paid || $payment->day_15_amount > 0 || $payment->day_30_amount > 0) {
                $status = 'Partially Paid';
            }
            else {
                $status = 'Unpaid';
            }

            return response()->json([
                'success' => true,
                'status' => $status
            ]);
        }

        return redirect()->back()->with('success', 'Payment updated successfully.');
    }
}
