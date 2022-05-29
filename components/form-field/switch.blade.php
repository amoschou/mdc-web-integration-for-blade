@php
    $formField_label = $attributes->get('label');
    $formField_id = $attributes->get('id') ?? Str::uuid();
    $formField_alignEnd = $attributes->get('align-end');
    $switch_id = "{$formField_id}-switch";
@endphp

<x-form-field :label="$formField_label" :id="$formField_id" :align-end="$formField_alignEnd" wrapped-switch>
    <x-switch {{ $attributes->except(['label', 'id', 'align-end']) }} :id="$switch_id" />
    <x-slot name="label" style="{{ $formField_alignEnd ? 'padding-right' : 'padding-left' }}: 4px" :for="$switch_id">{{ $formField_label }}</x-slot>
</x-form-field>

@push('post-mdc-auto-init-js')
    document.getElementById('{{ $formField_id }}').MDCFormField.input = document.getElementById('{{ $switch_id }}').MDCSwitch;
@endpush


