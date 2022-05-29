@props([
    'label' => '',
    'secondary' => false,
    'prominent' => false,
])

@php
    $secondary = filter_var($secondary, FILTER_VALIDATE_BOOLEAN);
    $prominent = filter_var($prominent, FILTER_VALIDATE_BOOLEAN);

    $isPrimary = ! $secondary;
    $isSecondary = $secondary;

    $class = $isSecondary ? 'mdc-banner__secondary-action' : 'mdc-banner__primary-action';

    $class = Arr::toCssClasses([
        'mdc-button',
        'mdc-banner__primary-action' => $isPrimary,
        'mdc-banner__secondary-action' => $isSecondary,
    ]);
@endphp

<x-button type="button" class="{{ $class }}" no-touch-target no-focus-ring label="{{ $label }}" ></x-button>
