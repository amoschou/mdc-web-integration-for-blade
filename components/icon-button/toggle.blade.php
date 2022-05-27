{{--



--}}

@props([
    'icon-on',
    'icon-off',
    'on',
    'no-ripple',
    'no-focus-ring',
    'no-touch-target',
    'no-touch-target-wrapper',
    'aria-label', 'aria-label-on', 'aria-label-off'
])

@php
    $id = Str::uuid();

    $hasRipple = ! (boolean) ($noRipple ?? false);
    $hasFocusRing = ! (boolean) ($noFocusRing ?? false);
    $hasTouchTarget = ! (boolean) ($noTouchTarget ?? false);
    $hasTouchTargetWrapper = $hasTouchTarget && ! (boolean) ($noTouchTargetWrapper ?? false);

    $iconOn = $iconOn ?? null; // DO NOT CAST HERE (could be a string or a slot)
    $iconOff = $iconOff ?? null; // DO NOT CAST HERE (could be a string or a slot)
    $toggleIsOn = (boolean) ($on ?? false);

    $ariaLabel = (string) ($ariaLabel ?? null);
    $ariaLabelOn = (string) ($ariaLabelOn ?? null);
    $ariaLabelOff = (string) ($ariaLabelOff ?? null);
    $hasLabel = strlen($ariaLabel) > 0;

    $ariaLabelOn = (boolean) ($ariaLabelOn ?? false);
    $ariaLabelOff = (boolean) ($ariaLabelOff ?? false);
    $ariaLabel = $ariaLabel ?? ($toggleIsOn ? $ariaLabelOn : $ariaLabelOff);

    $hasIconOn = strlen((string) $iconOn) > 0; // CAST HERE (string remains string, slot become string)
    $hasIconOff = strlen((string) $iconOff) > 0; // CAST HERE (string remains string, slot becomes string)
    $iconOnIsSlot = gettype($iconOn) === 'object' && $iconOn::class === 'Illuminate\View\ComponentSlot';
    $iconOffIsSlot = gettype($iconOff) === 'object' && $iconOff::class === 'Illuminate\View\ComponentSlot';
    if (! $iconOnIsSlot) {
        // "CAST" TO SLOT
        $iconOn = new Illuminate\View\ComponentSlot('<span class="material-icons">' . $iconOn . '</span>');
    }
    if (! $iconOffIsSlot) {
        // "CAST" TO SLOT
        $iconOff = new Illuminate\View\ComponentSlot('<span class="material-icons">' . $iconOff . '</span>');
    }
    // CAN NOW ASSUME IN THE COMPONENT THAT $iconOn AND $iconOff ARE SLOTS.

    $htmlFieldset = $attributes->has('href') ? 'a' : 'button';

    $cssClasses = Arr::toCssClasses([
        'mdc-icon-button',
        'mdc-icon-button--on' => $toggleIsOn,
    ]);
@endphp

@if ($hasTouchTargetWrapper)
    <div class="mdc-touch-target-wrapper">
@endif
        <{{ $htmlFieldset }}
            id="{{ $id }}"
            class="{{ $cssClasses }}"
            @if ($ariaLabel) aria-label="{{ $ariaLabel }}" @endif
            @if ($ariaLabelOn) data-aria-label-on="{{ $ariaLabelOn }}" @endif
            @if ($ariaLabelOff) data-aria-label-off="{{ $ariaLabelOff }}" @endif
            @if ($toggleIsOn) aria-pressed="true" @else aria-pressed="false" @endif
            data-mdc-auto-init="MDCIconButtonToggle"
        >
            <div class="mdc-icon-button__ripple"></div>
            <span class="mdc-icon-button__focus-ring"></span>
            <span class="mdc-icon-button__icon mdc-icon-button__icon--on">{{ $iconOn }}</span>
            <span class="mdc-icon-button__icon">{{ $iconOff }}</span>
        </{{ $htmlFieldset }}>
@if ($hasTouchTargetWrapper)
    </div>
@endif

@push('post-mdc-auto-init-js')
    document.getElementById('{{ $id }}').MDCRipple.unbounded = true;
@endpush
