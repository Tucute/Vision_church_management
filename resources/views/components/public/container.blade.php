@props([
    'width' => 'content',
])

@php
    $widths = [
        'content' => 'max-w-content',
        'reading' => 'max-w-reading',
        'narrow' => 'max-w-narrow',
        'wide' => 'max-w-wide',
        'full' => 'max-w-none',
    ];
@endphp

<div {{ $attributes->class([$widths[$width] ?? $widths['content'], 'mx-auto w-full px-4 sm:px-6 lg:px-8 xl:px-10']) }}>
    {{ $slot }}
</div>
