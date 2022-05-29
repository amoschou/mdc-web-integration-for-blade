# Radio

## Use

```
<x-radio
    no-touch-target
    no-touch-target-wrapper
    disabled
    checked
    no-js
    no-focus-ring
    name=""
    value=""
    id=""
    js-handle=""
/>
```

## Examples

```html
<x-radio id="radio-1" name="radios" checked label="Radio 1" />
<x-radio id="radio-1" name="radios" disabled label="Radio 1" />
```

## Attributes

### Important attributes

| Name       | Type    | Default value                      | Mandatory | Description                                  |
|------------|---------|------------------------------------|-----------|----------------------------------------------|
| `disabled` | boolean | `false`                            | no        | If `true`, the radio will be disabled.       |
| `checked`  | boolean | `false`                            | no        | If `true`, the radiio will be checked.       |
| `name`     | string  | `null`                             | no        | If present, sets the `name` for the radio.   |
| `value`    | string  | `null`                             | no        | If present, sets the `value` for the radio.  |
| `id`       | string  | A random UUID followed by `-radio` | no        | If present, sets the `id` for the component. |

### Other attributes

| Name                      | Type    | Default value | Mandatory | Description                                                                                                                             |
|---------------------------|---------|---------------|-----------|-----------------------------------------------------------------------------------------------------------------------------------------|
| `no-touch-target`         | boolean | `false`       | no        | If `true`, the checkbox will not be touch accessible.                                                                                   |
| `no-touch-target-wrapper` | boolean | `false`       | no        | If `true`, the checkbox's touch target might overlap neighbouring items. *If the checkbox is not touch accessible, this has no effect.* |
| `no-js`                   | boolean | `false`       | no        | If `true`, `MDCCheckbox` will not be instantiated.                                                                                      |
| `no-focus-ring`           | boolean | `false`       | no        | If `true`, the focus ring will not be rendered.                                                                                         |

## Notes
