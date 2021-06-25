@php
/** @var string $href */

$internal = parse_url($href)['host'] === parse_url(config('app.url'))['host'];
@endphp
<a class="font-medium text-red-600 hover:text-red-500" @if(!$internal) target="_blank" rel="noopener" @endif href="{{$href}}">{{$slot}}</a>
