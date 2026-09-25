@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', 'Vision and Mission — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.page-header
            title="Vision and Mission"
            lead="Tầm nhìn và sứ mệnh của Hội Thánh."
            :back-href="route('about')"
            back-label="Về trang giới thiệu"
        />

        <div class="space-y-6">
            <x-public.info-card title="Tầm nhìn" eyebrow="Vision">
                <p class="ui-body">{{ $churchInfo->vision ?: 'Đang cập nhật.' }}</p>
            </x-public.info-card>
            <x-public.info-card title="Sứ mệnh" eyebrow="Mission">
                <p class="ui-body">{{ $churchInfo->mission ?: 'Đang cập nhật.' }}</p>
            </x-public.info-card>
        </div>
    </x-public.container>
</section>
@endsection
