@props([
    'href',
    'image',
    'title',
    'alt',
])

<a
    href="{{ $href }}"
    {{ $attributes->class([
        'group relative block aspect-[4/3] overflow-hidden rounded-lg shadow-md',
        'focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary',
    ]) }}
>
    <img
        src="{{ asset($image) }}"
        alt=""
        class="absolute inset-0 h-full w-full object-cover transition duration-300 ease-out group-hover:scale-105"
    >
    <span class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/35 to-primary/10" aria-hidden="true"></span>
    <span class="absolute inset-x-0 bottom-0 p-5 font-display text-3xl font-bold leading-tight text-on-primary sm:p-6 sm:text-4xl">
        <span class="sr-only">{{ $alt }}: </span>{{ $title }}
    </span>
</a>
