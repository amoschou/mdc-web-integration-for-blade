# Linear progress

## Use

```
<x-linear-progress
    indeterminate
    closed
    label=""
    now=""
    rtl
    js-handle=""
    id
/>
```

## Examples

```html
<x-linear-progress label="Example progress bar" now="0" />

<x-linear-progress indeterminate />
```

## Attributes

| Name            | Type           | Default value | Mandatory | Description                                                                                                |
|-----------------|----------------|---------------|-----------|------------------------------------------------------------------------------------------------------------|
| `indeterminate` | boolean        | `false`       | no        | When `true`, the linear progress indicator will be in an indeterminate state.                              |
| `closed`        | boolean        | `false`       | no        | When true, the linear progress indicator will be hidden.                                                   |
| `label`         | string         | `null`        | no        | When present, sets the `aria-label`.                                                                       |
| `now`           | numeric string | `"0.0"`       | no        | A numeric value between 0 and 1 indicating the progress value. *For determiante progress indicators only.* | 
| `buffer`        | numeric string | `"1.0"`       | no        | A numeric value between 0 and 1 indicating the buffer value. *For determiante progress indicators only.*   | 
| `rtl`           | boolean        | `false`       | no        | When true, the linear progress will be displayed right to left                                             |
| `js-handle`     | string         | null          | no        | If present, defines the Javascript variable name that can be used for the component.                       |

## Javascript 

```html
<x-linear-progress js-handle="myBar" />
```

```js
myBar.determinate = false;
myBar.determinate = true;
myBar.progress = 0.22;
myBar.buffer = 0.5;
myBar.open();
myBar.close();
```
