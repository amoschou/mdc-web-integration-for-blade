@php
    $formField_label = $attributes->get('label');
    $formField_id = $attributes->get('id') ?? Str::uuid();
    $formField_alignEnd = $attributes->get('align-end');
@endphp

<x-m2.form-field :label="$formField_label" :id="$formField_id" :align-end="$formField_alignEnd">
    <x-m2.radio {{ $attributes->except(['label', 'id', 'align-end']) }}></x-m2.radio>
</x-m2.form-field>

@push('post-mdc-auto-init-js')
    document.getElementById('{{ $formField_id }}').MDCFormField.input = document.getElementById('{{ $formField_id }}-radio').MDCRadio;
@endpush
