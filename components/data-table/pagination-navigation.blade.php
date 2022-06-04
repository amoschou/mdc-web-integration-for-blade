@props([
    'lower' => null,
    'upper' => null,
    'total' => null,
])

<div class="mdc-data-table__pagination-navigation">
    <div class="mdc-data-table__pagination-total">
        {{ $lower }}–{{ $upper }} of {{ $total }}
    </div>
    <button class="mdc-icon-button material-icons mdc-data-table__pagination-button" data-first-page="true" disabled>
        <div class="mdc-button__icon">first_page</div>
    </button>
    <button class="mdc-icon-button material-icons mdc-data-table__pagination-button" data-prev-page="true" disabled>
        <div class="mdc-button__icon">chevron_left</div>
    </button>
    <button class="mdc-icon-button material-icons mdc-data-table__pagination-button" data-next-page="true">
        <div class="mdc-button__icon">chevron_right</div>
    </button>
    <button class="mdc-icon-button material-icons mdc-data-table__pagination-button" data-last-page="true">
        <div class="mdc-button__icon">last_page</div>
    </button>
</div>
