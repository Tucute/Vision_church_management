@props([
    'title',
    'body',
    'actionLabel',
    'actionUrl',
])

<section
    class="ui-cta-pattern relative overflow-hidden border-y border-border bg-gradient-to-br from-accent-soft via-surface to-primary-light ui-section"
    aria-labelledby="cta-band-heading"
>
    <div class="pointer-events-none absolute -right-20 top-0 h-64 w-64 rounded-full bg-accent/15 blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-16 bottom-0 h-48 w-48 rounded-full bg-primary/10 blur-3xl" aria-hidden="true"></div>

    <x-public.container width="reading" class="relative z-10 text-center">
        <x-public.reveal>
            <p class="ui-eyebrow mb-3">Kết nối</p>
            <h2 id="cta-band-heading" class="ui-h2">
                {{ $title }}
            </h2>
            <p class="ui-muted mx-auto mt-3 max-w-xl">
                {{ $body }}
            </p>
            <div class="mt-8">
                <x-public.button variant="primary" :href="$actionUrl">
                    {{ $actionLabel }}
                    <x-public.icon name="arrow-right" />
                </x-public.button>
            </div>
        </x-public.reveal>
    </x-public.container>
</section>
