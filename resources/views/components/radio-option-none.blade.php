@props(['id', 'model', 'inline' => false])

<x-radio-option
    :isEmptyOption="true" :id="$model.'-none'" :model="$model" label="None" :inline="$inline" {{$attributes}}
></x-radio-option>
