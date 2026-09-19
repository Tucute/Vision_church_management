@extends('layouts.public')

@section('title', 'Sự kiện')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-extrabold mb-10">Sự kiện</h1>

    @if ($events->isEmpty())
        <p class="text-slate-500">Hiện chưa có sự kiện nào.</p>
    @else
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <a href="{{ route('events.show', $event) }}" class="block border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-sm font-semibold mb-1">
                        {{ $event->start_date->format('d/m/Y H:i') }}
                    </div>
                    <div class="font-bold text-lg mb-2">{{ $event->name }}</div>
                    <div class="text-sm text-slate-500 mb-3">{{ $event->location }}</div>
                    <span class="inline-block text-xs font-semibold px-2 py-1 rounded-full
                        {{ $event->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ $event->status === 'open' ? 'Đang mở đăng ký' : 'Đã đóng đăng ký' }}
                    </span>
                </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $events->links() }}
        </div>
    @endif
</div>
@endsection
