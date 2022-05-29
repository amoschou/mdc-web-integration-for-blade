@props([
    'indeterminate' => false,
    'closed' => false,
    'label' => 'Linear progress bar',
    'min' => '0',
    'max' => '1',
    'now' => 0,
    'rtl' => false,
    'js-handle' => null,
    'id' => Str::uuid(),
])

@php
    $indeterminate = filter_var($indeterminate, FILTER_VALIDATE_BOOLEAN);
    $closed = filter_var($closed, FILTER_VALIDATE_BOOLEAN);
    $rtl = filter_var($rtl, FILTER_VALIDATE_BOOLEAN);
    $jsHandle = ${'js-handle'};

    $isIndeterminate = $indeterminate;
    $isClosed = $closed;
    $isRtl = $rtl;
    $hasJsHandle = ! is_null($jsHandle);

    $attributes = $attributes->merge([
        'role' => 'progressbar',
        'class' => Arr::toCssClasses([
            'mdc-linear-progress',
            'mdc-linear-progress--indeterminate' => $isIndeterminate,
            'mdc-linear-progress--closed' => $isClosed,
        ]),
        'aria-label' => $label,
        'aria-valuemin' => $min,
        'aria-valuemax' => $max,
        'aria-valuenow' => $now,
        'data-mdc-auto-init' => 'MDCLinearProgress',
        'dir' => $isRtl ? 'rtl' : false,
        'id' => $id,
    ]);
@endphp

<div {{ $attributes }}>
    <div class="mdc-linear-progress__buffer">
        <div class="mdc-linear-progress__buffer-bar"></div>
        <div class="mdc-linear-progress__buffer-dots"></div>
    </div>
    <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
        <span class="mdc-linear-progress__bar-inner"></span>
    </div>
    <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
        <span class="mdc-linear-progress__bar-inner"></span>
    </div>
</div>

@push('post-mdc-auto-init-js')
    @if ($hasJsHandle)
        const {{ $jsHandle }} = document.getElementById('{{ $id }}').MDCLinearProgress;
    @endif
@endpush
