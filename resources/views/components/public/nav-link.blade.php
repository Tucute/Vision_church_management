@props([
    'href',
    'label',
    'active' => false,
    'tone' => 'default',
])

@php
    $base = 'font-sans text-sm transition duration-150 ease-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary';

    if ($tone === 'inverse') {
        $state = $active
            ? 'font-semibold text-on-inverse'
            : 'font-medium text-on-inverse-muted hover:text-on-inverse';
    } else {
        $state = $active
            ? 'font-semibold text-primary'
            : 'font-medium text-secondary hover:text-primary';
    }
@endphp

<a
    href="{{ $href }}"
    @if ($active) aria-current="page" @endif
    {{ $attributes->class([$base, $state]) }}
>
    {{ $label }}
</a>
