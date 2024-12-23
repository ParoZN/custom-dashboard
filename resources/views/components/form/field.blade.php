@props(['field'])

@php
    logger()->info("Rendering field: {$field['name']}", [
        'field' => $field,
        'value' => data_get($field, 'value')
    ]);
@endphp

<div class="space-y-1">
    @if($field['type'] !== 'checkbox')
        <label for="{{ $field['name'] }}" class="block text-sm font-medium text-gray-700">
            {{ $field['label'] }}
            @if($field['required'])
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    @switch($field['type'])
        @case('select')
            <select 
                id="{{ $field['name'] }}"
                wire:model.live="data.{{ $field['name'] }}"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#4d5bf9] focus:border-[#4d5bf9] sm:text-sm rounded-md {{ $field['class'] }}"
                {{ $field['required'] ? 'required' : '' }}>
                <option value="">{{ $field['placeholder'] }}</option>
                @foreach($field['options'] as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            @break

        @case('textarea')
            <textarea
                id="{{ $field['name'] }}"
                wire:model.live="data.{{ $field['name'] }}"
                rows="{{ $field['rows'] }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#4d5bf9] focus:border-[#4d5bf9] sm:text-sm {{ $field['class'] }}"
                placeholder="{{ $field['placeholder'] }}"
                {{ $field['required'] ? 'required' : '' }}></textarea>
            @break

        @case('checkbox')
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="{{ $field['name'] }}"
                    wire:model.live="data.{{ $field['name'] }}"
                    class="h-4 w-4 text-[#4d5bf9] focus:ring-[#4d5bf9] border-gray-300 rounded {{ $field['class'] }}"
                    {{ $field['checked'] ? 'checked' : '' }}
                    {{ $field['required'] ? 'required' : '' }}>
                <label for="{{ $field['name'] }}" class="ml-2 block text-sm text-gray-700">
                    {{ $field['label'] }}
                    @if($field['required'])
                        <span class="text-red-500">*</span>
                    @endif
                </label>
            </div>
            @break

        @case('file')
            <input
                type="{{ $field['type'] }}"
                id="{{ $field['name'] }}"
                wire:model="data.{{ $field['name'] }}"
                accept="{{ $field['accept'] }}"
                {{ $field['multiple'] ? 'multiple' : '' }}
                class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-[#4d5bf9] focus:border-[#4d5bf9] border-gray-300 rounded-md {{ $field['class'] }}"
                {{ $field['required'] ? 'required' : '' }}>
            @break

        @default
            <input
                type="{{ $field['type'] }}"
                id="{{ $field['name'] }}"
                wire:model.live="data.{{ $field['name'] }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#4d5bf9] focus:border-[#4d5bf9] sm:text-sm {{ $field['class'] }}"
                placeholder="{{ $field['placeholder'] }}"
                {{ $field['required'] ? 'required' : '' }}>
    @endswitch

    @if($field['help'])
        <p class="mt-1 text-sm text-gray-500">{{ $field['help'] }}</p>
    @endif

    @error("data.{$field['name']}")
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
