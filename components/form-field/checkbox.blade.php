@php
    $formField_label = $attributes->get('label');
    $formField_id = $attributes->get('id') ?? Str::uuid();
    $formField_alignEnd = $attributes->get('align-end');
@endphp

<x-form-field :label="$formField_label" :id="$formField_id" :align-end="$formField_alignEnd">
    <x-checkbox {{ $attributes->except(['label', 'id', 'align-end']) }} />
</x-form-field>

@push('post-mdc-auto-init-js')
    document.getElementById('{{ $formField_id }}').MDCFormField.input = document.getElementById('{{ $formField_id }}-checkbox').MDCCheckbox;
@endpush
