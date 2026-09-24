@extends('layouts.public')

@section('title', 'Ban ngành')

@section('content')
<section class="ui-section">
    <x-public.container>
        <x-public.reveal>
            <x-public.page-header title="Các ban ngành" />
        </x-public.reveal>

        @if ($ministries->isEmpty())
            <x-public.reveal>
                <x-public.empty-state
                    title="Chưa có ban ngành"
                    body="Thông tin ban ngành sẽ sớm được cập nhật."
                    action-label="Về trang chủ"
                    :action-url="route('home')"
                />
            </x-public.reveal>
        @else
            <ul class="grid list-none grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($ministries as $ministry)
                    <li>
                        <x-public.reveal :delay="(string) min(($loop->index % 3) + 1, 3)">
                            <x-public.content-card
                                :href="route('ministries.show', $ministry)"
                                :title="$ministry->name"
                                :description="$ministry->description"
                                :footer="$ministry->active_memberships_count . ' thành viên đang phục vụ'"
                            />
                        </x-public.reveal>
                    </li>
                @endforeach
            </ul>
        @endif
    </x-public.container>
</section>
@endsection
