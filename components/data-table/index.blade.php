@props([
    'head' => null,
    'label' => null,
    'js-handle' => null,
    'id' => Str::uuid(),
    'no-progress' => false,
    'no-pagination' => false,
])

@php
    $jsHandle = ${'js-handle'}; unset(${'js-handle'});
    $noProgress = ${'no-progress'}; unset(${'no-progress'});
    $noPagination = filter_var(${'no-pagination'}, FILTER_VALIDATE_BOOLEAN); unset(${'no-pagination'});

    $hasJsHandle = ! is_null($jsHandle);
    $hasProgress = ! $noProgress;
    $hasPagination = ! $noPagination;
@endphp

<div class="mdc-data-table" data-mdc-auto-init="MDCDataTable" id="{{ $id }}">
    <div class="mdc-data-table__table-container">
        <table class="mdc-data-table__table" @if (! is_null($label)) aria-label="{{ $label }}" @endif>
            <thead>{{ $head }}</thead>
            <tbody class="mdc-data-table__content">{{ $slot }}</tbody>
        </table>
    </div>

    @if ($hasPagination)
        <x-data-table.pagination></x-data-table.pagination>
    @endif

    @if ($hasProgress)
        <div class="mdc-data-table__progress-indicator">
            <div class="mdc-data-table__scrim"></div>
            <x-linear-progress class="mdc-data-table__linear-progress" indeterminate label="Data is being loaded..." no-init />
            {{-- This progress bar is automatically initialised by the data table --}}
        </div>
    @endif
</div>

@push('post-mdc-auto-init-js')
    @if ($hasJsHandle)
        const {{ 'js-handle' }} = document.getElementById('{{ $id }}').MDCDataTable;
    @endif
    document.getElementById('{{ $id }}').MDCDataTable.hideProgress();
@endpush
