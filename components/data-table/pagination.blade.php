@php
    $recordSizes = [10, 25, 100];
    $selected = 10;
    $polygons = ['inactive' => '7 10 12 15 17 10', 'active' => '7 15 12 10 17 15'];
@endphp

<div class="mdc-data-table__pagination">
    <div class="mdc-data-table__pagination-trailing">
        <div class="mdc-data-table__pagination-rows-per-page">
            <div class="mdc-data-table__pagination-rows-per-page-label">
                Rows per page
            </div>

            <div class="mdc-select mdc-select--outlined mdc-select--no-label mdc-data-table__pagination-rows-per-page-select">
                <div class="mdc-select__anchor" role="button" aria-haspopup="listbox" aria-labelledby="demo-pagination-select" tabindex="0">
                    <span class="mdc-select__selected-text-container">
                        <span id="demo-pagination-select" class="mdc-select__selected-text">{{ $selected }}</span>
                    </span>
                    <span class="mdc-select__dropdown-icon">
                        <svg class="mdc-select__dropdown-icon-graphic" viewBox="7 10 10 5">
                            @foreach ($polygons as $activeOrInactive => $points)
                                <polygon
                                    class="mdc-select__dropdown-icon-{{ $activeOrInactive }}"
                                    stroke="none"
                                    fill-rule="evenodd"
                                    points="{{ $points }}">
                                </polygon>
                            @endforeach
                        </svg>
                    </span>
                    <span class="mdc-notched-outline mdc-notched-outline--notched">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                </div>

                <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth" role="listbox">
                    <ul class="mdc-list">
                        @foreach ($recordSizes as $recordSize)
                            <li class="mdc-select__option mdc-select__one-line-option mdc-list-item @if ($recordSize === $selected) mdc-list-item--selected @endif mdc-list-item--with-one-line" @if ($recordSize === $selected) aria-selected="true" @endif role="option" data-value="10">
                                <span class="mdc-list-item__ripple"></span>
                                <span class="mdc-list-item__content">
                                <span class="mdc-list-item__primary-text">{{ $recordSize }}</span>
                            </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <x-data-table.pagination-navigation lower="1" upper="10" total="100" />
    </div>
</div>
