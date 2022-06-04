@props([
    'two-line' => false,
    'subheader' => null,
    'divider-after' => null,
    'divider-before' => null,
    'radio-group' => null,
    'name' => null,
    'checkbox-group' => null,
])

@php
    $twoLine = filter_var(${'two-line'}, FILTER_VALIDATE_BOOLEAN);
    $dividerAfter = filter_var(${'divider-after'}, FILTER_VALIDATE_BOOLEAN);
    $dividerBefore = filter_var(${'divider-before'}, FILTER_VALIDATE_BOOLEAN);
    $radioGroup = filter_var(${'radio-group'}, FILTER_VALIDATE_BOOLEAN);
    $checkboxGroup = filter_var(${'checkbox-group'}, FILTER_VALIDATE_BOOLEAN);
    $radioGroupName = $name;

    $hasTwoLines = $twoLine;
    $hasSubheader = ! is_null($subheader);
    $hasDividerAfter = $dividerAfter;
    $hasDividerBefore = $dividerBefore;
    $isRadioGroup = $radioGroup && ! $checkboxGroup;
    $isCheckboxGroup = ! $radioGroup && $checkboxGroup;

    $attributes = $attributes->merge([
        'class' => Arr::toCssClasses([
            'mdc-deprecated-list',
            'mdc-deprecated-list--two-line' => $hasTwoLines,
        ]),
        'role' => ($isRadioGroup ? 'radiogroup' : null) ?? ($isCheckboxGroup ? 'group' : null) ?? false,
        'data-mdc-auto-init' => 'MDCList',
    ]);
@endphp

@if ($hasDividerBefore) <x-deprecated-list.divider hr /> @endif

@if ($hasSubheader) <x-deprecated-list.group-subheader>{{ $subheader }}</x-deprecated-list.group-subheader> @endif

<ul {{ $attributes }}>
    {{ $slot }}
</ul>

@if ($hasDividerAfter) <x-deprecated-list.divider hr /> @endif
