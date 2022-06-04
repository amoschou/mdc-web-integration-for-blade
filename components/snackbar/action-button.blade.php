@props([
    'label' => '',
])

@php
    $class = Arr::toCssClasses([
        'mdc-button' => false, // This is already included in the button component, exclude here to avoid duplication.
        'mdc-snackbar__action',
    ]);
@endphp

<x-button type="button" class="{{ $class }}" label="{{ $label }}" no-js no-touch-target no-focus-ring />
{{-- no-js is part of the spec! --}}

