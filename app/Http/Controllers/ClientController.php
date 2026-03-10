<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = \App\Models\Client::with('payments')->get();

        foreach ($clients as $client) {
            $totalPaid = 0;
            $monthsPaidCount = 0;

            foreach ($client->payments as $payment) {
                $monthPayment = $payment->day_15_amount + $payment->day_30_amount;
                $totalPaid += $monthPayment;

                // If they paid anything for this month, count it.
                // Or you can strictly require them to pay the full monthly amount
                if ($monthPayment >= $client->payment_amount) {
                    $monthsPaidCount++;
                }
                elseif ($monthPayment > 0) {
                // Count as partial month conceptually or just leave it based on full payments
                // We'll count completed months
                }
            }

            $client->total_paid = $totalPaid;
            $client->months_paid_count = $monthsPaidCount;
        }

        return view('clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'item' => 'required|string|max:255',
            'payment_amount' => 'required|numeric|min:0',
            'months_to_pay' => 'required|integer|min:1',
            'start_month' => 'required|string',
        ]);

        $client = \App\Models\Client::create($validated);

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        $startIndex = array_search($validated['start_month'], $months);
        $currentYear = date('Y');

        for ($i = 0; $i < $validated['months_to_pay']; $i++) {
            $monthIndex = ($startIndex + $i) % 12;
            $yearOffset = floor(($startIndex + $i) / 12);

            \App\Models\Payment::create([
                'client_id' => $client->id,
                'month' => $months[$monthIndex],
                'year' => $currentYear + $yearOffset,
                'day_15_amount' => 0,
                'day_30_amount' => 0,
            ]);
        }

        return redirect()->route('dashboard', ['month' => $validated['start_month']])->with('success', 'Client added successfully.');
    }

    public function update(Request $request, $client_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'item' => 'required|string|max:255',
            'payment_amount' => 'required|numeric|min:0',
            'months_to_pay' => 'required|integer|min:1',
            'start_month' => 'required|string',
        ]);

        $client = \App\Models\Client::findOrFail($client_id);

        // Check if months_to_pay or start_month changed to recreate payments if needed.
        // For simplicity, we just update the client info here.
        // Proper recreation of payments logic could be added if scope allows.
        $client->update($validated);

        return redirect()->back()->with('success', 'Client updated successfully.');
    }

    public function destroy($client_id)
    {
        $client = \App\Models\Client::findOrFail($client_id);
        $client->delete();

        return redirect()->back()->with('success', 'Client deleted successfully.');
    }
}
