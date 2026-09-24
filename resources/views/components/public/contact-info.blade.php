@props([
    'churchInfo',
    'tone' => 'default',
    'showAddress' => true,
])

@php
    $contact = $churchInfo->contact_info ?? [];
    $labelClass = $tone === 'inverse' ? 'text-on-inverse' : 'text-primary';
    $bodyClass = $tone === 'inverse' ? 'text-on-inverse-muted' : 'text-muted';
    $linkClass = $tone === 'inverse'
        ? 'text-on-inverse-muted transition duration-150 ease-out hover:text-on-inverse focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-on-inverse'
        : 'text-muted transition duration-150 ease-out hover:text-primary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary';
@endphp

<div {{ $attributes->class(['space-y-3 text-sm']) }}>
    @if ($showAddress && $churchInfo->address)
        <div>
            <span class="font-semibold {{ $labelClass }}">Địa chỉ:</span>
            <span class="{{ $bodyClass }}"> {{ $churchInfo->address }}</span>
        </div>
    @endif

    @if (! empty($contact['phone']))
        <div>
            <span class="font-semibold {{ $labelClass }}">Điện thoại:</span>
            <a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}" class="{{ $linkClass }}">
                {{ $contact['phone'] }}
            </a>
        </div>
    @endif

    @if (! empty($contact['email']))
        <div>
            <span class="font-semibold {{ $labelClass }}">Email:</span>
            <a href="mailto:{{ $contact['email'] }}" class="{{ $linkClass }}">
                {{ $contact['email'] }}
            </a>
        </div>
    @endif
</div>
