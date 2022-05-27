@props([
    'no-touch-target' => false,
    'no-touch-target-wrapper' => false,
    'disabled' => false, // MDCCheckbox property
    'indeterminate' => false, // MDCCheckbox property
    'checked' => false, // MDCCheckbox property
    'no-js' => false,
    'no-focus-ring' => false,
    'name' => false,
    'value' => false, // MDCCheckbox property
])

@aware([
    'id' => Str::uuid(),
])

@php
    foreach ([
        'no-touch-target',
        'no-touch-target-wrapper',
        'no-js',
        'no-focus-ring',
    ] as $kebabString) { ${Str::camel($kebabString)} = $$kebabString; unset($$kebabString); }

    // VALIDATE INPUTS
    $noTouchTarget = filter_var($noTouchTarget, FILTER_VALIDATE_BOOLEAN);
    $noTouchTargetWrapper = filter_var($noTouchTargetWrapper, FILTER_VALIDATE_BOOLEAN);
    $disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
    $indeterminate = filter_var($indeterminate, FILTER_VALIDATE_BOOLEAN);
    $checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
    $noJs = filter_var($noJs, FILTER_VALIDATE_BOOLEAN);
    $noFocusRing = filter_var($noFocusRing, FILTER_VALIDATE_BOOLEAN);
    abort_unless(strlen($id) > 0, 500, "Bad id for checkbox.");
    // abort_unless(strlen($inputId) > 0, 500);

    // GENERATE CONTROL FLAGS
    $hasTouchTarget = ! $noTouchTarget;
    $hasTouchTargetWrapper = $hasTouchTarget && ! $noTouchTargetWrapper;
    $isDisabled = $disabled;
    $usesJavascript = ! $noJs;
    $hasFocusRing = ! $noFocusRing;
    $isIndeterminate = $indeterminate && ! $checked;
    $isSelected = ! $indeterminate && $checked;
    $hasName = ! is_null($name);
    $hasValue = ! is_null($value);

    // BUILD ATTRIBUTES
    $componentAttributes = $attributes->merge(array_merge(
        [
            'id' => "{$id}-checkbox",
            'class' => Arr::toCssClasses([
                'mdc-checkbox',
                'mdc-checkbox--selected' => $isSelected,
                'mdc-checkbox--disabled' => $isDisabled && ! $usesJavascript,
                'mdc-checkbox--touch' => $hasTouchTarget,
            ]),
        ],
        $usesJavascript ? ['data-mdc-auto-init' => 'MDCCheckbox'] : [],
        // ['aria-label' => ($hasLabel ? $label : null) ?? (! $iconIsSlot ? $icon : null) ?? false],
    ));

    $inputAttributes = (new \Illuminate\View\ComponentAttributeBag())->merge([
        'id' => "{$id}-input",
        'type' => 'checkbox',
        'class' => 'mdc-checkbox__native-control',
        'disabled' => $isDisabled,
        'checked' => $isSelected,
        'name' => $hasName ? $name : false,
        'value' => $hasValue ? $value : false,
        'data-indeterminate' => $isIndeterminate ? 'true' : false,
    ]);
@endphp

@if ($hasTouchTargetWrapper)
    <div class="mdc-touch-target-wrapper">
@endif
        <div {{ $componentAttributes }}>
            <input {{ $inputAttributes }} />
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
            <div class="mdc-checkbox__ripple"></div>
            @if ($hasFocusRing) <div class="mdc-checkbox__focus-ring"></div> @endif
        </div>
@if ($hasTouchTargetWrapper)
    </div>
@endif

@push('post-mdc-auto-init-js')
    // console.log(document.getElementById('{{ $id }}-checkbox').MDCCheckbox.checked);
    // console.log(document.getElementById('{{ $id }}-checkbox').MDCCheckbox.indeterminate);
    // console.log(document.getElementById('{{ $id }}-checkbox').MDCCheckbox.disabled);
    // console.log(document.getElementById('{{ $id }}-checkbox').MDCCheckbox.value);
@endpush


