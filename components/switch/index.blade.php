@props([
    'disabled' => false, // MDCSwitch property
    'selected' => false, // MDCSwitch property
    'label' => null,
    'id' => Str::uuid(),
    'js-handle' => null,
])

@php
    $disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
    $selected = filter_var($selected, FILTER_VALIDATE_BOOLEAN);
    $hasLabel = ! is_null($label);
    $isDisabled = $disabled;
    $isSelected = $selected;
    $jsHandle = ${'js-handle'}; unset(${'js-handle'});
    $hasJsHandle = ! is_null($jsHandle);
@endphp

<button
    id="{{ $id }}"
    class="mdc-switch @if ($isSelected) mdc-switch--selected @else mdc-switch--unselected @endif"
    type="button"
    role="switch"
    @if ($isSelected) aria-checked="true" @else aria-checked="false" @endif
    data-mdc-auto-init="MDCSwitch"
    @if ($isDisabled) disabled @endif
>
    <div class="mdc-switch__track"></div>
    <div class="mdc-switch__handle-track">
        <div class="mdc-switch__handle">
            <div class="mdc-switch__shadow">
                <div class="mdc-elevation-overlay"></div>
            </div>
            <div class="mdc-switch__ripple"></div>
            <div class="mdc-switch__icons">
                <svg class="mdc-switch__icon mdc-switch__icon--on" viewBox="0 0 24 24">
                    <path d="M19.69,5.23L8.96,15.96l-4.23-4.23L2.96,13.5l6,6L21.46,7L19.69,5.23z" />
                </svg>
                <svg class="mdc-switch__icon mdc-switch__icon--off" viewBox="0 0 24 24">
                    <path d="M20 13H4v-2h16v2z" />
                </svg>
            </div>
        </div>
    </div>
    <span class="mdc-switch__focus-ring-wrapper">
        <div class="mdc-switch__focus-ring"></div>
    </span>
</button>
@if ($hasLabel) <label for="{{ $id }}">{{ $label }}</label> @endif

@push('post-mdc-auto-init-js')
    @if ($hasJsHandle)
        const {{ $jsHandle }} = document.getElementById('{{ $id }}').MDCSwitch;
    @endif
    document.getElementById('{{ $id }}').MDCSwitch.selected = {{ $isSelected ? 'true' : 'false' }};
    document.getElementById('{{ $id }}').MDCSwitch.disabled = {{ $isDisabled ? 'true' : 'false' }};
@endpush
