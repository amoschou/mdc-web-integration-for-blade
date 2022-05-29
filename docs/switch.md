# Switch

## Use

For the switch component, we can use the following:

```html
<x-switch
    disabled
    selected
    label=""
    id=""
    js-handle=""
/>
```

However, combined with the form field would be more convenient in many applications:

```html
<x-form-field.switch
    align-end
    label=""
    id=""
    wrapped-switch
    disabled
    selected
    id=""
    js-handle=""
/>
```

## Examples

```html
<x-switch id="basic-switch" label="off/on" />
<x-switch id="disabled-switch" label="off/on" disabled />
<x-switch id="selected-switch" label="off/on" selected />
```

See the form field documentation for more information.

## Attributes

### Important attributes

| Name       | Type    | Default value | Mandatory | Description                                                                                                    |
|------------|---------|---------------|-----------|----------------------------------------------------------------------------------------------------------------|
| `disabled` | boolean | `false`       | no        | If `true`, the switch will be disabled.                                                                        |
| `selected` | boolean | `false`       | no        | If `true`, the switch will be on.                                                                              |

### Other attributes
| Name        | Type   | Default value | Mandatory | Description                                                                                                    |
|-------------|--------|---------------|-----------|----------------------------------------------------------------------------------------------------------------|
| `label`     | string | `null`        | no        | If present, a label will be displayed after the switch. *Not recommended, instead use `<x-form-field.switch>`* |
| `id`        | string | a random UUID | no        | Sets the `id` for the switch.                                                                                  |
| `js-handle` | string | `null`        | no        | If present, sets the name of the Javascript variable for the component.                                        |

## Javascript

```html
<x-switch js-handle="mySwitch" />
```

```js
mySwitch.disabled = true;
mySwitch.disabled = false;
mySwitch.selected = true;
mySwitch.selected = false;
```
