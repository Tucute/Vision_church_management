@extends('layouts.public')

@section('title', 'About — ' . $churchInfo->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-extrabold mb-2">Về {{ $churchInfo->name }}</h1>
    @if ($churchInfo->founding_date)
        <p class="text-sm text-slate-500 mb-10">Thành lập ngày {{ $churchInfo->founding_date->format('d/m/Y') }}</p>
    @else
        <div class="mb-10"></div>
    @endif

    <div class="space-y-10">
        <div>
            <h2 class="text-xl font-bold text-indigo-700 mb-2">Tầm nhìn</h2>
            <p class="text-slate-700 leading-relaxed">{{ $churchInfo->vision ?: 'Đang cập nhật.' }}</p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-indigo-700 mb-2">Sứ mệnh</h2>
            <p class="text-slate-700 leading-relaxed">{{ $churchInfo->mission ?: 'Đang cập nhật.' }}</p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-indigo-700 mb-2">Lịch sử hình thành</h2>
            <p class="text-slate-700 leading-relaxed">{{ $churchInfo->history ?: 'Đang cập nhật.' }}</p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-indigo-700 mb-2">Địa chỉ</h2>
            <p class="text-slate-700 leading-relaxed">{{ $churchInfo->address ?: 'Đang cập nhật.' }}</p>
        </div>
    </div>
</div>
@endsection