@props([
    'continuous' => true,
    'discrete' => false,
])

@php
    $continuous = filter_var($continuous, FILTER_VALIDATE_BOOLEAN);
    $discrete = filter_var($discrete, FILTER_VALIDATE_BOOLEAN);

    $isContinuous = $continuous && ! $discrete;
    $isDiscrete = ! $continuous && $discrete;


@endphp

@if ($isContinuous)
    <x-slider.continuous>{{ $slot }}</x-slider.continuous>
@elseif ($isDiscrete)
    <x-slider.discrete>{{ $slot }}</x-slider.discrete>
@endif
