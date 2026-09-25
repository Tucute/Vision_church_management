@props([
    'churchInfo',
    'tone' => 'default',
])

@php
    $name = $churchInfo->name;
    $textClass = $tone === 'inverse' ? 'text-on-inverse hover:text-on-inverse' : 'text-primary hover:text-primary-dark';
    $markClass = $tone === 'inverse' ? 'bg-on-primary text-primary' : 'bg-primary text-on-primary';
@endphp

<a
    href="{{ route('home') }}"
    {{ $attributes->class(['inline-flex min-w-0 items-center gap-3 font-display text-lg font-bold leading-tight tracking-tight transition duration-150 ease-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary', $textClass]) }}
>
    <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-md shadow-sm {{ $markClass }}" aria-hidden="true">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round">
            <path d="M12 4v16M7 8h10" />
            <path d="M6 20h12" />
        </svg>
    </span>
    <span class="min-w-0 truncate">{{ $name }}</span>
</a>
