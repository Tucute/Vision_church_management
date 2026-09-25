@props([
    'items',
])

@php
    $slides = collect($items)->take(15)->values();
@endphp

@if ($slides->isNotEmpty())
    <section class="ui-marquee overflow-hidden border-y border-border bg-surface py-10" aria-labelledby="home-activities-heading">
        <x-public.container class="mb-6">
            <p class="ui-eyebrow">Sinh hoạt gần đây</p>
            <h2 id="home-activities-heading" class="ui-h2 mt-2">Đời sống Hội Thánh</h2>
        </x-public.container>

        <div class="ui-marquee-track flex w-max">
            @foreach ([0, 1] as $copy)
                <ul class="flex list-none gap-4 pr-4" @if ($copy === 1) aria-hidden="true" @endif>
                    @foreach ($slides as $slide)
                        <li class="w-72 shrink-0 sm:w-80">
                            <figure class="ui-card overflow-hidden">
                                <img
                                    src="{{ asset($slide['image']) }}"
                                    alt="{{ $copy === 0 ? $slide['alt'] : '' }}"
                                    class="h-44 w-full object-cover sm:h-48"
                                    width="640"
                                    height="360"
                                >
                                <figcaption class="px-4 py-3 text-sm font-semibold text-primary">
                                    {{ $slide['caption'] }}
                                </figcaption>
                            </figure>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </section>
@endif
