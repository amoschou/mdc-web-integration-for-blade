@props([
    'indeterminate' => false,
    'closed' => false,
    'label' => null,
    'now' => '0',
    'rtl' => false,
    'js-handle' => null,
    'id' => Str::uuid(),
    'buffer' => '1',
    'no-init' => false,
])

@php
    $indeterminate = filter_var($indeterminate, FILTER_VALIDATE_BOOLEAN);
    $closed = filter_var($closed, FILTER_VALIDATE_BOOLEAN);
    $rtl = filter_var($rtl, FILTER_VALIDATE_BOOLEAN);
    $noInit = filter_var(${'no-init'}, FILTER_VALIDATE_BOOLEAN); unset(${'no-init'});
    $jsHandle = ${'js-handle'}; unset(${'js-handle'});

    $isIndeterminate = $indeterminate;
    $isClosed = $closed;
    $isRtl = $rtl;
    $hasJsHandle = ! is_null($jsHandle);
    $isInit = ! $noInit;

    $attributes = $attributes->merge([
        'role' => 'progressbar',
        'class' => Arr::toCssClasses([
            'mdc-linear-progress',
            'mdc-linear-progress--indeterminate' => $isIndeterminate,
            'mdc-linear-progress--closed' => $isClosed,
        ]),
        'aria-label' => $label ?? false,
        'aria-valuemin' => '0',
        'aria-valuemax' => '1',
        'aria-valuenow' => $now,
        'data-mdc-auto-init' => $isInit ? 'MDCLinearProgress' : false,
        'dir' => $isRtl ? 'rtl' : false,
        'id' => $id,
    ]);
@endphp

<div {{ $attributes }}>
    <div class="mdc-linear-progress__buffer">
        <div class="mdc-linear-progress__buffer-bar"
             @if (! $isIndeterminate) style="flex-basis: {{ 100*$buffer }}%;" @endif
        ></div>
        <div class="mdc-linear-progress__buffer-dots"></div>
    </div>
    <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar"
         @if (! $isIndeterminate) style="transform: scaleX({{ $now }});" @endif
    >
        <span class="mdc-linear-progress__bar-inner"></span>
    </div>
    <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
        <span class="mdc-linear-progress__bar-inner"></span>
    </div>
</div>

@push('post-mdc-auto-init-js')
    @if (! $noInit)
        document.getElementById('{{ $id }}').MDCLinearProgress.determinate = {{ $isIndeterminate ? 'false' : 'true' }};
        document.getElementById('{{ $id }}').MDCLinearProgress.progress = {{ $now }};
        document.getElementById('{{ $id }}').MDCLinearProgress.buffer = {{ $buffer }};
        @if ($isClosed)
            document.getElementById('{{ $id }}').MDCLinearProgress.close();
        @else
            document.getElementById('{{ $id }}').MDCLinearProgress.open();
        @endif
        @if ($hasJsHandle)
            const {{ $jsHandle }} = document.getElementById('{{ $id }}').MDCLinearProgress;
        @endif
    @endif
@endpush
