@props([
    'title' => null,
    'eyebrow' => null,
    'padding' => true,
])

<div
    {{ $attributes->class([
        'ui-card',
        'p-6 sm:p-8' => $padding,
    ]) }}
>
    @if ($eyebrow)
        <p class="ui-eyebrow mb-2">{{ $eyebrow }}</p>
    @endif

    @if ($title)
        <h3 class="ui-h3 mb-3">{{ $title }}</h3>
    @endif

    {{ $slot }}
</div>
