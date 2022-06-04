@props([
    'id' => Str::uuid(),
    'no-js' => false,
    'float-above' => false,
    'shake' => false,
    'required' => false,
])

@php
    $noJs = filter_var(${'no-js'}, FILTER_VALIDATE_BOOLEAN);
    $floatAbove = filter_var(${'float-above'}, FILTER_VALIDATE_BOOLEAN);
    $shake = filter_var($shake, FILTER_VALIDATE_BOOLEAN);
    $required = filter_var($required, FILTER_VALIDATE_BOOLEAN);

    $usesJavascript = ! $noJs;

    $attributes = $attributes->merge([
        'class' => Arr::toCssClasses([
            'mdc-floating-label',
            'mdc-floating-label--float-above' => $floatAbove,
            'mdc-floating-label--shake' => $shake,
            'mdc-floating-label--required' => $required
        ]),
        'id' => $id,
    ]);
@endphp

<span {{ $attributes }}>{{ $slot }}</span>

@push('post-mdc-auto-init-js')
    {{-- See: https://github.com/material-components/material-components-web/tree/master/packages/mdc-floating-label#mdcfloatinglabel-properties-and-methods --}}
@endpush
