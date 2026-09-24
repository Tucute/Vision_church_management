@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'required' => false,
    'hint' => null,
    'autocomplete' => null,
    'rows' => 3,
    'options' => [],
])

@php
    $id = $attributes->get('id', $name);
    $error = $errors->first($name);
    $describedBy = collect([
        $hint ? $id.'-hint' : null,
        $error ? $id.'-error' : null,
    ])->filter()->implode(' ');
@endphp

<div {{ $attributes->except(['id'])->class(['space-y-2']) }}>
    <label for="{{ $id }}" class="block text-sm font-semibold text-primary">
        {{ $label }}
        @if ($required)
            <span class="text-error" aria-hidden="true">*</span>
        @endif
    </label>

    @if ($type === 'textarea')
        <textarea
            id="{{ $id }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            @if ($required) required aria-required="true" @endif
            @if ($error) aria-invalid="true" @endif
            @if ($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
            class="ui-control min-h-textarea resize-y"
        >{{ old($name, $value) }}</textarea>
    @elseif ($type === 'select')
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            @if ($required) required aria-required="true" @endif
            @if ($error) aria-invalid="true" @endif
            @if ($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
            class="ui-control"
        >
            {{ $slot }}
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected((string) old($name, $value) === (string) $optionValue)>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    @else
        <input
            id="{{ $id }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            @if ($required) required aria-required="true" @endif
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if ($error) aria-invalid="true" @endif
            @if ($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
            class="ui-control"
        >
    @endif

    @if ($hint)
        <p id="{{ $id }}-hint" class="ui-small">{{ $hint }}</p>
    @endif

    @if ($error)
        <p id="{{ $id }}-error" class="text-sm text-error" role="alert">{{ $error }}</p>
    @endif
</div>
