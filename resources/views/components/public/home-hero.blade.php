@props([
    'churchInfo',
])

{{-- Brand-first hero: church name as H1. Full-bleed gradient + CSS 3D orbs. --}}
<section
    class="relative overflow-hidden border-b border-border bg-gradient-to-br from-primary via-primary to-primary-dark text-on-primary"
    aria-labelledby="home-hero-heading"
>
    <div class="ui-hero-stage pointer-events-none absolute inset-0" aria-hidden="true">
        <div class="ui-float-3d absolute -left-16 top-8 h-64 w-64 rounded-full bg-accent/45 blur-2xl"></div>
        <div class="ui-float-3d ui-float-3d-delay absolute -right-10 top-16 h-80 w-80 rounded-full bg-on-primary/20 blur-3xl"></div>
        <div class="ui-float-3d ui-float-3d-delay-2 absolute bottom-0 left-1/3 h-56 w-56 rounded-full bg-accent/35 blur-2xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_transparent_15%,_rgb(10_28_58_/_0.35)_100%)]"></div>
    </div>

    <x-public.container width="wide" class="relative z-10 py-20 text-center sm:py-24 lg:py-32">
        <p class="ui-hero-fade font-sans text-xs font-semibold uppercase tracking-[0.12em] text-accent">
            Chào mừng bạn
        </p>

        <h1 id="home-hero-heading" class="ui-hero-title ui-hero-fade-delay mt-4 font-display font-bold tracking-[-0.03em] text-on-primary">
            {{ $churchInfo->name }}
        </h1>

        <p class="ui-hero-fade-delay-2 mx-auto mt-4 max-w-2xl text-body text-on-primary/85">
            Chào mừng bạn đến với ngôi nhà Ân Điển.
        </p>

        @if ($churchInfo->mission)
            <p class="ui-hero-fade-delay-2 mx-auto mt-3 max-w-xl text-sm leading-relaxed text-on-inverse-muted">
                {{ $churchInfo->mission }}
            </p>
        @endif

        <div class="ui-hero-fade-delay-3 mt-10 flex flex-col items-stretch justify-center gap-3 sm:flex-row sm:items-center sm:gap-4">
            <x-public.button variant="secondary" :href="route('im-new')" class="border-transparent bg-on-primary text-primary shadow-md hover:bg-accent-soft">
                Tôi là người mới
                <x-public.icon name="arrow-right" />
            </x-public.button>
            <x-public.button
                variant="secondary"
                :href="route('events.index')"
                class="border-transparent bg-accent-soft text-primary shadow-md hover:bg-on-primary"
            >
                Xem sự kiện
            </x-public.button>
        </div>
    </x-public.container>
</section>
