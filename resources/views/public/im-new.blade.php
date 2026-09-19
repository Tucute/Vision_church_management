@extends('layouts.public')

@section('title', "I'm New")

@section('content')
<div class="max-w-2xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-extrabold mb-3">Chào mừng bạn! 👋</h1>
    <p class="text-slate-600 mb-10">
        Chúng tôi rất vui khi bạn quan tâm đến Hội Thánh. Hãy để lại vài thông tin bên dưới,
        đội ngũ của chúng tôi sẽ sớm liên lạc và đồng hành cùng bạn.
    </p>

    <form method="POST" action="{{ route('im-new.store') }}" class="space-y-5 bg-slate-50 border border-slate-200 rounded-xl p-8">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Họ và tên *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Giới tính</label>
                <select name="gender" class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">-- Chọn --</option>
                    <option value="male" @selected(old('gender') === 'male')>Nam</option>
                    <option value="female" @selected(old('gender') === 'female')>Nữ</option>
                    <option value="other" @selected(old('gender') === 'other')>Khác</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Ngày sinh</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Địa chỉ</label>
            <input type="text" name="address" value="{{ old('address') }}"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Lời nhắn (tuỳ chọn)</label>
            <textarea name="message" rows="3"
                      class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700">
            Gửi thông tin
        </button>
    </form>
</div>
@endsection
