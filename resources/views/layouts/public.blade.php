<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hội Thánh')</title>

    {{-- Dùng Tailwind qua CDN để chạy nhanh không cần build step.
         Khi lên production nên chuyển sang Tailwind compiled qua Vite để tối ưu kích thước. --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-white text-slate-800">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="font-extrabold text-lg text-indigo-700">
                ⛪ {{ \App\Models\ChurchInfo::current()->name }}
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-indigo-700 {{ request()->routeIs('home') ? 'text-indigo-700' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="hover:text-indigo-700 {{ request()->routeIs('about') ? 'text-indigo-700' : '' }}">About</a>
                <a href="{{ route('im-new') }}" class="hover:text-indigo-700 {{ request()->routeIs('im-new*') ? 'text-indigo-700' : '' }}">I'm New</a>
                <a href="{{ route('events.index') }}" class="hover:text-indigo-700 {{ request()->routeIs('events.*') ? 'text-indigo-700' : '' }}">Events</a>
                <a href="{{ route('sermons.index') }}" class="hover:text-indigo-700 {{ request()->routeIs('sermons.*') ? 'text-indigo-700' : '' }}">Sermons</a>
                <a href="{{ route('ministries.index') }}" class="hover:text-indigo-700 {{ request()->routeIs('ministries.*') ? 'text-indigo-700' : '' }}">Ministries</a>
                <a href="{{ route('gallery.index') }}" class="hover:text-indigo-700 {{ request()->routeIs('gallery.*') ? 'text-indigo-700' : '' }}">Gallery</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-700 {{ request()->routeIs('contact*') ? 'text-indigo-700' : '' }}">Contact</a>
            </div>

            <a href="{{ route('im-new') }}" class="hidden md:inline-block bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700">
                Kết nối ngay
            </a>

            {{-- Mobile menu đơn giản, không JS phức tạp --}}
            <details class="md:hidden relative">
                <summary class="list-none cursor-pointer text-2xl">☰</summary>
                <div class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-lg shadow-lg py-2 flex flex-col text-sm">
                    <a href="{{ route('home') }}" class="px-4 py-2 hover:bg-slate-50">Home</a>
                    <a href="{{ route('about') }}" class="px-4 py-2 hover:bg-slate-50">About</a>
                    <a href="{{ route('im-new') }}" class="px-4 py-2 hover:bg-slate-50">I'm New</a>
                    <a href="{{ route('events.index') }}" class="px-4 py-2 hover:bg-slate-50">Events</a>
                    <a href="{{ route('sermons.index') }}" class="px-4 py-2 hover:bg-slate-50">Sermons</a>
                    <a href="{{ route('ministries.index') }}" class="px-4 py-2 hover:bg-slate-50">Ministries</a>
                    <a href="{{ route('gallery.index') }}" class="px-4 py-2 hover:bg-slate-50">Gallery</a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 hover:bg-slate-50">Contact</a>
                </div>
            </details>
        </nav>
    </header>

    @if (session('success'))
        <div class="max-w-3xl mx-auto mt-4 px-4">
            <div class="bg-green-50 text-green-800 border border-green-200 rounded-lg px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session('info'))
        <div class="max-w-3xl mx-auto mt-4 px-4">
            <div class="bg-blue-50 text-blue-800 border border-blue-200 rounded-lg px-4 py-3 text-sm">
                {{ session('info') }}
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="max-w-3xl mx-auto mt-4 px-4">
            <div class="bg-red-50 text-red-800 border border-red-200 rounded-lg px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-slate-300 mt-20">
        <div class="max-w-6xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-8">
            <div>
                <div class="font-bold text-white text-lg mb-2">⛪ {{ \App\Models\ChurchInfo::current()->name }}</div>
                <p class="text-sm text-slate-400">{{ \App\Models\ChurchInfo::current()->address }}</p>
            </div>
            <div class="text-sm">
                <div class="font-semibold text-white mb-2">Liên hệ</div>
                @php($contact = \App\Models\ChurchInfo::current()->contact_info ?? [])
                <p>{{ $contact['phone'] ?? '' }}</p>
                <p>{{ $contact['email'] ?? '' }}</p>
            </div>
            <div class="text-sm">
                <div class="font-semibold text-white mb-2">Theo dõi chúng tôi</div>
                @php($social = \App\Models\ChurchInfo::current()->social_links ?? [])
                @foreach ($social as $platform => $url)
                    <a href="{{ $url }}" class="block hover:text-white capitalize">{{ $platform }}</a>
                @endforeach
            </div>
        </div>
        <div class="border-t border-slate-800 text-center text-xs text-slate-500 py-4">
            © {{ date('Y') }} {{ \App\Models\ChurchInfo::current()->name }}. All rights reserved.
        </div>
    </footer>

</body>
</html>
