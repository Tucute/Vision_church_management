@props([
    'delay' => null,
])

@php
    $delayClass = match ($delay) {
        '1' => 'delay-100',
        '2' => 'delay-200',
        '3' => 'delay-300',
        default => '',
    };
@endphp

<div {{ $attributes->class(['ui-reveal', $delayClass]) }}>
    {{ $slot }}
</div>
