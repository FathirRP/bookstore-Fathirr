{{-- Komponen tombol, bisa dipake berulang --}}
@props(['type' => 'submit', 'variant' => 'primary'])

@php
    $classes = match($variant) {
        'primary' => 'bg-emerald-700 text-white hover:bg-emerald-800 focus:ring-emerald-500',
        'secondary' => 'bg-stone-200 text-stone-700 hover:bg-stone-300 focus:ring-stone-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'success' => 'bg-emerald-600 text-white hover:bg-emerald-700 focus:ring-emerald-500',
        default => 'bg-emerald-700 text-white hover:bg-emerald-800 focus:ring-emerald-500',
    };
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "px-4 py-2 rounded-lg font-medium text-sm transition focus:outline-none focus:ring-2 focus:ring-offset-2 $classes"]) }}>
    {{ $slot }}
</button>
