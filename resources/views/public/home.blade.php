@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', $churchInfo->name . ' — Trang chủ')

@section('content')

    <x-public.home-hero :church-info="$churchInfo" />

    <section class="ui-section" aria-labelledby="home-intro-heading">
        <x-public.container>
            <x-public.media-split
                image="images/home/home-intro.png"
                alt="Không gian nhóm họp, ảnh demo"
                :image-first="true"
            >
                <x-public.reveal>
                    <x-public.section-header
                        title="Chúng tôi là ai"
                        heading-id="home-intro-heading"
                        action-label="Đọc thêm"
                        :action-url="route('about')"
                    />
                    <div class="space-y-4">
                        <x-public.info-card title="Tầm nhìn" eyebrow="Vision" class="p-5 sm:p-6">
                            <p class="ui-body">{{ $churchInfo->vision ?: 'Đang cập nhật.' }}</p>
                        </x-public.info-card>
                        <x-public.info-card title="Sứ mệnh" eyebrow="Mission" class="p-5 sm:p-6">
                            <p class="ui-body">{{ $churchInfo->mission ?: 'Đang cập nhật.' }}</p>
                        </x-public.info-card>
                        @if ($churchInfo->history || $churchInfo->founding_date)
                            <x-public.info-card class="p-5 sm:p-6">
                                @if ($churchInfo->founding_date)
                                    <p class="ui-eyebrow mb-2">Thành lập {{ $churchInfo->founding_date->format('d/m/Y') }}</p>
                                @endif
                                @if ($churchInfo->history)
                                    <p class="ui-body line-clamp-3">{{ $churchInfo->history }}</p>
                                @endif
                                <div class="mt-4">
                                    <x-public.button variant="link" :href="route('about')">
                                        Đọc lịch sử đầy đủ
                                        <x-public.icon name="arrow-right" />
                                    </x-public.button>
                                </div>
                            </x-public.info-card>
                        @endif
                    </div>
                </x-public.reveal>
            </x-public.media-split>
        </x-public.container>
    </section>

    <section class="border-y border-border bg-surface-alt ui-section" aria-labelledby="home-events-heading">
        <x-public.container>
            <x-public.media-split
                image="images/home/home-events.png"
                alt="Buổi nhóm Hội Thánh, ảnh demo"
                :image-first="false"
            >
                <x-public.reveal>
                    <x-public.section-header
                        title="Sự kiện sắp tới"
                        heading-id="home-events-heading"
                        action-label="Xem tất cả"
                        :action-url="route('events.index')"
                    />

                    @if ($upcomingEvents->isNotEmpty())
                        <ul class="grid list-none gap-4">
                            @foreach ($upcomingEvents as $event)
                                <li>
                                    <x-public.content-card
                                        :href="route('events.show', $event)"
                                        :title="$event->name"
                                        :meta="$event->start_date->format('d/m/Y')"
                                        :description="$event->location"
                                        class="p-5"
                                    />
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <x-public.empty-state
                            title="Chưa có sự kiện sắp tới"
                            body="Hãy quay lại sau hoặc liên hệ Hội Thánh để biết lịch sắp tới."
                            action-label="Liên hệ"
                            :action-url="route('contact')"
                        />
                    @endif
                </x-public.reveal>
            </x-public.media-split>
        </x-public.container>
    </section>

    <section class="ui-section" aria-labelledby="home-ministries-heading">
        <x-public.container>
            <x-public.media-split
                image="images/home/home-ministries.png"
                alt="Ban thờ phượng, ảnh demo"
                :image-first="true"
            >
                <x-public.reveal>
                    <x-public.section-header
                        title="Các ban ngành"
                        heading-id="home-ministries-heading"
                        action-label="Xem tất cả"
                        :action-url="route('ministries.index')"
                    />

                    @if ($ministries->isNotEmpty())
                        <ul class="grid list-none gap-4">
                            @foreach ($ministries->take(3) as $ministry)
                                <li>
                                    <x-public.content-card
                                        :href="route('ministries.show', $ministry)"
                                        :title="$ministry->name"
                                        :description="$ministry->description"
                                        :footer="$ministry->active_memberships_count . ' thành viên'"
                                        class="p-5"
                                    />
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <x-public.empty-state
                            title="Chưa có ban ngành"
                            body="Thông tin ban ngành sẽ sớm được cập nhật."
                        />
                    @endif
                </x-public.reveal>
            </x-public.media-split>
        </x-public.container>
    </section>

    <section class="border-y border-border bg-accent-soft/40 ui-section" aria-labelledby="home-connect-heading">
        <x-public.container>
            <x-public.media-split
                image="images/home/home-connect.png"
                alt="Cửa hội thánh mở, ảnh demo"
                :image-first="false"
            >
                <x-public.reveal>
                    <p class="ui-eyebrow mb-3">Kết nối</p>
                    <h2 id="home-connect-heading" class="ui-h2">Lần đầu đến với chúng tôi?</h2>
                    <p class="ui-muted mt-3 max-w-lg">
                        Chúng tôi rất vui được chào đón bạn. Hãy để lại thông tin để Hội Thánh kết nối với bạn.
                    </p>
                    <div class="mt-8">
                        <x-public.button variant="primary" :href="route('im-new')">
                            Kết nối ngay
                            <x-public.icon name="arrow-right" />
                        </x-public.button>
                    </div>
                </x-public.reveal>
            </x-public.media-split>
        </x-public.container>
    </section>

    <section class="ui-section" aria-labelledby="home-visit-heading">
        <x-public.container>
            <x-public.media-split
                image="images/home/home-visit.png"
                alt="Mặt tiền hội thánh, ảnh demo"
                :image-first="true"
            >
                <x-public.reveal>
                    <x-public.section-header
                        title="Ghé thăm chúng tôi"
                        heading-id="home-visit-heading"
                        class="mb-4 sm:mb-6"
                    />
                    <p class="ui-muted max-w-lg">
                        Chúng tôi rất vui được chào đón bạn. Dưới đây là thông tin liên hệ hiện có — hãy xem thêm sự kiện sắp tới để biết lịch họp mặt.
                    </p>
                    <x-public.info-card eyebrow="Địa điểm & liên hệ" class="mt-6 p-5 sm:p-6">
                        <x-public.contact-info :church-info="$churchInfo" />
                    </x-public.info-card>
                    <div class="mt-6">
                        <x-public.button variant="secondary" :href="route('contact')">
                            Liên hệ
                            <x-public.icon name="arrow-right" />
                        </x-public.button>
                    </div>
                </x-public.reveal>
            </x-public.media-split>
        </x-public.container>
    </section>

    <x-public.activity-marquee :items="[
        ['image' => 'images/home/marquee/01.png', 'caption' => 'Thờ phượng Chúa nhật', 'alt' => 'Sinh hoạt thờ phượng Chúa nhật, ảnh demo'],
        ['image' => 'images/home/marquee/02.png', 'caption' => 'Giờ học Kinh Thánh', 'alt' => 'Giờ học Kinh Thánh, ảnh demo'],
        ['image' => 'images/home/marquee/03.png', 'caption' => 'Trại hè thanh niên', 'alt' => 'Trại hè thanh niên, ảnh demo'],
        ['image' => 'images/home/marquee/04.png', 'caption' => 'Sinh hoạt thiếu nhi', 'alt' => 'Sinh hoạt thiếu nhi, ảnh demo'],
        ['image' => 'images/home/marquee/05.png', 'caption' => 'Thông công sau buổi nhóm', 'alt' => 'Thông công sau buổi nhóm, ảnh demo'],
        ['image' => 'images/home/marquee/06.png', 'caption' => 'Hội thảo nuôi dạy con', 'alt' => 'Hội thảo nuôi dạy con, ảnh demo'],
        ['image' => 'images/home/marquee/07.png', 'caption' => 'Nhóm thanh niên', 'alt' => 'Nhóm thanh niên, ảnh demo'],
        ['image' => 'images/home/marquee/08.png', 'caption' => 'Phục vụ cộng đồng', 'alt' => 'Phục vụ cộng đồng, ảnh demo'],
        ['image' => 'images/home/marquee/09.png', 'caption' => 'Ban thờ phượng', 'alt' => 'Ban thờ phượng, ảnh demo'],
        ['image' => 'images/home/marquee/10.png', 'caption' => 'Ngày hội gia đình', 'alt' => 'Ngày hội gia đình, ảnh demo'],
    ]" />

@endsection
