@props([
    'tone' => 'neutral',
    'label' => null,
])

@php
    $tones = [
        'neutral' => 'bg-surface-alt text-muted border border-border',
        'brand' => 'bg-primary-light text-primary border border-primary/15',
        'primary' => 'bg-primary-light text-primary border border-primary/15',
        'accent' => 'bg-accent-soft text-accent border border-accent/20',
        'success' => 'bg-success-soft text-success border border-success/20',
        'warning' => 'bg-warning-soft text-warning border border-warning/20',
        'danger' => 'bg-error-soft text-error border border-error/20',
        'error' => 'bg-error-soft text-error border border-error/20',
        'info' => 'bg-info-soft text-info border border-info/20',
    ];
@endphp

<span {{ $attributes->class(['inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium shadow-sm', $tones[$tone] ?? $tones['neutral']]) }}>
    {{ $label ?? $slot }}
</span>
