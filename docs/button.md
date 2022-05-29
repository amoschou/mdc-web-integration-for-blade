# Button

## Use

```html
<x-m2.button
    label="Send"
    icon="send"
    outlined
    raised
    unelevated
    icon-leading
    icon-trailing
    disabled
    no-ripple
    no-focus-ring
    no-touch-target
    no-touch-target-wrapper
    aria-label="Send email"
    href="#"
>
</x-m2.button>
```

## Examples

```html
<x-m2.button label="Text button" />
<x-m2.button label="Text button plus icon" icon="bookmark" />
<x-m2.button label="Outlined button" outlined />
<x-m2.button label="Outlined button plus icon" icon="bookmark" />
<x-m2.button label="Contained button" raised />
<x-m2.button label="Contained button plus icon" icon="bookmark" raised />
```

## Attributes

| Name                      | Type    | Default value     | Mandatory | Description                                                                                                                                                    |
|---------------------------|---------|-------------------|-----------|----------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `label`                   | string  | *empty string*    | no        | Sets the printed label for the button.                                                                                                                         |
| `icon`                    | string  | `null`            | no        | If present as an attribute, sets the Material icon for the button.                                                                                             |
| `outlined`                | boolean | `false`           | no        | When `true`, the button will be an outline button.                                                                                                             |
| `raised`                  | boolean | `false`           | no        | When `true`, the button will be a raised button.                                                                                                               |
| `unelevated`              | boolean | `false`           | no        | When `true`, the button will be an unelevated button.                                                                                                          |
| `icon-leading`            | boolean | `true`            | no        | When `true`, the icon (if present) will be a leading icon.                                                                                                     |
| `icon-trailing`           | boolean | `false`           | no        | When `true`, the icon (if present) will be a trailing icon. *Requires a non empty label.*                                                                      |
| `disabled`                | boolean | `false`           | no        | When `true`, the button will be disabled.                                                                                                                                 |
| `no-ripple`               | boolean | `false`           | no        | When `true`, `MDCRipple` will not be instantiated.                                                                                                              |
| `no-focus-ring`           | boolean | `false`           | no        | When `true`, the focus ring will not be rendered.                                                                                                                         |
| `no-touch-target`         | boolean | `false`           | no        | When `true`, the button will not be touch accessible.                                                                                                                     |
| `no-touch-target-wrapper` | boolean | `false`           | no        | When `true`, the button's touch target might overlap neighbouring items. *If the button is not touch accessible, this has no effect.*                           |
| `aria-label`              | string  | `label` or `icon` | no        | If present, `aria-label` will use the value provided. Otherwise, `label` (if non empty) will be used. Otherwise, `icon` (if non null) will be used. Otherwise, `aria-label` will not be set. |
| `href`                    | string  | `null`            | no        | If present, the button will be an `<a>` element and sets its `href`.                                                                                           |

## Notes

The button can have only one or none of `outlined`, `raised` or `unelevated`. If none are chosen, then the button will be a text button.

The button can have only one or none of `icon-leading` or `icon-trailing`.

Any other attributes, as could be expected on `<button>` or `<a>` elements (e.g. `type="submit"`) will be merged into the component.

If Material icons are used, be sure to include on the page:
```
<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
```

It is possible to use other icon libraries or SVGs etc by using the icon slot:

```
<x-m2.button label="Send">
    <x-slot name="icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="..."> ... </svg>
    </x-slot>
</x-m2.button>
```
