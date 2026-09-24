@props([
    'churchInfo',
])

@php
    $navItems = [
        ['route' => 'home', 'pattern' => 'home', 'label' => 'Trang chủ'],
        ['route' => 'about', 'pattern' => 'about', 'label' => 'Giới thiệu'],
        ['route' => 'im-new', 'pattern' => 'im-new*', 'label' => 'Người mới'],
        ['route' => 'events.index', 'pattern' => 'events.*', 'label' => 'Sự kiện'],
        ['route' => 'ministries.index', 'pattern' => 'ministries.*', 'label' => 'Ban ngành'],
        ['route' => 'contact', 'pattern' => 'contact*', 'label' => 'Liên hệ'],
    ];
@endphp

<a
    href="#main-content"
    class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[60] focus:rounded-md focus:bg-surface focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-primary focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-primary"
>
    Đến nội dung chính
</a>

<header class="sticky top-0 z-50 border-b border-border/80 bg-surface/90 shadow-sm backdrop-blur-md">
    <x-public.container class="flex h-16 items-center justify-between gap-4">
        <x-public.logo :church-info="$churchInfo" />

        <nav class="hidden items-center gap-6 lg:flex" aria-label="Điều hướng chính">
            @foreach ($navItems as $item)
                <x-public.nav-link
                    :href="route($item['route'])"
                    :label="$item['label']"
                    :active="request()->routeIs($item['pattern'])"
                />
            @endforeach
        </nav>

        <div class="hidden lg:block">
            <x-public.button variant="primary" :href="route('im-new')">
                Kết nối ngay
            </x-public.button>
        </div>

        <details
            class="relative lg:hidden group"
            ontoggle="const s=this.querySelector('summary'); if(s){ s.setAttribute('aria-expanded', this.open ? 'true' : 'false'); s.setAttribute('aria-label', this.open ? 'Đóng menu' : 'Mở menu'); }"
        >
            <summary
                class="flex h-11 w-11 cursor-pointer list-none items-center justify-center rounded-md text-primary transition duration-150 ease-out hover:bg-primary-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary [&::-webkit-details-marker]:hidden"
                aria-label="Mở menu"
                aria-expanded="false"
                aria-controls="mobile-nav-panel"
            >
                <x-public.icon name="menu" size="md" class="group-open:hidden" />
                <x-public.icon name="close" size="md" class="hidden group-open:block" />
            </summary>

            <div
                id="mobile-nav-panel"
                class="absolute right-0 z-50 mt-2 w-56 rounded-lg border border-border bg-surface py-2 shadow-lg transition duration-200 ease-out"
                role="navigation"
                aria-label="Menu điện thoại"
            >
                @foreach ($navItems as $item)
                    <x-public.nav-link
                        :href="route($item['route'])"
                        :label="$item['label']"
                        :active="request()->routeIs($item['pattern'])"
                        class="block min-h-11 px-4 py-3"
                    />
                @endforeach
                <div class="border-t border-border px-4 py-3">
                    <x-public.button variant="primary" :href="route('im-new')" block>
                        Kết nối ngay
                    </x-public.button>
                </div>
            </div>
        </details>
    </x-public.container>
</header>
