@php

    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;

    $model = P::STARTER;
    $laravel = Domains\Laravel\StarterKit\StarterKit::LARAVEL;
    $starter = old(P::STARTER, request(P::STARTER, $laravel))
@endphp

<fieldset
    role="radiogroup"
    class="mb-5 flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 md:space-x-4"
    x-data="{ {{$model}}: '{{ $starter }}' }"
>
    <x-starter-kit::laravel :model="$model" />
    <x-starter-kit::breeze :model="$model" />
    <x-starter-kit::jetstream :model="$model" />
</fieldset>
