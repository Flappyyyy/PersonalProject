@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Manage paluwagan clients and track their payments.</p>
    </div>
    <x-button onclick="document.getElementById('addClientModal').classList.remove('hidden')">
        <svg class="w-4 h-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Add Client
    </x-button>
</div>

<!-- Filters -->
<div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl shadow-sm shadow-pink-100/50 border border-pink-100 mb-6 font-medium relative z-10">
    <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-pink-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="search" name="search" value="{{ $search }}" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-pink-200 rounded-xl bg-white/60 focus:ring-pink-400 focus:border-pink-400 shadow-sm" placeholder="Search client name...">
            </div>
        </div>
        <div class="sm:w-48">
            <select name="month" onchange="this.form.submit()" class="bg-white/60 border border-pink-200 text-gray-900 text-sm rounded-xl focus:ring-pink-400 focus:border-pink-400 block w-full p-2.5 shadow-sm">
                @foreach($months as $month)
                    <option value="{{ $month }}" {{ $currentMonth == $month ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

@if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 tracking-wide" role="alert">
        {{ session('success') }}
    </div>
@endif

<!-- Clients Table -->
<div class="bg-white/70 backdrop-blur-md border border-pink-100 rounded-2xl shadow-md shadow-pink-100/40 overflow-hidden relative z-10">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-pink-900 uppercase bg-pink-50/50 border-b border-pink-100">
                <tr>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Client Name</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Item</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Month</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">15-Day Payment</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">30-Day Payment</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Status</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-100/50">
                @forelse($clients as $client)
                    <tr class="hover:bg-pink-50/30 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $client->created_at->format('M j Y') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $client->name }}</td>
                        <td class="px-6 py-4">{{ $client->item }}</td>
                        <td class="px-6 py-4">{{ $currentMonth }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('payments.update', $client->id) }}" method="POST" class="payment-form flex items-center space-x-2" data-client-id="{{ $client->id }}">
                                @csrf
                                <input type="hidden" name="month" value="{{ $currentMonth }}">
                                <input type="hidden" name="year" value="{{ date('Y') }}">
                                <input type="hidden" name="day_30_amount" value="{{ $client->day_30_amount }}">
                                
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <span class="text-pink-400 sm:text-sm">₱</span>
                                    </div>
                                    <input type="number" name="day_15_amount" value="{{ $client->day_15_amount }}" 
                                        class="block w-24 pl-7 p-1.5 text-sm text-gray-900 border border-pink-200 bg-white/80 rounded-lg focus:ring-pink-400 focus:border-pink-400 shadow-sm transition-all focus:scale-105">
                                </div>
                                <button type="submit" class="text-pink-500 hover:text-pink-700 hover:scale-110 transform transition-all" title="Save">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('payments.update', $client->id) }}" method="POST" class="payment-form flex items-center space-x-2" data-client-id="{{ $client->id }}">
                                @csrf
                                <input type="hidden" name="month" value="{{ $currentMonth }}">
                                <input type="hidden" name="year" value="{{ date('Y') }}">
                                <input type="hidden" name="day_15_amount" value="{{ $client->day_15_amount }}">
                                
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <span class="text-pink-400 sm:text-sm">₱</span>
                                    </div>
                                    <input type="number" name="day_30_amount" value="{{ $client->day_30_amount }}" 
                                        class="block w-24 pl-7 p-1.5 text-sm text-gray-900 border border-pink-200 bg-white/80 rounded-lg focus:ring-pink-400 focus:border-pink-400 shadow-sm transition-all focus:scale-105">
                                </div>
                                <button type="submit" class="text-pink-500 hover:text-pink-700 hover:scale-110 transform transition-all" title="Save">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center" id="status-cell-{{ $client->id }}">
                            <x-badge :status="$client->payment_status" />
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center space-x-2">
                            <button type="button" onclick="document.getElementById('editClientModal-{{ $client->id }}').classList.remove('hidden')" class="text-pink-500 hover:text-pink-800 bg-pink-50 hover:bg-pink-100 p-1.5 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-800 bg-red-50 hover:bg-red-100 p-1.5 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>

                            <x-modal id="editClientModal-{{ $client->id }}" title="Edit Client: {{ $client->name }}">
                                <form action="{{ route('clients.update', $client->id) }}" method="POST" class="text-left">
                                    @csrf
                                    @method('PUT')
                                    
                                    <x-input name="name" label="Client Name" value="{{ $client->name }}" required="true" />
                                    <x-input name="item" label="Item/Benefit" value="{{ $client->item }}" required="true" />
                                    
                                    <div class="mb-4">
                                        <label for="start_month_{{ $client->id }}" class="block mb-2 text-sm font-medium text-gray-900">Starting Month</label>
                                        <select name="start_month" id="start_month_{{ $client->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                            @foreach($months as $month)
                                                <option value="{{ $month }}" {{ $client->start_month == $month ? 'selected' : '' }}>{{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <x-input type="number" name="payment_amount" label="Monthly Payment (Total)" value="{{ $client->payment_amount }}" required="true" />
                                        <x-input type="number" name="months_to_pay" label="Months to Pay" value="{{ $client->months_to_pay }}" required="true" />
                                    </div>
                                    
                                    <div class="flex justify-end gap-3 mt-6 border-t pt-4">
                                        <button type="button" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5" onclick="document.getElementById('editClientModal-{{ $client->id }}').classList.add('hidden')">Cancel</button>
                                        <x-button type="submit">Update Client</x-button>
                                    </div>
                                </form>
                            </x-modal>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                            No clients found. Click "Add Client" to get started.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($clients->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $clients->links() }}
        </div>
    @endif
</div>

<!-- Add Client Modal -->
<x-modal id="addClientModal" title="Add New Client">
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        
        <x-input name="name" label="Client Name" placeholder="e.g. Juan Dela Cruz" required="true" />
        <x-input name="item" label="Item/Benefit" placeholder="e.g. iPhone 13 Pro" required="true" />
        
        <div class="mb-4">
            <label for="start_month" class="block mb-2 text-sm font-medium text-gray-900">Starting Month</label>
            <select name="start_month" id="start_month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @foreach($months as $month)
                    <option value="{{ $month }}" {{ $currentMonth == $month ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <x-input type="number" name="payment_amount" label="Monthly Payment (Total)" placeholder="4000" required="true" />
            <x-input type="number" name="months_to_pay" label="Months to Pay" placeholder="5" required="true" />
        </div>
        
        <div class="flex items-center bg-blue-50 p-4 mb-4 text-sm text-blue-800 border border-blue-200 rounded-lg">
             <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
             <p>Note: The total payment will be split in half (15th and 30th schedules).</p>
        </div>

        <div class="flex justify-end gap-3 mt-6 border-t pt-4">
            <button type="button" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5" onclick="document.getElementById('addClientModal').classList.add('hidden')">Cancel</button>
            <x-button type="submit">Save Client</x-button>
        </div>
    </form>
</x-modal>

<!-- AJAX Payment Submission Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.payment-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                let formData = new FormData(this);
                let actionUrl = this.getAttribute('action');
                let clientId = this.dataset.clientId;
                let btn = this.querySelector('button[type="submit"]');
                let icon = btn.querySelector('svg');
                let originalIcon = icon.innerHTML;
                
                // Spinner
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>';
                icon.classList.add('animate-spin');
                
                fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    icon.classList.remove('animate-spin');
                    icon.innerHTML = originalIcon;
                    
                    if (data.success) {
                        // Show a quick visual cue on the button
                        btn.classList.add('text-green-600');
                        setTimeout(() => btn.classList.remove('text-green-600'), 1500);

                        // Update all other forms for this client to have the correct hidden values
                        // So they don't overwrite each other if edited back-to-back
                        let day15Val = formData.get('day_15_amount') || document.querySelector(`form.payment-form[data-client-id="${clientId}"] input[name="day_15_amount"]`).value;
                        let day30Val = formData.get('day_30_amount') || document.querySelector(`form.payment-form[data-client-id="${clientId}"] input[name="day_30_amount"]`).value;

                        document.querySelectorAll(`form.payment-form[data-client-id="${clientId}"]`).forEach(siblingForm => {
                            let h15 = siblingForm.querySelector('input[type="hidden"][name="day_15_amount"]');
                            if (h15) h15.value = day15Val;
                            
                            let h30 = siblingForm.querySelector('input[type="hidden"][name="day_30_amount"]');
                            if (h30) h30.value = day30Val;
                        });

                        // Update status badge
                        let statusCell = document.getElementById('status-cell-' + clientId);
                        if (statusCell) {
                            let badgeClass = '';
                            if (data.status === 'Paid') {
                                badgeClass = 'bg-green-100 text-green-800 border-green-200';
                            } else if (data.status === 'Partially Paid') {
                                badgeClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                            } else {
                                badgeClass = 'bg-red-100 text-red-800 border-red-200';
                            }
                            statusCell.innerHTML = `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border ${badgeClass}">
                                ${data.status}
                            </span>`;
                        }
                    }
                })
                .catch(err => {
                    icon.classList.remove('animate-spin');
                    icon.innerHTML = originalIcon;
                    alert('An error occurred automatically updating the status.');
                });
            });
        });
    });
</script>

@endsection
