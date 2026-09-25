@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', 'Our Beliefs — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.page-header
            title="Our Beliefs"
            lead="Những điều Hội Thánh tin và dạy dỗ."
            :back-href="route('about')"
            back-label="Về trang giới thiệu"
        />

        <ol class="grid list-decimal gap-4 pl-5">
            @foreach ($beliefs as $belief)
                <li class="ui-card p-5">
                    <p class="ui-body">{{ $belief }}</p>
                </li>
            @endforeach
        </ol>
    </x-public.container>
</section>
@endsection
