@extends('layouts.public')

@section('title', 'Liên hệ — ' . $churchInfo->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-12">
    <div>
        <h1 class="text-3xl font-extrabold mb-6">Liên hệ</h1>
        <p class="text-slate-600 mb-8">Có câu hỏi hoặc cần hỗ trợ? Gửi tin nhắn cho chúng tôi, đội ngũ sẽ phản hồi sớm nhất.</p>

        <div class="space-y-3 text-sm">
            <div><span class="font-semibold">Địa chỉ:</span> {{ $churchInfo->address }}</div>
            @php($contact = $churchInfo->contact_info ?? [])
            <div><span class="font-semibold">Điện thoại:</span> {{ $contact['phone'] ?? '—' }}</div>
            <div><span class="font-semibold">Email:</span> {{ $contact['email'] ?? '—' }}</div>
        </div>
    </div>

    <form method="POST" action="{{ route('contact.store') }}" class="space-y-4 bg-slate-50 border border-slate-200 rounded-xl p-8">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Họ và tên *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Email *</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Số điện thoại</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Chủ đề</label>
            <input type="text" name="subject" value="{{ old('subject') }}"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nội dung *</label>
            <textarea name="message" rows="4" required
                      class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('message') }}</textarea>
            @error('message') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700">
            Gửi tin nhắn
        </button>
    </form>
</div>
@endsection
