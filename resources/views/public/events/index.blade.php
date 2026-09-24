@extends('layouts.public')

@section('title', 'Sự kiện')

@section('content')
<section class="ui-section">
    <x-public.container>
        <x-public.reveal>
            <x-public.page-header title="Sự kiện" />
        </x-public.reveal>

        @if ($events->isEmpty())
            <x-public.reveal>
                <x-public.empty-state
                    title="Chưa có sự kiện nào"
                    body="Hiện chưa có sự kiện công khai. Vui lòng quay lại sau."
                    action-label="Về trang chủ"
                    :action-url="route('home')"
                />
            </x-public.reveal>
        @else
            <ul class="grid list-none grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($events as $event)
                    <li>
                        <x-public.reveal :delay="(string) min(($loop->index % 3) + 1, 3)">
                            <x-public.content-card
                                :href="route('events.show', $event)"
                                :title="$event->name"
                                :meta="$event->start_date->format('d/m/Y H:i')"
                                :description="$event->location"
                            >
                                <x-slot:status>
                                    <x-public.status-chip
                                        :tone="$event->status === 'open' ? 'success' : 'neutral'"
                                        :label="$event->status === 'open' ? 'Đang mở đăng ký' : 'Đã đóng đăng ký'"
                                    />
                                </x-slot:status>
                            </x-public.content-card>
                        </x-public.reveal>
                    </li>
                @endforeach
            </ul>

            <div class="mt-10">
                {{ $events->links() }}
            </div>
        @endif
    </x-public.container>
</section>
@endsection
