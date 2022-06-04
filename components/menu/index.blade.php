@props([
    'js-handle' => null,
    'id' => Str::uuid(),
])

@php
    $jsHandle = ${'js-handle'}; unset(${'js-handle'});
    $attributes = $attributes->merge([
        'class' => Arr::toCssClasses([
            'mdc-menu',
            'mdc-menu-surface',
        ]),
        'data-mdc-auto-init' => 'MDCMenu',
        'id' => $id,
    ]);
@endphp

<div {{ $attributes }}>
    <ul class="mdc-deprecated-list" role="menu" aria-hidden="true" aria-orientation="vertical" tabindex="-1">
        {{ $slot }}
    </ul>
</div>

@push('post-mdc-auto-init-js')
    const {{ $jsHandle }} = document.getElementById('{{ $id }}').MDCMenu;
@endpush
