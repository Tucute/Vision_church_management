@extends('layouts.public')

@section('title', $event->name)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.reveal>
            <x-public.page-header
                :title="$event->name"
                :back-href="route('events.index')"
                back-label="Tất cả sự kiện"
            />
        </x-public.reveal>

        <x-public.reveal delay="1">
            <div class="ui-card mb-8 grid grid-cols-1 gap-4 p-6 text-sm shadow-md sm:grid-cols-2">
                <div>
                    <span class="font-semibold text-primary">Thời gian:</span>
                    <span class="text-muted"> {{ $event->start_date->format('d/m/Y H:i') }} — {{ $event->end_date->format('H:i') }}</span>
                </div>
                <div>
                    <span class="font-semibold text-primary">Địa điểm:</span>
                    <span class="text-muted"> {{ $event->location }}</span>
                </div>
                @if ($event->capacity)
                    <div>
                        <span class="font-semibold text-primary">Số lượng còn lại:</span>
                        <span class="text-muted"> {{ $event->remaining_capacity }} / {{ $event->capacity }}</span>
                    </div>
                @endif
                <div class="flex flex-wrap items-center gap-2">
                    <span class="font-semibold text-primary">Trạng thái:</span>
                    <x-public.status-chip
                        :tone="$event->status === 'open' ? 'success' : 'neutral'"
                        :label="$event->status === 'open' ? 'Đang mở đăng ký' : ucfirst($event->status)"
                    />
                </div>
            </div>
        </x-public.reveal>

        <x-public.reveal delay="2">
            <div class="ui-card mb-10 p-6 shadow-sm">
                <div class="ui-body whitespace-pre-line">
                    {{ $event->description }}
                </div>
            </div>
        </x-public.reveal>

        @if ($event->status === 'open' && ! $event->is_full)
            <x-public.reveal delay="3">
                <div class="ui-card p-6 shadow-md">
                    <h2 class="ui-h4 mb-4">Đăng ký tham gia</h2>
                    <form method="POST" action="{{ route('events.register', $event) }}" class="space-y-4">
                        @csrf
                        <x-public.form-field name="name" label="Họ và tên" required autocomplete="name" />
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <x-public.form-field name="email" label="Email" type="email" required autocomplete="email" />
                            <x-public.form-field name="phone" label="Số điện thoại" type="tel" required autocomplete="tel" />
                        </div>
                        <x-public.button type="submit" variant="primary" block>
                            Đăng ký ngay
                        </x-public.button>
                    </form>
                </div>
            </x-public.reveal>
        @elseif ($event->is_full)
            <x-public.alert tone="warning">
                Sự kiện đã đủ số lượng đăng ký.
            </x-public.alert>
        @else
            <x-public.alert tone="info">
                Sự kiện hiện không mở đăng ký.
            </x-public.alert>
        @endif
    </x-public.container>
</section>
@endsection
