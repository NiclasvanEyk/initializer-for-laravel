@props(['href'])
@php
/** @var string $href */

$internal = parse_url($href)['host'] === parse_url(config('app.url'))['host'];
@endphp
<a {{ $attributes->merge([
    'class' => 'font-medium text-red-600 dark:text-red-500 hover:text-red-500 dark:hover:text-red-600 hover:underline',
]) }} @if(!$internal) target="_blank" rel="noopener" @endif href="{{$href}}">{{$slot}}</a>