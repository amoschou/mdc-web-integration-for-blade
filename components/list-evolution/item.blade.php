@aware([
'role' => null,
'multi' => null,
])

@props([
'disabled', 'selected', 'activated',
'lines',
'control', 'start', 'end',
'overlineText', 'primaryText', 'secondaryText'
])

@php
    foreach ([ // Documented properties
        'disabled' => false,
        'selected' => false,
        'activated' => false,
        'lines' => 1,
        'control' => null,
        'start' => null,
        'end' => null,
    ] as $variableName => $defaultValue) {
        ${$variableName} = ${$variableName} ?? $defaultValue;
    }

    $lines = in_array($lines, ['1', '2', '3', 'one', 'two', 'three']) ? $lines : '1';
    $hasLeadingControl = $start === 'control' && $end !== 'control';
    $hasTrailingControl = $start !== 'control' && $end === 'control';
    $hasControl = $hasLeadingControl || $hasTrailingControl;
    $isInteractive = in_array($role, ['menu', 'listbox']);

    $id = $id ?? Str::uuid();
    $cssClasses = Arr::toCssClasses([
        'mdc-list-item',
        'mdc-list-item--disabled' => $isInteractive && $disabled,
        'mdc-list-item--selected' => $isInteractive && ! $hasControl && $selected,
        'mdc-list-item--activated' => $isInteractive && ! $hasControl && $activated,
        'mdc-list-item--non-interactive' => ! $isInteractive,
        'mdc-list-item--with-one-line' => in_array($lines, ['1', 'one']),
        'mdc-list-item--with-two-lines' => in_array($lines, ['2', 'two']),
        'mdc-list-item--with-three-lines' => in_array($lines, ['3', 'three']),
        'mdc-list-item--with-leading-checkbox' => $hasLeadingControl && $control === 'checkbox' && $role === 'listbox' && ! is_null($multi),
        'mdc-list-item--with-leading-radio' => $hasLeadingControl && $control === 'radio' && $role === 'listbox' && is_null($multi),
        'mdc-list-item--with-leading-switch' => $hasLeadingControl && $control === 'switch' && $role === 'listbox' && is_null($multi),
        'mdc-list-item--with-trailing-checkbox' => $hasTrailingControl && $control === 'checkbox' && $role === 'listbox' && ! is_null($multi),
        'mdc-list-item--with-trailing-radio' => $hasTrailingControl && $control === 'radio' && $role === 'listbox' && is_null($multi),
        'mdc-list-item--with-trailing-switch' => $hasTrailingControl && $control === 'switch' && $role === 'listbox' && is_null($multi),
        'mdc-list-item--with-leading-icon' => $start === 'icon',
        'mdc-list-item--with-leading-image' => $start === 'image',
        'mdc-list-item--with-leading-thumbnail' => $start === 'thumbnail',
        'mdc-list-item--with-leading-video' => $start === 'video',
        'mdc-list-item--with-leading-avatar' => $start === 'avatar',
        'mdc-list-item--with-trailing-meta' => $end === 'meta',
        'mdc-list-item--with-trailing-icon' => $end === 'icon',
    ]);

    $leadingSlot = $leadingSlot ?? null;
    $trailingSlot = $trailingSlot ?? null;
    $overlineText = $overlineText ?? null;
    $primaryText = $primaryText ?? null;
    $secondaryText = $secondaryText ?? null;

    $rootName = $attributes->has('href') ? 'a' : 'li';
@endphp

<{{ $rootName }}
    {{ $attributes->merge([
        'class' => $cssClasses,
        'aria-label' => $primaryText,
    ]) }}
    @if ($role)
    role="{{ match ($role) { 'menu' => 'menuitem', 'listbox' => 'option' } }}"
@endif
aria-disabled="true"
tabindex="-1"
data-mdc-auto-init="MDCRipple"
>
<span class="mdc-list-item__ripple"></span>
@if (! is_null($start))
    <span class="mdc-list-item__start">
        @if ($hasLeadingControl)
            @if ($control === 'checkbox') <x-m2.checkbox no-touch-target-wrapper></x-m2.checkbox> @endif
            @if ($control === 'radio') <x-m2.radio no-touch-target-wrapper></x-m2.radio> @endif
            @if ($control === 'switch') <x-m2.switch></x-m2.switch> @endif
        @else
            {{ $leadingSlot }}
        @endif
    </span>
@endif
<span id="list-item::{{ $id }}::content" class="mdc-list-item__content">
    @if ($overlineText && $primaryText) <span class="mdc-list-item__overline-text">{{ (string) $overlineText }}</span> @endif
    @if ($primaryText) <span class="mdc-list-item__primary-text">{{ (string) $primaryText }}</span> @endif
    @if ($secondaryText && $primaryText) <span class="mdc-list-item__secondary-text">{{ (string) $secondaryText }}</span> @endif
</span>
@if (! is_null($end))
    <span class="mdc-list-item__end">
        @if ($hasTrailingControl)
            @if ($control === 'checkbox') <x-m2.checkbox></x-m2.checkbox> @endif
            @if ($control === 'radio') <x-m2.radio></x-m2.radio> @endif
            @if ($control === 'switch') <x-m2.switch></x-m2.switch> @endif
        @else
            {{ $trailingSlot }}
        @endif
    </span>
@endif
</{{ $rootName }}>
