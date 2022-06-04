@props([
    'label' => null,
    'notched' = false,
    'no-js' => false,
])

@php
    $notched = filter_var($notched, FILTER_VALIDATE_BOOLEAN);
    $noJs = filter_var(${'no-js'}, FILTER_VALIDATE_BOOLEAN);

    $hasNoLabel = is_null($label) || $label === '';
    $isNotched = $notched;
    $usesJavascript = ! $noJs;

    $attributes = $attributes->merge([
        'class' => Str::cssToClasses([
            'mdc-notched-outline',
            'mdc-notched-outline--notched' => $isNotched,
            'mdc-notched-outline--no-label' => $hasNoLabel,
        ]),
        'data-mdc-auto-init' => $usesJavascript ? 'MDCNotchedOutline' : false,
    ]);
@endphp

<span {{ $attributes }}>
    <span class="mdc-notched-outline__leading"></span>
    <span class="mdc-notched-outline__notch">
        <x-floating-label no-js>{{ $slot }}</x-floating-label>
    </span>
    <span class="mdc-notched-outline__trailing"></span>
</span>
