@props([
    'header' => false,
    'selected' => false,
    'row-id' => null,
])

@aware([
    'checkbox' => false,
])

@php
    $header = filter_var($header, FILTER_VALIDATE_BOOLEAN);
    $selected = filter_var($selected, FILTER_VALIDATE_BOOLEAN);
    $checkbox = filter_var($checkbox, FILTER_VALIDATE_BOOLEAN);
    $rowId = filter_var(${'row-id'}, FILTER_VALIDATE_BOOLEAN); unset(${'row-id'});

    $isHeader = $header;
    $hasCheckbox = $checkbox;
    $isSelected = $hasCheckbox && $selected;
    $hasRowId = ! is_null($rowId);

    $attributes = $attributes->merge([
        'class' => Arr::toCssClasses([
            'mdc-data-table__row' => ! $isHeader,
            'mdc-data-table__row--selected' => $isSelected,
            'mdc-data-table__header-row' => $isHeader,
        ]),
        'aria-selected' => $isSelected ? 'true' : false,
        'data-row-id' => $hasRowId ? $rowId : false,
    ]);

    $checkboxCellAttributes = (new \Illuminate\View\ComponentAttributeBag())->merge([
        'checkbox' => true,
        'input-aria-labelledby' => $rowId,
        'selected' => $isSelected,
    ]);
@endphp

<tr {{ $attributes }}>
    @if ($hasCheckbox && $isHeader) <x-data-table.cell column-header checkbox /> @endif
    @if ($hasCheckbox && ! $isHeader) <x-data-table.cell checkbox :inputAriaLabelledby="$rowId" :selected="$isSelected" /> @endif
    {{ $slot }}
</tr>

