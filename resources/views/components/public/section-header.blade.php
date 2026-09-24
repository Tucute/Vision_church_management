@props([
    'title',
    'actionLabel' => null,
    'actionUrl' => null,
    'headingId' => null,
])

<div {{ $attributes->class(['mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between']) }}>
    <h2
        @if ($headingId) id="{{ $headingId }}" @endif
        class="ui-h2"
    >
        {{ $title }}
    </h2>

    @if ($actionLabel && $actionUrl)
        <x-public.button variant="link" :href="$actionUrl" class="shrink-0 self-start sm:self-auto">
            {{ $actionLabel }}
            <x-public.icon name="arrow-right" />
        </x-public.button>
    @endif
</div>
