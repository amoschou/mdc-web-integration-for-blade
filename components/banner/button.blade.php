@props([
    'label',
    'secondary',
])

@php
    $label = (string) ($label ?? null);
    $secondary = filter_var($secondary ?? null, FILTER_VALIDATE_BOOLEAN);

    $isPrimary = ! $secondary;
    $isSecondary = $secondary;

    $class = $isSecondary ? 'mdc-banner__secondary-action' : 'mdc-banner__primary-action';
@endphp

<button type="button" class="mdc-button {{ $class }}">
    <div class="mdc-button__ripple"></div>
    <div class="mdc-button__label">{{ $label }}</div>
</button>
