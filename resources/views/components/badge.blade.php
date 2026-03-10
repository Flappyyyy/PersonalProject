@props(['status'])

@php
    $baseClasses = 'text-xs font-medium px-2.5 py-0.5 rounded border';
    
    $statusClasses = match(strtolower($status)) {
        'paid' => 'bg-green-100 text-green-800 border-green-400',
        'partially paid' => 'bg-yellow-100 text-yellow-800 border-yellow-400',
        'unpaid' => 'bg-red-100 text-red-800 border-red-400',
        default => 'bg-gray-100 text-gray-800 border-gray-400',
    };
@endphp

<span class="{{ $baseClasses }} {{ $statusClasses }}">
    {{ $status }}
</span>
