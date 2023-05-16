@props(['href'])
@php
/** @var string $href */

$internal = parse_url($href)['host'] === parse_url(config('app.url'))['host'];
@endphp
<a {{ $attributes->merge([
    'class' => 'font-medium text-primary-600 dark:text-primary-500 hover:text-primary-500 dark:hover:text-primary-600 hover:underline',
]) }} @if(!$internal) target="_blank" rel="noopener" @endif href="{{$href}}">{{$slot}}</a>