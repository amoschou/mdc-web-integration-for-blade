@php
    foreach ([
        'nonInteractive' => null,
        'role' => null,
        'multi' => null,
        'label' => null,
        'tabindex' => null,
    ] as $variableName => $defaultValue) {
        ${$variableName} = ${$variableName} ?? $defaultValue;
    }
@endphp

<ul
    class="mdc-list"
    data-evolution="true"
    @if (! is_null($role)) role="{{ $role }}" @endif
    @if ($multi && $role === 'listbox') aria-multiselectable="true" @endif
    @if ($label) aria-label="{{ $label }}" @endif
    @if (! is_null($tabindex)) tabindex="{{ $tabindex }}" @endif
>{{ $slot }}</ul>
