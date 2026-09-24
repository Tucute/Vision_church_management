@props([
    'churchInfo' => null,
])

@php
    $churchInfo = $churchInfo ?? \App\Models\ChurchInfo::current();
@endphp

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $churchInfo->name)</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-background text-primary">
    <x-public.site-header :church-info="$churchInfo" />

    @if (session('success') || session('info') || session('error'))
        <div class="pt-4">
            <x-public.container width="reading" class="space-y-3">
                @if (session('success'))
                    <x-public.alert tone="success">{{ session('success') }}</x-public.alert>
                @endif
                @if (session('info'))
                    <x-public.alert tone="info">{{ session('info') }}</x-public.alert>
                @endif
                @if (session('error'))
                    <x-public.alert tone="danger">{{ session('error') }}</x-public.alert>
                @endif
            </x-public.container>
        </div>
    @endif

    <main id="main-content">
        @yield('content')
    </main>

    <x-public.site-footer :church-info="$churchInfo" />
</body>
</html>
