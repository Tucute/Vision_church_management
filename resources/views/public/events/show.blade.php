@extends('layouts.public')

@section('title', $event->name)

@section('content')
<div class="max-w-3xl mx-auto px-4 py-16">
    <a href="{{ route('events.index') }}" class="text-sm text-indigo-600 hover:underline">← Tất cả sự kiện</a>

    <h1 class="text-3xl font-extrabold mt-4 mb-6">{{ $event->name }}</h1>

    <div class="grid grid-cols-2 gap-4 text-sm mb-8 bg-slate-50 border border-slate-200 rounded-xl p-6">
        <div><span class="font-semibold">Thời gian:</span> {{ $event->start_date->format('d/m/Y H:i') }} — {{ $event->end_date->format('H:i') }}</div>
        <div><span class="font-semibold">Địa điểm:</span> {{ $event->location }}</div>
        @if ($event->capacity)
            <div><span class="font-semibold">Số lượng còn lại:</span> {{ $event->remaining_capacity }} / {{ $event->capacity }}</div>
        @endif
        <div>
            <span class="font-semibold">Trạng thái:</span>
            <span class="{{ $event->status === 'open' ? 'text-green-600' : 'text-slate-500' }}">
                {{ $event->status === 'open' ? 'Đang mở đăng ký' : ucfirst($event->status) }}
            </span>
        </div>
    </div>

    <div class="prose max-w-none mb-10 text-slate-700">
        {{ $event->description }}
    </div>

    @if ($event->status === 'open' && ! $event->is_full)
        <div class="bg-white border border-slate-200 rounded-xl p-6">
            <h2 class="font-bold text-lg mb-4">Đăng ký tham gia</h2>
            <form method="POST" action="{{ route('events.register', $event) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Họ và tên *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Số điện thoại *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        @error('phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700">
                    Đăng ký ngay
                </button>
            </form>
        </div>
    @elseif ($event->is_full)
        <div class="bg-amber-50 text-amber-800 border border-amber-200 rounded-lg px-4 py-3 text-sm">
            Sự kiện đã đủ số lượng đăng ký.
        </div>
    @else
        <div class="bg-slate-50 text-slate-600 border border-slate-200 rounded-lg px-4 py-3 text-sm">
            Sự kiện hiện không mở đăng ký.
        </div>
    @endif
</div>
@endsection
