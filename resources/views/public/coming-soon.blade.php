@extends('layouts.public')

@section('title', $title)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.reveal>
            <x-public.info-card class="mx-auto max-w-lg text-center shadow-md">
                <x-public.page-header
                    :title="$title"
                    lead="Trang này đang được xây dựng và sẽ sớm ra mắt."
                    class="mb-6 text-center [&_h1]:mx-auto [&_p]:mx-auto"
                />
                <x-public.button variant="secondary" :href="route('home')">
                    <x-public.icon name="arrow-left" />
                    Về trang chủ
                </x-public.button>
            </x-public.info-card>
        </x-public.reveal>
    </x-public.container>
</section>
@endsection
