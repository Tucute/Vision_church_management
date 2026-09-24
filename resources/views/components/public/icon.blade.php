@props([
    'name' => 'menu',
    'size' => 'sm',
    'decorative' => true,
])

@php
    $sizes = [
        'sm' => 'h-4 w-4',
        'md' => 'h-5 w-5',
        'lg' => 'h-6 w-6',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['sm'];
@endphp

<svg
    {{ $attributes->class([$sizeClass, 'shrink-0']) }}
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="1.75"
    stroke-linecap="round"
    stroke-linejoin="round"
    @if ($decorative) aria-hidden="true" @endif
>
    @switch($name)
        @case('menu')
            <path d="M4 7h16M4 12h16M4 17h16" />
            @break
        @case('close')
            <path d="M6 6l12 12M18 6L6 18" />
            @break
        @case('arrow-right')
            <path d="M5 12h14M13 6l6 6-6 6" />
            @break
        @case('arrow-left')
            <path d="M19 12H5M11 6l-6 6 6 6" />
            @break
        @default
            <circle cx="12" cy="12" r="3" />
    @endswitch
</svg>
