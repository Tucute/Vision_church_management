@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', $churchInfo->name . ' — Trang chủ')

@section('content')

    <x-public.home-hero :church-info="$churchInfo" />

    <section class="ui-section" aria-labelledby="home-intro-heading">
        <x-public.container>
            <x-public.reveal>
                <x-public.section-header
                    title="Chúng tôi là ai"
                    heading-id="home-intro-heading"
                    action-label="Đọc thêm"
                    :action-url="route('about')"
                />
            </x-public.reveal>

            <div class="grid gap-6 lg:grid-cols-2">
                <x-public.reveal delay="1">
                    <x-public.info-card title="Tầm nhìn" eyebrow="Vision">
                        <p class="ui-body">
                            {{ $churchInfo->vision ?: 'Đang cập nhật.' }}
                        </p>
                    </x-public.info-card>
                </x-public.reveal>

                <x-public.reveal delay="2">
                    <x-public.info-card title="Sứ mệnh" eyebrow="Mission">
                        <p class="ui-body">
                            {{ $churchInfo->mission ?: 'Đang cập nhật.' }}
                        </p>
                    </x-public.info-card>
                </x-public.reveal>
            </div>

            @if ($churchInfo->history || $churchInfo->founding_date)
                <x-public.reveal delay="3" class="mt-6">
                    <x-public.info-card>
                        @if ($churchInfo->founding_date)
                            <p class="ui-eyebrow mb-2">
                                Thành lập {{ $churchInfo->founding_date->format('d/m/Y') }}
                            </p>
                        @endif
                        @if ($churchInfo->history)
                            <p class="ui-body line-clamp-3">
                                {{ $churchInfo->history }}
                            </p>
                        @endif
                        <div class="mt-4">
                            <x-public.button variant="link" :href="route('about')">
                                Đọc lịch sử đầy đủ
                                <x-public.icon name="arrow-right" />
                            </x-public.button>
                        </div>
                    </x-public.info-card>
                </x-public.reveal>
            @endif
        </x-public.container>
    </section>

    <section class="border-y border-border bg-surface-alt ui-section" aria-labelledby="home-visit-heading">
        <x-public.container>
            <div class="grid items-start gap-8 lg:grid-cols-2">
                <x-public.reveal>
                    <x-public.section-header
                        title="Ghé thăm chúng tôi"
                        heading-id="home-visit-heading"
                        class="mb-4 sm:mb-6"
                    />
                    <p class="ui-muted max-w-lg">
                        Chúng tôi rất vui được chào đón bạn. Dưới đây là thông tin liên hệ hiện có — hãy xem thêm sự kiện sắp tới để biết lịch họp mặt.
                    </p>
                    <div class="mt-6">
                        <x-public.button variant="secondary" :href="route('contact')">
                            Liên hệ
                            <x-public.icon name="arrow-right" />
                        </x-public.button>
                    </div>
                </x-public.reveal>

                <x-public.reveal delay="1">
                    <x-public.info-card eyebrow="Địa điểm & liên hệ">
                        <x-public.contact-info :church-info="$churchInfo" />
                    </x-public.info-card>
                </x-public.reveal>
            </div>
        </x-public.container>
    </section>

    <section class="ui-section" aria-labelledby="home-events-heading">
        <x-public.container>
            <x-public.reveal>
                <x-public.section-header
                    title="Sự kiện sắp tới"
                    heading-id="home-events-heading"
                    action-label="Xem tất cả"
                    :action-url="route('events.index')"
                />
            </x-public.reveal>

            @if ($upcomingEvents->isNotEmpty())
                <ul class="grid list-none grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($upcomingEvents as $event)
                        <li>
                            <x-public.reveal :delay="(string) min($loop->index + 1, 3)">
                                <x-public.content-card
                                    :href="route('events.show', $event)"
                                    :title="$event->name"
                                    :meta="$event->start_date->format('d/m/Y')"
                                    :description="$event->location"
                                />
                            </x-public.reveal>
                        </li>
                    @endforeach
                </ul>
            @else
                <x-public.reveal>
                    <x-public.empty-state
                        title="Chưa có sự kiện sắp tới"
                        body="Hãy quay lại sau hoặc liên hệ Hội Thánh để biết lịch sắp tới."
                        action-label="Liên hệ"
                        :action-url="route('contact')"
                    />
                </x-public.reveal>
            @endif
        </x-public.container>
    </section>

    <section class="border-y border-border bg-surface-alt ui-section" aria-labelledby="home-ministries-heading">
        <x-public.container>
            <x-public.reveal>
                <x-public.section-header
                    title="Các ban ngành"
                    heading-id="home-ministries-heading"
                    action-label="Xem tất cả"
                    :action-url="route('ministries.index')"
                />
            </x-public.reveal>

            @if ($ministries->isNotEmpty())
                <ul class="grid list-none grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($ministries as $ministry)
                        <li>
                            <x-public.reveal :delay="(string) min(($loop->index % 3) + 1, 3)">
                                <x-public.content-card
                                    :href="route('ministries.show', $ministry)"
                                    :title="$ministry->name"
                                    :description="$ministry->description"
                                    :footer="$ministry->active_memberships_count . ' thành viên'"
                                />
                            </x-public.reveal>
                        </li>
                    @endforeach
                </ul>
            @else
                <x-public.reveal>
                    <x-public.empty-state
                        title="Chưa có ban ngành"
                        body="Thông tin ban ngành sẽ sớm được cập nhật."
                    />
                </x-public.reveal>
            @endif
        </x-public.container>
    </section>

    <x-public.cta-band
        title="Lần đầu đến với chúng tôi?"
        body="Chúng tôi rất vui được chào đón bạn. Hãy để lại thông tin để Hội Thánh kết nối với bạn."
        action-label="Kết nối ngay"
        :action-url="route('im-new')"
    />

@endsection
