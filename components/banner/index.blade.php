@props([
    'centered',
    'fixed',
    'icon',
    'alt',
    'text',
    'open',
    'primary-action',
    'secondary-action',
])

@php
    foreach (['primary-action', 'secondary-action'] as $kebabString) { ${Str::camel($kebabString)} = $$kebabString; unset($$kebabString); }

    $id = Str::uuid();

    $centered = filter_var($centered ?? null, FILTER_VALIDATE_BOOLEAN);
    $fixed = filter_var($fixed ?? null, FILTER_VALIDATE_BOOLEAN);
    $open = filter_var($open ?? null, FILTER_VALIDATE_BOOLEAN);
    $icon = $icon ?? null;
    $alt = $alt ?? null;
    $text = (string) ($text ?? null);
    $graphic = $graphic ?? null;
    $primaryAction = $primaryAction ?? null;
    $secondaryAction = $secondaryAction ?? null;

    $isCentered = $centered;
    $isFixed = $fixed;
    $isOpen = $open;
    $hasSlotGraphic = $graphic instanceof Illuminate\View\ComponentSlot;
    $hasIconGraphic = (strlen((string) $icon) > 0) && ! $hasSlotGraphic;
    $hasGraphic = $hasIconGraphic || $hasSlotGraphic;
    $hasSecondaryAction = ! is_null($secondaryAction);
    $altText = $hasGraphic && strlen((string) $alt) > 0 ? $alt : $icon;
    $hasAltText = strlen((string) $altText) > 0;

    $componentAttributes = $attributes->merge([
        'id' => $id,
        'class' => Arr::toCssClasses([
            'mdc-banner',
            'mdc-banner--centered' => $isCentered,
            'mdc-banner--mobile-stacked' => true,
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
                        <x-m2.banner-button secondary :label="$secondaryAction->attributes->get('label')"></x-m2.banner-button>
                    @endif
                    <x-m2.banner-button :label="$primaryAction->attributes->get('label')"></x-m2.banner-button>
                </div>
            </div>
    @if ($isFixed)
        </div>
    @endif
</div>

@push('post-mdc-auto-init-js')
    @if ($isOpen)
        document.getElementById('{{ $id }}').MDCBanner.open();
    @endif
    window.addEventListener('resize', function () {
        document.getElementById('{{ $id }}').MDCBanner.layout();
    });
@endpush
