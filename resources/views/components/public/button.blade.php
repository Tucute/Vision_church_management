@props([
    'variant' => 'primary',
    'size' => 'default',
    'href' => null,
    'type' => 'button',
    'block' => false,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 font-sans text-sm font-semibold tracking-[0.01em] transition duration-200 ease-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 disabled:pointer-events-none';

    $sizes = [
        'default' => 'h-11 px-5 rounded-md',
        'compact' => 'h-9 px-4 rounded-md',
    ];

    $variants = [
        'primary' => 'bg-primary text-on-primary shadow-sm hover:bg-primary-dark hover:shadow-md active:bg-primary-dark focus-visible:outline-primary disabled:bg-primary-disabled disabled:text-on-primary-disabled disabled:shadow-none',
        'secondary' => 'bg-surface text-primary border border-border shadow-sm hover:bg-surface-alt hover:border-border-hover hover:shadow-md active:bg-primary-light focus-visible:outline-primary disabled:bg-background disabled:text-muted disabled:shadow-none',
        'ghost' => 'bg-transparent text-primary hover:bg-primary-light active:bg-ghost-active focus-visible:outline-primary disabled:text-primary-disabled',
        'destructive' => 'bg-error text-on-primary shadow-sm hover:bg-error-hover hover:shadow-md focus-visible:outline-error disabled:bg-error-disabled disabled:shadow-none',
        'link' => 'h-auto px-0 rounded-sm bg-transparent text-primary hover:underline active:text-primary-dark focus-visible:outline-primary disabled:text-muted disabled:no-underline',
        'text' => 'h-auto px-0 rounded-sm bg-transparent text-primary hover:underline active:text-primary-dark focus-visible:outline-primary disabled:text-muted disabled:no-underline',
    ];

    $classes = [
        $base,
        $sizes[$size] ?? $sizes['default'],
        $variants[$variant] ?? $variants['primary'],
        $block ? 'w-full' : '',
    ];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif
