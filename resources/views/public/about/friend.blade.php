@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', $friend['name'] . ' — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.page-header
            :title="$friend['name']"
            :lead="$friend['area']"
            :back-href="route('about.friends')"
            back-label="Các hội thánh thân hữu"
        />

        <x-public.info-card eyebrow="Giới thiệu" title="Cùng khu vực Đà Nẵng">
            <p class="ui-body">{{ $friend['summary'] }}</p>
            <p class="ui-small mt-4">Hội Thánh này đồng hành với {{ $churchInfo->name }} trong cầu nguyện, chia sẻ chương trình và thăm viếng lẫn nhau.</p>
        </x-public.info-card>
    </x-public.container>
</section>
@endsection
