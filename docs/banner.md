# Banner

## Use

```
<x-m2.banner
    fixed
    centered
    icon="send"
    alt=""
    text=""
    secondary
    open
>
    <x-slot name="primary" label=""></x-slot>
    <x-slot name="secondary" label=""></x-slot>
</x-m2.button>
```

## Examples

```
<x-m2.banner
    text="There was a problem processing a transaction on your credit card."
>
    <x-slot name="primary" label="Fix it"></x-slot>
</x-m2.banner>

<x-m2.banner
    fixed
    text="There was a problem processing a transaction on your credit card."
>
    <x-slot name="primary" label="Fix it"></x-slot>
</x-m2.banner>

<x-m2.banner
    text="There was a problem processing a transaction on your credit card."
    icon="error_outline"
    alt=""
>
    <x-slot name="primary" label="Fix it"></x-slot>
</x-m2.banner>

<x-m2.banner
    fixed
    text="There was a problem processing a transaction on your credit card."
>
    <x-slot name="primary" label="Fix it"></x-slot>
    <x-slot name="secondary" label="Learn more"></x-slot>
</x-m2.banner>
```

## Attributes

| Name       | Type    | Default value  | Mandatory | Description                                                                   |
|------------|---------|----------------|-----------|-------------------------------------------------------------------------------|
| `centered` | boolean | `false`        | no        | When `true`, the banner will be centered.                                       |
| `fixed`    | boolean | `false`        | no        | When `true`, the banner will be a fixed banner. *Use this below a top app bar.* |
| `icon`     | string  | `null`         | no        | If present, sets the Material icon graphic for the banner.                    |
| `alt`      | string  | `null`         | no        | If present, sets the `alt` text for the graphic. *Requires a graphic.*        |
| `text`     | string  | *empty string* | no        | Sets the banner message.                                                      |
| `open`     | boolean | `true`         | no        | When `true`, the banner opens on page load.                                     |

## Slots
| Name        | Mandatory | Description            | Attributes                                           |
|-------------|-----------|------------------------|------------------------------------------------------|
| `primary`   | yes       | The primary action.    | `label` (string): The text for the primary action.   |
| `secondary` | no        | The secondary action.  | `label` (string): The text for the secondary action. |

## Notes

If the banner appears together with a top app bar, the `fixed` attribute should be used.

If a graphic icon is used, be sure to include on the page:
```
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
```
