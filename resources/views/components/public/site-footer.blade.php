@props([
    'churchInfo',
])

@php
    $social = $churchInfo->social_links ?? [];
@endphp

<footer class="relative mt-20 overflow-hidden bg-inverse text-on-inverse-muted">
    <div class="pointer-events-none absolute -right-24 top-0 h-72 w-72 rounded-full bg-accent/10 blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-20 bottom-0 h-56 w-56 rounded-full bg-primary-light/10 blur-3xl" aria-hidden="true"></div>

    <x-public.container class="relative z-10 grid gap-8 py-14 md:grid-cols-3">
        <div>
            <x-public.logo :church-info="$churchInfo" tone="inverse" class="mb-2" />
            @if ($churchInfo->address)
                <p class="ui-small mt-3 text-on-inverse-muted">{{ $churchInfo->address }}</p>
            @endif
        </div>

        <div>
            <h2 class="mb-3 font-sans text-sm font-semibold text-on-inverse">Liên hệ</h2>
            <x-public.contact-info :church-info="$churchInfo" tone="inverse" :show-address="false" />
        </div>

        <div class="text-sm">
            <h2 class="mb-3 font-sans text-sm font-semibold text-on-inverse">Theo dõi chúng tôi</h2>
            @forelse ($social as $platform => $url)
                <a
                    href="{{ $url }}"
                    class="block capitalize transition duration-150 ease-out hover:text-on-inverse focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-on-inverse"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    {{ $platform }}
                </a>
            @empty
                <p>Đang cập nhật.</p>
            @endforelse
        </div>
    </x-public.container>

    <div class="relative z-10 border-t border-on-inverse-muted/20 py-4 text-center text-xs text-on-inverse-muted">
        © {{ date('Y') }} {{ $churchInfo->name }}. Bảo lưu mọi quyền.
    </div>
</footer>
