@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', 'Our Friends — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container>
        <x-public.page-header
            title="Our Friends"
            lead="Các Hội Thánh thân thuộc cùng khu vực Đà Nẵng. Mỗi hội thánh là một thẻ — bấm vào để xem phần giới thiệu."
            :back-href="route('about')"
            back-label="Về trang giới thiệu"
        />

        <ul class="grid list-none grid-cols-1 gap-6 sm:grid-cols-2">
            @foreach ($friends as $friend)
                <li>
                    <a
                        href="{{ route('about.friends.show', $friend['slug']) }}"
                        class="ui-card-interactive h-full p-6"
                    >
                        <p class="ui-eyebrow">Đà Nẵng</p>
                        <h2 class="ui-h3 mt-2">{{ $friend['name'] }}</h2>
                        <p class="ui-small mt-2 font-semibold text-primary">{{ $friend['area'] }}</p>
                        <p class="ui-body mt-3">{{ $friend['summary'] }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
        <p class="ui-caption mt-6 text-muted">Thông tin hội thánh thân hữu là nội dung demo.</p>
    </x-public.container>
</section>
@endsection
