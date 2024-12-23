@props(['active' => false, 'as' => 'a'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-2 px-4 py-2 bg-white text-[#4d5bf9] rounded-lg transition-colors'
            : 'flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/10 rounded-lg transition-colors';

if ($as === 'button') {
    $classes = 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
}
@endphp

@if($as === 'button')
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@else
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@endif
