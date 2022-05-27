@props([
    'id',
    'small', 'medium', 'large',
    'four-color',
    'four-colour',
    'indeterminate',
    'closed',
    'progress',
])

@php
    // GENERATE ID
    $id = $id ?? Str::uuid();

    // VALIDATE INPUT
    $fourColor = filter_var($fourColor ?? null, FILTER_VALIDATE_BOOLEAN);
    $fourColour = filter_var($fourColour ?? null, FILTER_VALIDATE_BOOLEAN);
    $indeterminate = filter_var($indeterminate ?? null, FILTER_VALIDATE_BOOLEAN);
    $closed = filter_var($closed ?? null, FILTER_VALIDATE_BOOLEAN);
    $progress = filter_var($progress ?? null, FILTER_VALIDATE_FLOAT);
    $progress = max(0.0, min(1.0, $progress));
    $small = filter_var($small ?? null, FILTER_VALIDATE_BOOLEAN);
    $medium = filter_var($medium ?? null, FILTER_VALIDATE_BOOLEAN);
    $large = filter_var($large ?? null, FILTER_VALIDATE_BOOLEAN);

    // GENERATE CONTROL FLAGS
    $isSmall = ($small && ! $medium && ! $large);
    $isMedium = (! $small && $medium && ! $large);
    $isLarge = ! $isSmall && ! $isMedium;

    $isFourColor = $fourColor || $fourColour;
    $isIndeterminate = $indeterminate;
    $isClosed = $closed;

    $sizes = [
        'small' => [
            'style' => 'width:24px;height:24px;',
            'view-box' => '0 0 24 24',
            'cx-cy-r' => 'cx="12" cy="12" r="8.75"',
            'stroke-width' => ['2.5', '2'],
            'stroke-dasharray-dashoffset' => ['54.978', '27.489'],
        ],
        'medium' => [
            'style' => 'width:36px;height:36px;',
            'view-box' => '0 0 36 36 ',
            'cx-cy-r' => 'cx="16" cy="16" r="12.5"',
            'stroke-width' => ['3', '2.4'],
            'stroke-dasharray-dashoffset' => ['78.54', '39.27'],
        ],
        'large' => [
            'style' => 'width:48px;height:48px;',
            'view-box' => '0 0 48 48',
            'cx-cy-r' => 'cx="24" cy="24" r="18"',
            'stroke-width' => ['4', '3.2'],
            'stroke-dasharray-dashoffset' => ['113.097', '56.549'],
        ],
    ][($isSmall ? 'small' : ($isMedium ? 'medium' : 'large'))];

    $colors = $isFourColor
        ? [' mdc-circular-progress__color-1', ' mdc-circular-progress__color-2', ' mdc-circular-progress__color-3', ' mdc-circular-progress__color-4']
        : [''];

    $componentAttributes = $attributes->merge([
        'id' => $id,
        'class' => Arr::toCssClasses([
            'mdc-circular-progress',
            'mdc-circular-progress--indeterminate' => $isIndeterminate,
            'mdc-circular-progress--closed' => $isClosed,
        ]),
        'style' => $sizes['style'],
        'role' => 'progressbar',
        'aria-label' => 'Example progress bar',
        'aria-valuemin' => '0',
        'aria-valuemax' => '1',
        'aria-valuenow' => $isIndeterminate ? false : (string) $progress,
        'data-mdc-auto-init' => 'MDCCircularProgress',
    ]);
@endphp

<div {{ $componentAttributes }}>
    <div class="mdc-circular-progress__determinate-container">
        <svg class="mdc-circular-progress__determinate-circle-graphic" viewBox="{{ $sizes['view-box'] }}" xmlns="http://www.w3.org/2000/svg">
            <circle class="mdc-circular-progress__determinate-track" {!! $sizes['cx-cy-r'] !!} stroke-width="{{ $sizes['stroke-width'][0] }}"/>
            <circle class="mdc-circular-progress__determinate-circle" {!! $sizes['cx-cy-r'] !!} stroke-dasharray="{{ $sizes['stroke-dasharray-dashoffset'][0] }}" stroke-dashoffset="{{ $sizes['stroke-dasharray-dashoffset'][0] }}" stroke-width="{{ $sizes['stroke-width'][0] }}"/>
        </svg>
    </div>
    <div class="mdc-circular-progress__indeterminate-container">
        @foreach ($colors as $colorClass)
            <div class="mdc-circular-progress__spinner-layer{{ $colorClass }}">
                <div class="mdc-circular-progress__circle-clipper mdc-circular-progress__circle-left">
                    <svg class="mdc-circular-progress__indeterminate-circle-graphic" viewBox="{{ $sizes['view-box'] }}" xmlns="http://www.w3.org/2000/svg">
                        <circle {!! $sizes['cx-cy-r'] !!} stroke-dasharray="{{ $sizes['stroke-dasharray-dashoffset'][0] }}" stroke-dashoffset="{{ $sizes['stroke-dasharray-dashoffset'][1] }}" stroke-width="{{ $sizes['stroke-width'][0] }}"/>
                    </svg>
                </div>
                <div class="mdc-circular-progress__gap-patch">
                    <svg class="mdc-circular-progress__indeterminate-circle-graphic" viewBox="{{ $sizes['view-box'] }}" xmlns="http://www.w3.org/2000/svg">
                        <circle {!! $sizes['cx-cy-r'] !!} stroke-dasharray="{{ $sizes['stroke-dasharray-dashoffset'][0] }}" stroke-dashoffset="{{ $sizes['stroke-dasharray-dashoffset'][1] }}" stroke-width="{{ $sizes['stroke-width'][1] }}"/>
                    </svg>
                </div>
                <div class="mdc-circular-progress__circle-clipper mdc-circular-progress__circle-right">
                    <svg class="mdc-circular-progress__indeterminate-circle-graphic" viewBox="{{ $sizes['view-box'] }}" xmlns="http://www.w3.org/2000/svg">
                        <circle {!! $sizes['cx-cy-r'] !!} stroke-dasharray="{{ $sizes['stroke-dasharray-dashoffset'][0] }}" stroke-dashoffset="{{ $sizes['stroke-dasharray-dashoffset'][1] }}" stroke-width="{{ $sizes['stroke-width'][0] }}"/>
                    </svg>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('post-mdc-auto-init-js')
{{--    document.getElementById('{{ $id }}').MDCCircularProgress.determinate = {{ $isIndeterminate ? 'false' : 'true' }};--}}
{{--    document.getElementById('{{ $id }}').MDCCircularProgress.{{ $isClosed ? 'close' : 'open' }}();--}}
    @if (! $isIndeterminate) document.getElementById('{{ $id }}').MDCCircularProgress.progress = {{ $progress }}; @endif
@endpush

{{-- When loading is finished, close() the circular progress. --}}
