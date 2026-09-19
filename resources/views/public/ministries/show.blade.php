@extends('layouts.public')

@section('title', $ministry->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <a href="{{ route('ministries.index') }}" class="text-sm text-indigo-600 hover:underline">← Tất cả ban ngành</a>

    <h1 class="text-3xl font-extrabold mt-4 mb-4">{{ $ministry->name }}</h1>
    <p class="text-slate-700 leading-relaxed mb-10">{{ $ministry->description }}</p>

    <h2 class="font-bold text-lg mb-4">Thành viên đang phục vụ</h2>

    @if ($activeMembers->isEmpty())
        <p class="text-slate-500 text-sm">Chưa có thông tin thành viên.</p>
    @else
        <div class="grid md:grid-cols-2 gap-3">
            @foreach ($activeMembers as $membership)
                <div class="border border-slate-200 rounded-lg px-4 py-3 flex items-center justify-between">
                    <span class="font-medium">{{ $membership->person->name }}</span>
                    <span class="text-xs text-slate-500">{{ $membership->role->name }}</span>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
