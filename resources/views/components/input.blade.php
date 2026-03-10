@props(['type' => 'text', 'name', 'id' => null, 'label' => '', 'value' => '', 'required' => false])

<div class="mb-4">
    @if($label)
        <label for="{{ $id ?? $name }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" 
           name="{{ $name }}" 
           id="{{ $id ?? $name }}" 
           value="{{ old($name, $value) }}"
           {{ $required ? 'required' : '' }}
           {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']) }}>
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
