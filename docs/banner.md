# Banner

## Use

```html
<x-banner
    fixed
    centered
    icon="send"
    alt=""
    text=""
    open
    js-handle=""
    id=""
    js-handle=""
    mobile-stacked
>
    <x-slot name="primary-action" label=""></x-slot>
    <x-slot name="secondary-action" label=""></x-slot>
</x-button>
```

## Examples

```html
<x-banner
    text="There was a problem processing a transaction on your credit card."
>
    <x-slot name="primary-action" label="Fix it"></x-slot>
</x-banner>

<x-banner
    fixed
    text="There was a problem processing a transaction on your credit card."
>
    <x-slot name="primary-action" label="Fix it"></x-slot>
</x-banner>

<x-banner
    text="There was a problem processing a transaction on your credit card."
    icon="error_outline"
    alt=""
>
    <x-slot name="primary-action" label="Fix it"></x-slot>
</x-banner>

<x-banner
    fixed
    text="There was a problem processing a transaction on your credit card."
>
    <x-slot name="primary-action" label="Fix it"></x-slot>
    <x-slot name="secondary-action" label="Learn more"></x-slot>
</x-banner>
```

## Attributes

| Name        | Type    | Default value  | Description                                                                     |
|-------------|---------|----------------|---------------------------------------------------------------------------------|
| `centered`  | boolean | `false`        | When `true`, the banner will be centered.                                       |
| `fixed`     | boolean | `false`        | When `true`, the banner will be a fixed banner. *Use this below a top app bar.* |
| `icon`      | string  | `null`         | If present, sets the Material icon graphic for the banner.                      |
| `alt`       | string  | `null`         | If present, sets the `alt` text for the graphic. *Requires a graphic.*          |
| `text`      | string  | *empty string* | Sets the banner message.                                                        |
| `open`      | boolean | `true`         | When `true`, the banner opens on page load.                                     |
| `js-handle` | string  | null           | If present, sets the name of the Javascript variable for the component.         |
## Slots
| Name                | Description            | Attributes                                                                                                                                                                                                    |
|---------------------|------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `primary-action`    | The primary action.    | <li>`label` (string): The text for the primary action, default *empty string*.</li><li>`prominent` (boolean): When true, the button is a full width contained button (not recommended), default `false`.</ul> |
| `secondary-action`  | The secondary action.  | <li>`label` (string): The text for the secondary action.</li>                                                                                                                                                 |

## Notes

If the banner appears together with a top app bar, the `fixed` attribute should be used.

If a graphic icon is used, be sure to include on the page:
```
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
```

A secondary action can not appear together with a prominent primary action.

`prominent` on the `primary-action` slot is not yet implemented and currently has no effect.

The actions must be written with separate opening and closing tags, not a self closing tag:
```html
<x-slot name="primary-action" label=""></x-slot>
<!-- good -->
<x-slot name="primary-action" label="" />
<!-- won't work -->
```

