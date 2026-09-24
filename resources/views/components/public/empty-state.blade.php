@props([
    'title',
    'body' => null,
    'actionLabel' => null,
    'actionUrl' => null,
])

<div {{ $attributes->class(['ui-card mx-auto max-w-md p-8 text-center shadow-md']) }}>
    <h2 class="ui-h4">{{ $title }}</h2>

    @if ($body)
        <p class="ui-small mt-2">{{ $body }}</p>
    @endif

    @if ($actionLabel && $actionUrl)
        <div class="mt-6">
            <x-public.button variant="secondary" :href="$actionUrl">
                {{ $actionLabel }}
            </x-public.button>
        </div>
    @endif
</div>
