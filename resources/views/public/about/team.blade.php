@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', 'Our Team — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container>
        <x-public.page-header
            title="Our Team"
            lead="Sơ đồ quản trị: mục sư quản nhiệm, nhân sự, và ban lãnh đạo."
            :back-href="route('about')"
            back-label="Về trang giới thiệu"
        />

        <div class="mx-auto flex max-w-3xl flex-col items-center gap-6">
            <x-public.info-card class="w-full max-w-md text-center">
                <p class="ui-eyebrow">{{ $team['lead']['count'] }} người</p>
                <h2 class="ui-h3 mt-2">{{ $team['lead']['role'] }}</h2>
                <p class="ui-body mt-2">{{ $team['lead']['name'] }}</p>
            </x-public.info-card>

            <div class="h-8 w-px bg-border" aria-hidden="true"></div>

            <div class="grid w-full gap-6 md:grid-cols-2">
                <x-public.info-card class="text-center">
                    <p class="ui-eyebrow">{{ $team['staff']['count'] }} người</p>
                    <h2 class="ui-h3 mt-2">{{ $team['staff']['role'] }}</h2>
                    <p class="ui-body mt-2">{{ $team['staff']['name'] }}</p>
                    <p class="ui-small mt-2">{{ $team['staff']['note'] }}</p>
                </x-public.info-card>

                <x-public.info-card class="text-center">
                    <p class="ui-eyebrow">{{ count($team['board']) }} người</p>
                    <h2 class="ui-h3 mt-2">Ban lãnh đạo</h2>
                    <p class="ui-small mt-2">Cùng mục sư định hướng đời sống Hội Thánh.</p>
                </x-public.info-card>
            </div>
        </div>

        <h2 class="ui-h2 mt-14 text-center">Ban lãnh đạo</h2>
        <ul class="mt-8 grid list-none grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($team['board'] as $member)
                <li>
                    <x-public.list-tile :title="$member" meta="Ủy viên" />
                </li>
            @endforeach
        </ul>
        <p class="ui-caption mt-6 text-center text-muted">Danh sách nhân sự là nội dung demo.</p>
    </x-public.container>
</section>
@endsection
