@props([
    'type' => 'button',
    'color' => 'primary',
    'class' => ''
])

@php
    $baseClasses = 'text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors focus:ring-4 focus:outline-none';
    
    $colorClasses = match($color) {
        'primary' => 'bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 focus:ring-pink-300 shadow-md shadow-pink-200/50 transform hover:-translate-y-0.5 transition-all text-white',
        'secondary' => 'text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-gray-200',
        'danger' => 'bg-red-500 hover:bg-red-600 focus:ring-red-300 text-white',
        'success' => 'bg-green-500 hover:bg-green-600 focus:ring-green-300 text-white',
        default => 'bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 focus:ring-pink-300 shadow-md shadow-pink-200/50 transform hover:-translate-y-0.5 transition-all text-white',
    };
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClasses $colorClasses $class"]) }}>
    {{ $slot }}
</button>
