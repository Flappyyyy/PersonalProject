@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Clients History</h1>
    <p class="text-sm text-gray-500 mt-1">View the history of clients, how many months they've paid, and their total payments.</p>
</div>

<!-- Clients History Table -->
<div class="bg-white border rounded-lg shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                <tr>
                    <th scope="col" class="px-6 py-3">Client Name</th>
                    <th scope="col" class="px-6 py-3">Item/Benefit</th>
                    <th scope="col" class="px-6 py-3">Start Month</th>
                    <th scope="col" class="px-6 py-3">Target Duration (Months)</th>
                    <th scope="col" class="px-6 py-3">Months Paid</th>
                    <th scope="col" class="px-6 py-3">Total Amount Paid</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $client->name }}</td>
                        <td class="px-6 py-4">{{ $client->item }}</td>
                        <td class="px-6 py-4">{{ $client->start_month }}</td>
                        <td class="px-6 py-4">{{ $client->months_to_pay }} Months</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-blue-800 bg-blue-200 rounded-full">
                                {{ $client->months_paid_count }} / {{ $client->months_to_pay }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-green-600">
                            ₱ {{ number_format($client->total_paid, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No clients found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
