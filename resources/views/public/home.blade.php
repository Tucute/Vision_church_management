@extends('layouts.public')

@section('title', $churchInfo->name . ' — Trang chủ')

@section('content')

    {{-- Hero --}}
    <section class="bg-gradient-to-b from-indigo-50 to-white">
        <div class="max-w-5xl mx-auto px-4 py-20 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-4">
                Chào mừng đến với {{ $churchInfo->name }}
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto mb-8">
                {{ $churchInfo->mission ?? 'Một cộng đồng đức tin yêu thương, gắn kết và cùng nhau phát triển.' }}
            </p>
            <div class="flex items-center justify-center gap-4">
                <a href="{{ route('im-new') }}" class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-indigo-700">
                    Tôi là người mới →
                </a>
                <a href="{{ route('events.index') }}" class="border border-slate-300 font-semibold px-6 py-3 rounded-lg hover:bg-slate-50">
                    Xem sự kiện
                </a>
            </div>
        </div>
    </section>

    {{-- Upcoming Events --}}
    @if ($upcomingEvents->isNotEmpty())
    <section class="max-w-6xl mx-auto px-4 py-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold">Sự kiện sắp tới</h2>
            <a href="{{ route('events.index') }}" class="text-indigo-600 font-medium text-sm hover:underline">Xem tất cả →</a>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($upcomingEvents as $event)
                <a href="{{ route('events.show', $event) }}" class="block border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-sm font-semibold mb-1">{{ $event->start_date->format('d/m/Y') }}</div>
                    <div class="font-bold text-lg mb-2">{{ $event->name }}</div>
                    <div class="text-sm text-slate-500">{{ $event->location }}</div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Ministries --}}
    @if ($ministries->isNotEmpty())
    <section class="bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 py-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold">Các ban ngành</h2>
                <a href="{{ route('ministries.index') }}" class="text-indigo-600 font-medium text-sm hover:underline">Xem tất cả →</a>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($ministries as $ministry)
                    <a href="{{ route('ministries.show', $ministry) }}" class="block bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                        <div class="font-bold text-lg mb-2">{{ $ministry->name }}</div>
                        <p class="text-sm text-slate-500 line-clamp-2">{{ $ministry->description }}</p>
                        <div class="text-xs text-indigo-600 font-medium mt-3">{{ $ministry->active_memberships_count }} thành viên</div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="max-w-4xl mx-auto px-4 py-20 text-center">
        <h2 class="text-2xl font-bold mb-3">Lần đầu đến với chúng tôi?</h2>
        <p class="text-slate-600 mb-6">Chúng tôi rất vui được chào đón bạn. Hãy để lại thông tin để Hội Thánh kết nối với bạn.</p>
        <a href="{{ route('im-new') }}" class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-indigo-700">
            Kết nối ngay
        </a>
    </section>

@endsection
