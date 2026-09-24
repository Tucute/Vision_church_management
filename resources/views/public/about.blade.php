@extends('layouts.public')

@section('title', 'Giới thiệu — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.reveal>
            <x-public.page-header
                :title="'Về ' . $churchInfo->name"
                :lead="$churchInfo->founding_date ? 'Thành lập ngày ' . $churchInfo->founding_date->format('d/m/Y') : null"
            />
        </x-public.reveal>

        <div class="space-y-6">
            <x-public.reveal delay="1">
                <x-public.info-card title="Tầm nhìn" eyebrow="Vision">
                    <p class="ui-body">{{ $churchInfo->vision ?: 'Đang cập nhật.' }}</p>
                </x-public.info-card>
            </x-public.reveal>

            <x-public.reveal delay="2">
                <x-public.info-card title="Sứ mệnh" eyebrow="Mission">
                    <p class="ui-body">{{ $churchInfo->mission ?: 'Đang cập nhật.' }}</p>
                </x-public.info-card>
            </x-public.reveal>

            <x-public.reveal delay="3">
                <x-public.info-card title="Lịch sử hình thành" eyebrow="History">
                    <p class="ui-body whitespace-pre-line">{{ $churchInfo->history ?: 'Đang cập nhật.' }}</p>
                </x-public.info-card>
            </x-public.reveal>

            <x-public.reveal>
                <x-public.info-card title="Địa chỉ" eyebrow="Visit">
                    <p class="ui-body">{{ $churchInfo->address ?: 'Đang cập nhật.' }}</p>
                </x-public.info-card>
            </x-public.reveal>
        </div>
    </x-public.container>
</section>
@endsection
