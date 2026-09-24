@props([
    'tone' => 'info',
])

@php
    $tones = [
        'success' => ['bg-success-soft text-success border-success/25 shadow-sm', 'status'],
        'info' => ['bg-info-soft text-info border-info/25 shadow-sm', 'status'],
        'warning' => ['bg-warning-soft text-warning border-warning/25 shadow-sm', 'alert'],
        'danger' => ['bg-error-soft text-error border-error/25 shadow-sm', 'alert'],
        'error' => ['bg-error-soft text-error border-error/25 shadow-sm', 'alert'],
    ];
    [$classes, $role] = $tones[$tone] ?? $tones['info'];
@endphp

<div
    role="{{ $role }}"
    {{ $attributes->class(['rounded-lg border px-4 py-3 text-sm', $classes]) }}
>
    {{ $slot }}
</div>
