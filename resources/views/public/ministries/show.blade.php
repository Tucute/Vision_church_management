@extends('layouts.public')

@section('title', $ministry->name)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.reveal>
            <x-public.page-header
                :title="$ministry->name"
                :lead="$ministry->description"
                :back-href="route('ministries.index')"
                back-label="Tất cả ban ngành"
            />
        </x-public.reveal>

        <x-public.reveal delay="1">
            <x-public.info-card title="Thành viên đang phục vụ" eyebrow="Community" class="mb-6">
                @if ($activeMembers->isEmpty())
                    <p class="ui-small">Danh sách thành viên công khai sẽ được cập nhật khi có dữ liệu.</p>
                @else
                    <ul class="mt-2 grid list-none grid-cols-1 gap-3 md:grid-cols-2">
                        @foreach ($activeMembers as $membership)
                            <li>
                                <x-public.list-tile
                                    :title="$membership->person->name"
                                    :meta="$membership->role->name"
                                />
                            </li>
                        @endforeach
                    </ul>
                @endif
            </x-public.info-card>
        </x-public.reveal>
    </x-public.container>
</section>
@endsection
