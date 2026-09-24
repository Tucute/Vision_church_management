@props([
    'href',
    'title',
    'meta' => null,
    'description' => null,
    'footer' => null,
])

<a
    href="{{ $href }}"
    {{ $attributes->class(['ui-card-interactive p-6']) }}
>
    @if ($meta)
        <p class="ui-eyebrow mb-3">{{ $meta }}</p>
    @endif

    <h3 class="ui-h4">{{ $title }}</h3>

    @if ($description)
        <p class="ui-small mt-2 line-clamp-3">{{ $description }}</p>
    @endif

    @if ($footer)
        <p class="ui-caption mt-4 text-primary">{{ $footer }}</p>
    @endif

    @isset($status)
        <div class="mt-3">
            {{ $status }}
        </div>
    @endisset
</a>
