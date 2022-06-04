@props([
    'stacked' => false,
    'leading' => false,
    'js-handle' => null,
    'id' => Str::uuid(),
    'label' => '',
    'action-button' => null,
    'dismissible' => false,
    'no-escape' => false,
    'timeout' => 5000,
    'no-timeout' => false,
    'open' => false,
])

@php
    $stacked = filter_var($stacked, FILTER_VALIDATE_BOOLEAN);
    $leading = filter_var($leading, FILTER_VALIDATE_BOOLEAN);
    $dismissible = filter_var($dismissible, FILTER_VALIDATE_BOOLEAN);
    $open = filter_var($open, FILTER_VALIDATE_BOOLEAN);
    $timeout = filter_var($timeout, FILTER_VALIDATE_INT);
    $jsHandle = ${'js-handle'}; unset(${'js-handle'});
    $noTimeout = ${'no-timeout'}; unset(${'no-timeout'});
    $actionButton = ${'action-button'}; unset(${'action-button'});
    $noEscape = ${'no-escape'}; unset(${'no-escape'});

    $isStacked = $stacked;
    $isLeading = $leading;
    $isDismissible = $dismissible;
    $hasJsHandle = ! is_null($jsHandle);
    $hasAction = ! is_null($actionButton);
    $hasActions = $hasAction || $isDismissible;
    $closesOnEscape = ! $noEscape;
    $hasTimeout = ! $noTimeout;
    if (! $hasTimeout) {
        $timeout = -1;
    }
    $isOpen = $open;

    $attributes = $attributes->merge([
        'class' => Arr::toCssClasses([
            'mdc-snackbar',
            'mdc-snackbar--stacked' => $isStacked,
            'mdc-snackbar--leading' => $isLeading,
        ]),
        'data-mdc-auto-init' => 'MDCSnackbar',
        'id' => $id,
    ]);
@endphp

<aside {{ $attributes }}>
    <div class="mdc-snackbar__surface" role="status" aria-relevant="additions">
        <div class="mdc-snackbar__label" aria-atomic="false">{{ $label }}</div>
        @if ($hasActions)
            <div class="mdc-snackbar__actions" aria-atomic="true">
                @if ($hasAction)
                    <x-snackbar.action-button :label="$actionButton"/>
                    {{-- no-js is part of the spec! --}}
                @endif
                @if ($isDismissible)
                    <x-icon-button class="mdc-snackbar__dismiss" icon="close" no-ripple no-touch-target-wrapper no-focus-ring />
                @endif
            </div>
        @endif
    </div>
</aside>

@push('post-mdc-auto-init-js')
    @if ($hasJsHandle)
        const {{ $jsHandle }} = document.getElementById('{{ $id }}').MDCSnackbar;
    @endif
    document.getElementById('{{ $id }}').MDCSnackbar.timeoutMs = {{ $timeout }};
    document.getElementById('{{ $id }}').MDCSnackbar.closeOnEscape = {{ $closesOnEscape ? 'true' : 'false' }};
{{--    document.getElementById('{{ $id }}').MDCSnackbar.labelText = '{{ $label }}';--}}
{{--    document.getElementById('{{ $id }}').MDCSnackbar.actionButtonText = '{{ $actionButton }}';--}}
    @if ($isOpen) document.getElementById('{{ $id }}').MDCSnackbar.open(); @endif
@endpush
