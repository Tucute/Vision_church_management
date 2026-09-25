@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', 'Our Story — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.page-header
            title="Our Story"
            :lead="$churchInfo->founding_date ? 'Thành lập ngày ' . $churchInfo->founding_date->format('d/m/Y') : 'Câu chuyện hình thành Hội Thánh.'"
            :back-href="route('about')"
            back-label="Về trang giới thiệu"
        />

        <x-public.info-card title="Lịch sử hình thành" eyebrow="History">
            <p class="ui-body whitespace-pre-line">{{ $churchInfo->history ?: 'Đang cập nhật.' }}</p>
        </x-public.info-card>
    </x-public.container>
</section>
@endsection
