@props([
    'centered' => false,
    'fixed' => false,
    'icon' => null,
    'alt' => null,
    'text' => '',
    'open' => false,
    'primary-action' => $__laravel_slots['primary-action'] ?? null,
    'secondary-action' => $__laravel_slots['secondary-action'] ?? null,
    'js-handle' => null,
    'id' => null,
    'mobile-stacked' => true,
])

@php
    foreach ([
        'primary-action',
        'secondary-action',
        'js-handle',
        'mobile-stacked',
    ] as $kebabString) { ${Str::camel($kebabString)} = $$kebabString; unset($$kebabString); }

    $id = $id ?? Str::uuid();

    $centered = filter_var($centered, FILTER_VALIDATE_BOOLEAN);
    $fixed = filter_var($fixed, FILTER_VALIDATE_BOOLEAN);
    $open = filter_var($open, FILTER_VALIDATE_BOOLEAN);
    $graphic = $graphic ?? null;
    $prominent = filter_var($primaryAction->attributes->get('prominent'), FILTER_VALIDATE_BOOLEAN);

    $isCentered = $centered;
    $isFixed = $fixed;
    $isOpen = $open;
    $hasSlotGraphic = $graphic instanceof Illuminate\View\ComponentSlot;
    $hasIconGraphic = (strlen((string) $icon) > 0) && ! $hasSlotGraphic;
    $hasGraphic = $hasIconGraphic || $hasSlotGraphic;
    $hasSecondaryAction = ! is_null($secondaryAction);
    $altText = $hasGraphic && strlen((string) $alt) > 0 ? $alt : $icon;
    $hasAltText = strlen((string) $altText) > 0;
    $primaryActionIsProminent = $prominent && is_null($secondaryAction);
    $hasJsHandle = ! is_null($jsHandle);
    $isMobileStacked = $mobileStacked;

    $componentAttributes = $attributes->merge([
        'id' => $id,
        'class' => Arr::toCssClasses([
            'mdc-banner',
            'mdc-banner--centered' => $isCentered,
            'mdc-banner--mobile-stacked' => $isMobileStacked,
        ]),
        'role' => 'banner',
        'data-mdc-auto-init' => 'MDCBanner',
    ]);
@endphp

<div {{ $componentAttributes }}>
    @if ($isFixed)
        <div class="mdc-banner__fixed">
    @endif
            <div class="mdc-banner__content"
                 role="alertdialog"
                 aria-live="assertive">
                <div class="mdc-banner__graphic-text-wrapper">
                    @if ($hasGraphic)
                        <div class="mdc-banner__graphic" role="img" @if ($hasAltText) alt="{{ $altText }}" @endif>
                            @if ($hasIconGraphic)
                                <i class="material-icons mdc-banner__icon">{{ $icon }}</i>
                            @else
                                {{ $graphic }}
                            @endif
                        </div>
                    @endif
                    <div class="mdc-banner__text">{{ $text }}</div>
                </div>
                <div class="mdc-banner__actions">
                    @if ($hasSecondaryAction)
                        <x-banner.button secondary :label="$secondaryAction->attributes->get('label')" />
                    @endif
                    <x-banner.button :label="$primaryAction->attributes->get('label')" :prominent="$primaryActionIsProminent" />
                </div>
            </div>
    @if ($isFixed)
        </div>
    @endif
    {{ $slot }}
</div>

@push('post-mdc-auto-init-js')
    @if ($hasJsHandle)
        const {{ $jsHandle }} = document.getElementById('{{ $id }}').MDCBanner;
    @endif
    @if ($isOpen)
        document.getElementById('{{ $id }}').MDCBanner.open();
    @endif
    window.addEventListener('resize', function () {
        document.getElementById('{{ $id }}').MDCBanner.layout();
    });
@endpush

{{--.open()--}}
{{--.close(CloseReason);--}}
{{--.getText()--}}
{{--.setText(string);--}}
{{--.getPrimaryActionText();--}}
{{--.setPrimaryActiontext(string);--}}
{{--.getSecondaryActionText();--}}
{{--.setSecondaryActionText(string);--}}
{{--.layout();--}}

