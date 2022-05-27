@props([
    'align-end' => false,
    'label' => '',
    'id' => Str::uuid(),
    'wrapped-slot' => false,
])

@php
    foreach (['align-end', 'wrapped-slot'] as $kebabString) { ${Str::camel($kebabString)} = $$kebabString; unset($$kebabString); }

    $formFieldHasId = strlen($id) > 0;
    $isAlignedEnd = $alignEnd;

    $wrappedSlot = filter_var($wrappedSlot, FILTER_VALIDATE_BOOLEAN);
    $hasWrappedSlot = $wrappedSlot;

    $componentAttributes = $attributes->merge([
        'id' => $formFieldHasId ? $id : false,
        'class' => Arr::toCssClasses([
            'mdc-form-field',
            'mdc-form-field--align-end' => $isAlignedEnd,
        ]),
        'data-mdc-auto-init' => 'MDCFormField',
    ]);

    $labelAttributes = (
        $label instanceof \Illuminate\View\ComponentSlot
            ? $label->attributes
            : new \Illuminate\View\ComponentAttributeBag()
    )->merge([
        'for' => "{$id}-input",
    ]);
@endphp

<div {{ $componentAttributes }}>
    @if ($hasWrappedSlot)
        <div style="height: 48px; display: flex; justify-content: left; align-items: center; margin-left:2px; margin-right: 10px;">
    @endif
            {{ $slot }}
    @if ($hasWrappedSlot)
        </div>
    @endif
    <label {{ $labelAttributes }}>{{ $label }}</label>
</div>


{{--const formField = new MDCFormField(document.querySelector('.mdc-form-field'));--}}
{{--const checkbox = new MDCCheckbox(document.querySelector('.mdc-checkbox'));--}}
{{--formField.input = checkbox;--}}


{{--@push('post-mdc-auto-init-js')--}}
{{--    document.getElementById('{{ $id }}').MDCFormField;--}}

{{--@endpush--}}
