@props([
    'churchInfo',
    'tone' => 'default',
])

@php
    $name = $churchInfo->name;
    $textClass = $tone === 'inverse' ? 'text-on-inverse hover:text-on-inverse' : 'text-primary hover:text-primary-dark';
@endphp

<a
    href="{{ route('home') }}"
    {{ $attributes->class(['inline-flex min-w-0 flex-1 items-center font-display text-lg font-bold leading-tight tracking-tight transition duration-150 ease-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary lg:flex-none', $textClass]) }}
>
    {{ $name }}
</a>
