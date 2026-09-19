@extends('layouts.public')

@section('title', $title)

@section('content')
<div class="max-w-3xl mx-auto px-4 py-24 text-center">
    <div class="text-5xl mb-4">🚧</div>
    <h1 class="text-2xl font-bold mb-2">{{ $title }}</h1>
    <p class="text-slate-500">Trang này đang được xây dựng, sẽ sớm ra mắt!</p>
    <a href="{{ route('home') }}" class="inline-block mt-6 text-indigo-600 font-medium hover:underline">← Về trang chủ</a>
</div>
@endsection
