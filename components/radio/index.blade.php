@props([
    'disabled' => false, // tick // MDCRadio property
    'checked' => false, // tick // MDCRadio property
    'name' => false, // tick
    'value' => false, // tick // MDCRadio property
    'no-touch-target' => false, // tick
    'no-touch-target-wrapper' => false, // tick
    'no-js' => false, // tick
    'no-focus-ring' => false, // tick
    'js-handle' => null,
])

@aware([
    'id' => Str::uuid(), // tick
])

@php
    foreach ([
        'no-touch-target',
        'no-touch-target-wrapper',
        'no-js',
        'no-focus-ring',
        'js-handle',
    ] as $kebabString) { ${Str::camel($kebabString)} = $$kebabString; unset($$kebabString); }

    // VALIDATE INPUTS
    $noTouchTarget = filter_var($noTouchTarget, FILTER_VALIDATE_BOOLEAN);
    $noTouchTargetWrapper = filter_var($noTouchTargetWrapper, FILTER_VALIDATE_BOOLEAN);
    $disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
    $checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
    $noJs = filter_var($noJs, FILTER_VALIDATE_BOOLEAN);
    $noFocusRing = filter_var($noFocusRing, FILTER_VALIDATE_BOOLEAN);
    abort_unless(strlen($id) > 0, 500, "Bad id for radio.");
    // abort_unless(strlen($inputId) > 0, 500);

    // GENERATE CONTROL FLAGS
    $hasTouchTarget = ! $noTouchTarget;
    $hasTouchTargetWrapper = $hasTouchTarget && ! $noTouchTargetWrapper;
    $isDisabled = $disabled;
    $usesJavascript = ! $noJs;
    $hasFocusRing = ! $noFocusRing;
    $isChecked = $checked;
    $hasName = ! is_null($name);
    $hasValue = ! is_null($value);

    $hasJsHandle = ! is_null($jsHandle);

    // BUILD ATTRIBUTES
    $componentAttributes = $attributes->merge(array_merge(
        [
            'id' => "{$id}-radio",
            'class' => Arr::toCssClasses([
                'mdc-radio',
                'mdc-radio--disabled' => $isDisabled,
                'mdc-radio--touch' => $hasTouchTarget,
            ]),
        ],
        $usesJavascript ? ['data-mdc-auto-init' => 'MDCRadio'] : [],
        // ['aria-label' => ($hasLabel ? $label : null) ?? (! $iconIsSlot ? $icon : null) ?? false],
    ));

    $inputAttributes = (new \Illuminate\View\ComponentAttributeBag())->merge([
        'id' => "{$id}-input",
        'type' => 'radio',
        'class' => 'mdc-radio__native-control',
        'disabled' => $isDisabled,
        'checked' => $isChecked,
        'name' => $hasName ? $name : false,
        'value' => $hasValue ? $value : false,
    ]);
@endphp

@if ($hasTouchTargetWrapper)
    <div class="mdc-touch-target-wrapper">
@endif
        <div {{ $componentAttributes }}>
            <input {{ $inputAttributes }} />
            <div class="mdc-radio__background">
                <div class="mdc-radio__outer-circle"></div>
                <div class="mdc-radio__inner-circle"></div>
            </div>
            <div class="mdc-radio__ripple"></div>
            @if ($hasFocusRing) <div class="mdc-radio__focus-ring"></div> @endif
        </div>
@if ($hasTouchTargetWrapper)
    </div>
@endif

@push('post-mdc-auto-init-js')
    @if ($hasJsHandle)
        const {{ $jsHandle }} = document.getElementById('{{ $id }}').MDCRadio;
    @endif
    document.getElementById('{{ $id }}').MDCRadio.checked = {{ $isChecked ? 'true' : 'false' }};
    document.getElementById('{{ $id }}').MDCRadio.disabled = {{ $isDisabled ? 'true' : 'false' }};
    @if ($hasValue) document.getElementById('{{ $id }}').MDCRadio.value = {{ $value }}; @endif
@endpush



