@props([
    'hr' => false,
])

@php
    $isHr = $hr;
@endphp

@if ($isHr)
    <hr class="mdc-deprecated-list-divider">
@else
    <li role="separator" class="mdc-deprecated-list-divider"></li>
@endif

