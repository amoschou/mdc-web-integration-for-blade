@props([
    'row-header' => false,
    'column-header' => false,
    'numeric' => false,
    'checkbox' => false,
    'selected' => false,
    'id' => Str::uuid(),
])

@aware([
    'rowId' => null,
    'header' => false,
])

{{-- Without dash is correct for rowId here --}}

@php
    $rowHeader = filter_var(${'row-header'}, FILTER_VALIDATE_BOOLEAN);
    $numeric = filter_var($numeric, FILTER_VALIDATE_BOOLEAN);
    $columnHeader = filter_var(${'column-header'}, FILTER_VALIDATE_BOOLEAN); unset(${'column-header'});
    $checkbox = filter_var($checkbox, FILTER_VALIDATE_BOOLEAN);
    $selected = filter_var($selected, FILTER_VALIDATE_BOOLEAN);
    $header = filter_var($header, FILTER_VALIDATE_BOOLEAN);

    $isRowHeader = $rowHeader;
    $isColumnHeader = $columnHeader || $header;
    $isNumeric = $numeric;
    $isHeader = $isRowHeader || $isColumnHeader;
    $hasCheckbox = $checkbox;
    $isColumnHeaderCheckbox = $isColumnHeader && $hasCheckbox;
    $isSelected = $selected && $hasCheckbox;
    $hasRowId = ! is_null($rowId);

    if ($isRowHeader && $hasRowId) {
        $id = $rowId;
    }

    $thOrTd = $isHeader ? 'th' : 'td';

    $attributes = $attributes->merge([
        'class' => Arr::toCssClasses([
            'mdc-data-table__cell' => ! $isColumnHeader,
            'mdc-data-table__cell--numeric' => $isNumeric && ! $isColumnHeader,
            'mdc-data-table__cell--checkbox' => $hasCheckbox && ! $isColumnHeader,
            'mdc-data-table__header-cell' => $isColumnHeader,
            'mdc-data-table__header-cell--numeric' => $isNumeric && $isColumnHeader,
            'mdc-data-table__header-cell--checkbox' => $hasCheckbox && $isColumnHeader,
        ]),
        'role' => $isColumnHeader ? 'columnheader' : false,
        'scope' => ($isColumnHeader ? 'col' : null) ?? ($isRowHeader ? 'row' : null) ?? false,
        'id' => $isRowHeader ? $id : false,
    ]);
@endphp

<{{ $thOrTd }} {{ $attributes }}>
    @if ($hasCheckbox)
        <x-checkbox
            class="
                {{ $isColumnHeader ? 'mdc-data-table__header-row-checkbox' : 'mdc-data-table__row-checkbox' }}
                {{ $isSelected ? 'mdc-checkbox--selected' : '' }}
            "
            input-aria-label
            no-focus-ring
            no-touch-target
            no-js
            :checked="$isSelected"
        />
    @else
        {{ $slot }}
    @endif
</{{ $thOrTd }}>
