@props([
    'label',
    'icon',
    'icon-leading',
    'icon-trailing',
    'outlined',
    'raised',
    'unelevated',
    'disabled',
    'no-js',
    'no-focus-ring',
    'no-touch-target',
    'no-touch-target-wrapper',
])

@php
    // VALIDATE INPUTS
    $label = (string) ($label ?? null);
    $icon = $icon ?? null; // ComponentSlot or string
    $iconTrailing = filter_var($iconTrailing ?? null, FILTER_VALIDATE_BOOLEAN);
    $iconLeading = filter_var($iconLeading ?? null, FILTER_VALIDATE_BOOLEAN);
    $outlined = filter_var($outlined ?? null, FILTER_VALIDATE_BOOLEAN);
    $raised = filter_var($raised ?? null, FILTER_VALIDATE_BOOLEAN);
    $unelevated = filter_var($unelevated ?? null, FILTER_VALIDATE_BOOLEAN);
    $disabled = filter_var($disabled ?? null, FILTER_VALIDATE_BOOLEAN);
    $noJs = filter_var($noJs ?? null, FILTER_VALIDATE_BOOLEAN);
    $noFocusRing = filter_var($noFocusRing ?? null, FILTER_VALIDATE_BOOLEAN);
    $noTouchTarget = filter_var($noTouchTarget ?? null, FILTER_VALIDATE_BOOLEAN);
    $noTouchTargetWrapper = filter_var($noTouchTargetWrapper ?? null, FILTER_VALIDATE_BOOLEAN);

    // GENERATE CONTROL FLAGS
    $iconIsSlot = $icon instanceof Illuminate\View\ComponentSlot; // boolean
    $hasIcon = $iconIsSlot || strlen((string) $icon) > 0; // boolean: An icon of some sort exists
    $hasLabel = strlen($label) > 0;
    $hasLeadingIcon = $hasIcon && ! $iconTrailing;
    $hasTrailingIcon = $hasIcon && ! $iconLeading && $iconTrailing && $hasLabel;
    $isDisabled = $disabled;
    $hasTouchTarget = ! $noTouchTarget;
    $hasTouchTargetWrapper = $hasTouchTarget && ! $noTouchTargetWrapper;
    $usesJavascript = ! $noJs;
    $hasFocusRing = ! $noFocusRing;
    $isOutlined = $outlined && ! $raised && ! $unelevated;
    $isRaised = ! $outlined && $raised && ! $unelevated;
    $isUnelevated = ! $outlined && ! $raised && $unelevated;

    $includesAriaLabel = $hasLabel || ($hasIcon && ! $iconIsSlot);

    // MANIPULATE ICON
    if ($iconIsSlot) {
        // TO DO LATER:
        // Manipulate the root element of the slot and include the class and aria-hidden in it.
        $iconSlot = new Illuminate\View\ComponentSlot(implode('', [
            '<span class="mdc-button__icon" aria-hidden="true">',
                $icon->toHtml(),
            '</span>',
        ]));
    } else {
        $iconSlot = is_null($icon)
            ? null
            : new Illuminate\View\ComponentSlot(implode('', [
                    '<i class="material-icons mdc-button__icon" aria-hidden="true">',
                        $icon,
                    '</i>'
                ]));
    }

    $componentAttributes = $attributes->merge([
        'class' => Arr::toCssClasses([
            'mdc-button',
            'mdc-button--outlined' => $isOutlined,
            'mdc-button--raised' => $isRaised,
            'mdc-button--unelevated' => $isUnelevated,
            'mdc-button--icon-leading' => $hasLeadingIcon,
            'mdc-button--icon-trailing' => $hasTrailingIcon,
            'mdc-button--touch' => $hasTouchTarget,
        ]),
        'data-mdc-auto-init' => $usesJavascript ? 'MDCRipple' : false,
        'disabled' => $isDisabled,
        'aria-label' => ($hasLabel ? $label : null) ?? (! $iconIsSlot ? $icon : null) ?? false,
    ]);

    $buttonOrA = $attributes->has('href') ? 'a' : 'button';
@endphp

@if ($hasTouchTargetWrapper)
    <div class="mdc-touch-target-wrapper">
@endif
        <{{ $buttonOrA }} {{ $componentAttributes }}>
            <span class="mdc-button__ripple"></span>
            @if ($hasTouchTarget) <span class="mdc-button__touch"></span> @endif
            @if ($hasFocusRing) <span class="mdc-button__focus-ring"></span> @endif
            @if ($hasLeadingIcon) {{ $iconSlot }} @endif
            @if ($hasLabel) <span class="mdc-button__label">{{ $label }}</span> @endif
            @if ($hasTrailingIcon) {{ $iconSlot }} @endif
        </{{ $buttonOrA }}>
@if ($hasTouchTargetWrapper)
    </div>
@endif
