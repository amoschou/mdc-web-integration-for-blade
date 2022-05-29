@props([
    'range' => false,
    'min-range' => null,
    'input-slot-nameless' => $__laravel_slots[''] ?? null,
    'input-slot-lower-bound' => $__laravel_slots['lower-bound'] ?? null,
    'input-slot-upper-bound' => $__laravel_slots['upper-bound'] ?? null,
    'discrete' => false,
    'tick-marks' => false,
    'disabled' => false,
])

@php
    $range = filter_var($range, FILTER_VALIDATE_BOOLEAN);
    $discrete = filter_var($discrete, FILTER_VALIDATE_BOOLEAN);
    $minRange = filter_var(${'min-range'}, FILTER_VALIDATE_FLOAT);
    $tickMarks = filter_var(${'tick-marks'}, FILTER_VALIDATE_BOOLEAN);
    $disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);


    $isRange = $range;
    $hasMinRange = $isRange && ! is_null($minRange);
    $isDiscrete = $discrete;
    $hasTickMarks = $isDiscrete && $tickMarks;
    $isDisabled = $disabled;

    $inputSlotNameless = ${'input-slot-nameless'};
    $inputSlotLowerBound = ${'input-slot-lower-bound'};
    $inputSlotUpperBound = ${'input-slot-upper-bound'};

    // Default slot
    if ($isRange) {
        $slotAttributes = (object) [
            'lowerMin' => $inputSlotLowerBound->attributes->get('min'),
            'lowerMax' => $inputSlotLowerBound->attributes->get('max'),
            'lowerStep' => $inputSlotLowerBound->attributes->get('step'),
            'lowerValue' => $inputSlotLowerBound->attributes->get('value'),
            'upperMin' => $inputSlotUpperBound->attributes->get('min'),
            'upperMax' => $inputSlotUpperBound->attributes->get('max'),
            'upperStep' => $inputSlotUpperBound->attributes->get('step'),
            'upperValue' => $inputSlotUpperBound->attributes->get('value'),
        ];
        $lowerValueIsValid = ($slotAttributes->lowerValue - $slotAttributes->lowerMin) % $slotAttributes->lowerStep === 0;
        $upperValueIsValid = ($slotAttributes->upperValue - $slotAttributes->upperMin) % $slotAttributes->upperStep === 0;
        $inputSlotLowerBoundAttributes = $inputSlotLowerBound->attributes->except(['label', 'labelled-by', 'value-text', 'value'])->merge([
            'class' => 'mdc-slider__input',
            'type' => 'range',
            'aria-label' => $inputSlotLowerBound->attributes->get('label') ?? false,
            'aria-labelledby' => $inputSlotLowerBound->attributes->get('labelled-by') ?? false,
            'aria-valuetext' => $inputSlotLowerBound->attributes->get('value-text') ?? false,
            'value' => $lowerValueIsValid ? $slotAttributes->lowerValue : $slotAttributes->lowerMin,
            'disabled' => $isDisabled ? true : false,
        ]);
        $inputSlotUpperBoundAttributes = $inputSlotUpperBound->attributes->except(['label', 'labelled-by', 'value-text', 'value'])->merge([
            'class' => 'mdc-slider__input',
            'type' => 'range',
            'aria-label' => $inputSlotUpperBound->attributes->get('label') ?? false,
            'aria-labelledby' => $inputSlotUpperBound->attributes->get('labelled-by') ?? false,
            'aria-valuetext' => $inputSlotUpperBound->attributes->get('value-text') ?? false,
            'value' => $upperValueIsValid ? $slotAttributes->upperValue : $slotAttributes->upperMin,
            'disabled' => $isDisabled ? true : false,
        ]);
    } else {
        $slotAttributes = (object) [
            'min' => $inputSlotNameless->attributes->get('min'),
            'max' => $inputSlotNameless->attributes->get('max'),
            'step' => $inputSlotNameless->attributes->get('step'),
            'value' => $inputSlotNameless->attributes->get('value'),
        ];
        $valueIsValid = ($slotAttributes->value - $slotAttributes->min) % $slotAttributes->step === 0;
        $tickMarksAreValid = ($slotAttributes->max - $slotAttributes->min) % $slotAttributes->step === 0;
        $inputSlotNamelessAttributes = $inputSlotNameless->attributes->except(['label', 'labelled-by', 'value-text', 'value'])->merge([
            'class' => 'mdc-slider__input',
            'type' => 'range',
            'aria-label' => $inputSlotNameless->attributes->get('label') ?? false,
            'aria-labelledby' => $inputSlotNameless->attributes->get('labelled-by') ?? false,
            'aria-valuetext' => $inputSlotNameless->attributes->get('value-text') ?? false,
            'value' => $valueIsValid ? $slotAttributes->value : $slotAttributes->min,
            'disabled' => $isDisabled ? true : false,
        ]);
    }
@endphp

<div
    class="
        mdc-slider
        @if ($isRange) mdc-slider--range @endif
        @if ($isDiscrete) mdc-slider--discrete @endif
        @if ($hasTickMarks && $tickMarksAreValid) mdc-slider--tick-marks @endif
        @if ($isDisabled) mdc-slider--disabled @endif
    "
    @if ($hasMinRange) data-min-range="{{ $minRange }}" @endif
    data-mdc-auto-init="MDCSlider"
>
    @if ($isRange)
        <input {{ $inputSlotLowerBoundAttributes }}>
        <input {{ $inputSlotUpperBoundAttributes }}>
    @else
        <input {{ $inputSlotNamelessAttributes }}>
    @endif
    <div class="mdc-slider__track">
        <div class="mdc-slider__track--inactive"></div>
        <div class="mdc-slider__track--active">
            <div class="mdc-slider__track--active_fill"></div>
        </div>
        @if ($hasTickMarks && $tickMarksAreValid)
            <div class="mdc-slider__tick-marks">
                @for ($i = 0 ; $i < 1 ; $i++) <div class="mdc-slider__tick-mark--active"></div> @endfor
                @for ($i = 0 ; $i < 1 ; $i++) <div class="mdc-slider__tick-mark--inactive"></div> @endfor
            </div>
        @endif
    </div>
        @foreach ($isRange ? [$inputSlotUpperBound, $inputSlotLowerBound] : [$inputSlotNameless] as $inputSlot)
            <div class="mdc-slider__thumb">
                @if ($isDiscrete)
                    <div class="mdc-slider__value-indicator-container" aria-hidden="true">
                        <div class="mdc-slider__value-indicator">
                            <span class="mdc-slider__value-indicator-text">{{ $inputSlot->attributes->get('value') }}</span>
                        </div>
                    </div>
                @endif
                <div class="mdc-slider__thumb-knob"></div>
            </div>
        @endforeach
</div>
