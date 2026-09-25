@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', 'Giới thiệu — ' . $churchInfo->name)

@section('content')

    <section
        class="relative overflow-hidden border-b border-border bg-gradient-to-br from-primary via-primary to-primary-dark text-on-primary"
        aria-labelledby="about-hero-heading"
    >
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <div class="ui-float-3d absolute -left-10 top-8 h-56 w-56 rounded-full bg-accent/40 blur-2xl"></div>
            <div class="ui-float-3d ui-float-3d-delay absolute -right-8 bottom-0 h-64 w-64 rounded-full bg-on-primary/15 blur-3xl"></div>
        </div>
        <x-public.container width="wide" class="relative z-10 py-20 text-center sm:py-24">
            <p class="ui-hero-fade font-sans text-xs font-semibold uppercase tracking-[0.12em] text-accent">About</p>
            <h1 id="about-hero-heading" class="ui-hero-title ui-hero-fade-delay mt-4 font-display font-bold tracking-[-0.03em] text-on-primary">
                Giới thiệu
            </h1>
            <p class="ui-hero-fade-delay-2 mx-auto mt-4 max-w-2xl text-on-primary/85">
                {{ $churchInfo->name }} — một nhà của ân điển tại Đà Nẵng.
            </p>
        </x-public.container>
    </section>

    <section class="ui-section" aria-labelledby="about-pastor-name">
        <x-public.container>
            <div class="mx-auto grid max-w-5xl items-center gap-10 lg:grid-cols-2 lg:gap-16">
                <img
                    src="{{ asset($pastor['image']) }}"
                    alt="Chân dung {{ $pastor['name'] }}, ảnh demo"
                    class="mx-auto aspect-[3/4] w-full max-w-md rounded-lg object-cover shadow-lg"
                    width="900"
                    height="1200"
                >
                <div class="text-center lg:text-left">
                    <p class="ui-eyebrow">{{ $pastor['position'] }}</p>
                    <h2 id="about-pastor-name" class="ui-h1 mt-3">{{ $pastor['name'] }}</h2>
                    <p class="ui-body mt-5">{{ $pastor['introduction'] }}</p>
                    <p class="ui-caption mt-4 text-muted">Ảnh và tên mục sư là nội dung demo.</p>
                </div>
            </div>
        </x-public.container>
    </section>

    <section class="border-t border-border bg-surface-alt ui-section" aria-labelledby="about-explore-heading">
        <x-public.container>
            <h2 id="about-explore-heading" class="sr-only">Khám phá Hội Thánh</h2>
            <ul class="grid list-none grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($cards as $card)
                    <li>
                        <x-public.photo-card
                            :href="route($card['route'])"
                            :image="$card['image']"
                            :title="$card['title']"
                            :alt="$card['alt']"
                        />
                    </li>
                @endforeach
            </ul>
        </x-public.container>
    </section>

@endsection
