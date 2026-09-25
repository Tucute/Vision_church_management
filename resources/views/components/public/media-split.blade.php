@props([
    'image',
    'alt',
    'imageFirst' => true,
])

<div {{ $attributes->class(['grid items-center gap-8 lg:grid-cols-2 lg:gap-12']) }}>
    <figure @class(['order-1', 'lg:order-1' => $imageFirst, 'lg:order-2' => ! $imageFirst])>
        <img
            src="{{ asset($image) }}"
            alt="{{ $alt }}"
            class="aspect-[4/3] w-full rounded-lg object-cover shadow-md"
            width="1200"
            height="900"
        >
        <figcaption class="ui-caption mt-3 text-muted">Ảnh demo</figcaption>
    </figure>

    <div @class(['order-2', 'lg:order-2' => $imageFirst, 'lg:order-1' => ! $imageFirst])>
        {{ $slot }}
    </div>
</div>
