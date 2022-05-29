# Form field

## Use

For the form field component, we can use the following:

```html
<x-form-field
    align-end
    label=""
    id=""
    wrapped-switch
>
    (slot)
</x-form-field>
```

However, in practice, it is more convenient to use the following in combination with controls:

```html
<x-form-field.checkbox
    label=""
    id=""
    align-end
    (additional attributes as for a checkbox component)
/>

<x-form-field.radio
    label=""
    id=""
    align-end
    (additional attributes as for a radio component)
/>

<x-form-field.switch
    label=""
    id=""
    align-end
    (additional attributes as for a switch component)
/>
```

## Examples

```html
<x-form-field.checkbox label="Unchecked checkbox" />
<x-form-field.checkbox label="Checked checkbox" checked />
<x-form-field.checkbox label="Indeterminate checkbox" indeterminate />
<x-form-field.checkbox label="Checked disabled checkbox" checked disabled />

<x-form-field.checkbox align-end label="Unchecked checkbox" />
<x-form-field.checkbox align-end label="Checked checkbox" checked />
<x-form-field.checkbox align-end label="Indeterminate checkbox" indeterminate />
<x-form-field.checkbox align-end label="Indeterminate disabled checkbox" indeterminate disabled />

<x-form-field.radio label="Unselected radio in group 1" name="group-1" />
<x-form-field.radio label="Unselected radio in group 1" name="group-1" />
<x-form-field.radio label="Selected radio in group 1" checked name="group-1" />
<x-form-field.radio label="Unselected disabled radio in group 1" name="group-1" disabled />

<x-form-field.radio align-end label="Unselected radio in group 2" name="group-2" />
<x-form-field.radio align-end label="Selected radio in group 2" checked name="group-2" />
<x-form-field.radio align-end label="Unselected radio in group 2" name="group-2" />
<x-form-field.radio align-end label="Unselected disabled radio in group 2" name="group-2" disabled />

<x-form-field.switch label="Off switch" />
<x-form-field.switch label="On switch" selected />
<x-form-field.switch label="Off switch" />
<x-form-field.switch label="Off disabled switch" disabled />
```

