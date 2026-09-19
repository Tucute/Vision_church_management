@extends('layouts.public')

@section('title', 'Ministries')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-extrabold mb-10">Các ban ngành</h1>

    @if ($ministries->isEmpty())
        <p class="text-slate-500">Hiện chưa có ban ngành nào.</p>
    @else
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($ministries as $ministry)
                <a href="{{ route('ministries.show', $ministry) }}" class="block border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="font-bold text-lg mb-2">{{ $ministry->name }}</div>
                    <p class="text-sm text-slate-500 line-clamp-3 mb-3">{{ $ministry->description }}</p>
                    <div class="text-xs text-indigo-600 font-medium">{{ $ministry->active_memberships_count }} thành viên đang phục vụ</div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
