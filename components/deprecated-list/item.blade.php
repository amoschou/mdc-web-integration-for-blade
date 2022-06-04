@props([
    'text' => null,
    'primary-text' => null,
    'secondary-text' => null,
    'divider-after' => null,
    'divider-before' => null,
    'id' => Str::uuid(),
    'checked' => false,
    'value' => null,
])

@aware([
    'radioGroup' => false,
    'checkboxGroup' => false,
    'name' => null,
])

@php
    $primaryText = ${'primary-text'};
    $secondaryText = ${'secondary-text'};
    $dividerAfter = filter_var(${'divider-after'}, FILTER_VALIDATE_BOOLEAN);
    $dividerBefore = filter_var(${'divider-before'}, FILTER_VALIDATE_BOOLEAN);
    $radioGroup = filter_var($radioGroup, FILTER_VALIDATE_BOOLEAN);
    $checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);

    $hasText = ! is_null($text);
    $hasPrimaryText = ! is_null($primaryText);
    $hasSecondaryText = ! is_null($secondaryText);
    $hasDividerAfter = $dividerAfter;
    $hasDividerBefore = $dividerBefore;
    $listIsRadioGroup = $radioGroup && ! $checkboxGroup;
    $listIsCheckboxGroup = ! $radioGroup && $checkboxGroup;
    $isChecked = ($listIsRadioGroup || $listIsCheckboxGroup) && $checked;
    $hasRadioGroupName = ! is_null($name) && $listIsRadioGroup;

    $isOneLineItem = $hasText && ! $hasPrimaryText && ! $hasSecondaryText;
    $isTwoLineItem = ! $hasText && $hasPrimaryText && $hasSecondaryText;

    $hasText = ! is_null($text);

    $attributes = $attributes->merge([
        'class' => 'mdc-deprecated-list-item',
        'role' => ($listIsRadioGroup ? 'radio' : null) ?? ($listIsCheckboxGroup ? 'checkbox' : null) ?? false,
        'aria-checked' => $isChecked ? 'true' : 'false',
        'tabindex' => $isChecked ? '0' : false,
        'new' => 'here',
    ]);
@endphp

@if ($hasDividerBefore) <x-deprecated-list.divider /> @endif

<li {{ $attributes }}>
    <span class="mdc-deprecated-list-item__ripple"></span>

    @if ($listIsRadioGroup)
        <span class="mdc-deprecated-list-item__graphic">
            <x-radio
                no-touch-target no-js no-ripple no-focus-ring
                id="radio-{{ $id }}"
                :name="$name"
                :value="$value"
                :checked="$isChecked"
            />
        </span>
    @elseif ($listIsCheckboxGroup)
        <span class="mdc-deprecated-list-item__graphic">
            <x-checkbox
                no-touch-target no-js no-focus-ring
                id="checkbox-{{ $id }}"
                :name="$name"
                :value="$value"
                :checked="$isChecked"
            />
        </span>
    @endif

    @if ($listIsRadioGroup)
        <label class="mdc-deprecated-list-item__text" for="radio-{{ $id }}-input">{{ $text }}</label>
    @elseif ($listIsCheckboxGroup)
        <label class="mdc-deprecated-list-item__text" for="checkbox-{{ $id }}-input">{{ $text }}</label>
    @elseif ($isOneLineItem)
        <span class="mdc-deprecated-list-item__text">{{ $text }}</span>
    @elseif ($isTwoLineItem)
        <span class="mdc-deprecated-list-item__text">
            <span class="mdc-deprecated-list-item__primary-text">{{ $primaryText }}</span>
            <span class="mdc-deprecated-list-item__secondary-text">{{ $secondaryText }}</span>
        </span>
    @endif
</li>

@if ($hasDividerAfter) <x-deprecated-list.divider /> @endif
