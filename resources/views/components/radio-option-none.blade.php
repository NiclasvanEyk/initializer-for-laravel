@props(['id', 'model', 'inline' => false, 'name' => null, 'label' => 'None'])

<x-radio-option
    label="{{$label}}"
    :isEmptyOption="true"
    :id="$model.'-none'"
    :model="$model"
    :name="$name"
    :inline="$inline"
    {{$attributes}}
></x-radio-option>
