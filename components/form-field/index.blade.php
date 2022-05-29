@props([
    'align-end' => false,
    'label' => null,
    'id' => Str::uuid(),
    'wrapped-switch' => false,
])

@php
    foreach (['align-end', 'wrapped-switch'] as $kebabString) { ${Str::camel($kebabString)} = $$kebabString; unset($$kebabString); }

    $formFieldHasId = strlen($id) > 0;
    $isAlignedEnd = $alignEnd;

    $wrappedSwitch = filter_var($wrappedSwitch, FILTER_VALIDATE_BOOLEAN);
    $hasWrappedSwitch = $wrappedSwitch;
    $hasLabel = ! is_null($label);

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
    @if ($hasWrappedSwitch)
        <div style="height: 20px; padding: 10px 2px; margin: 4px; display: flex; justify-content: left; align-items: center;">{{ $slot }}</div>
    @else
        {{ $slot }}
    @endif
    @if ($hasLabel) <label {{ $labelAttributes }}>{{ $label }}</label> @endif
</div>


{{--const formField = new MDCFormField(document.querySelector('.mdc-form-field'));--}}
{{--const checkbox = new MDCCheckbox(document.querySelector('.mdc-checkbox'));--}}
{{--formField.input = checkbox;--}}


{{--@push('post-mdc-auto-init-js')--}}
{{--    document.getElementById('{{ $id }}').MDCFormField;--}}

{{--@endpush--}}
