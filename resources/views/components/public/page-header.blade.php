@props([
    'title',
    'lead' => null,
    'backHref' => null,
    'backLabel' => null,
])

<header {{ $attributes->class(['mb-8 sm:mb-10']) }}>
    @if ($backHref && $backLabel)
        <x-public.button variant="link" :href="$backHref" class="mb-4">
            <x-public.icon name="arrow-left" />
            {{ $backLabel }}
        </x-public.button>
    @endif

    <h1 class="ui-h1">{{ $title }}</h1>

    @if ($lead)
        <p class="ui-muted mt-3 max-w-2xl">{{ $lead }}</p>
    @endif
</header>
