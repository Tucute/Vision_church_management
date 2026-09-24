@props([
    'title',
    'meta' => null,
    'href' => null,
])

@php
    $classes = 'flex items-center justify-between gap-4 rounded-lg border border-border bg-surface px-4 py-3 shadow-sm transition duration-200 ease-out';
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->class([$classes, 'hover:-translate-y-0.5 hover:border-primary hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary']) }}
    >
        <span class="font-medium text-primary">{{ $title }}</span>
        @if ($meta)
            <span class="ui-caption text-muted">{{ $meta }}</span>
        @endif
    </a>
@else
    <div {{ $attributes->class([$classes]) }}>
        <span class="font-medium text-primary">{{ $title }}</span>
        @if ($meta)
            <span class="ui-caption text-muted">{{ $meta }}</span>
        @endif
    </div>
@endif
