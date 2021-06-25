@php
    use Domains\Laravel\ComposerPackages\Packages\Dusk;
    use Domains\Laravel\Sail\Selenium;
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;

    $dusk = new Dusk();
    $duskParameter = P::USES_DUSK;
    $usesDusk = old($duskParameter, request()->has($duskParameter));

    $pest = new \Domains\Laravel\RelatedPackages\Community\Pest();
    $pestParameter = P::USES_PEST;
    $usesPest = old($pestParameter, request()->has($pestParameter));
@endphp

<x-form-section name="Testing">
    <x-slot name="description">
        Laravel
        If you want to give your users the ability to execute full-text search
        queries, which go beyond what a simple <code>where</code> SQL clause
        could achieve, this section might be for you.
    </x-slot>

    <x-slot name="icon">
        <x-icons.beaker />
    </x-slot>

    <div class="space-y-4">
        <x-first-party-package.option
            :id="$duskParameter"
            :package="$dusk"
            :checked="$usesDusk"
        >
            <x-slot name="tags">
                <x-tags.sail />
            </x-slot>
        </x-first-party-package.option>

        <x-form-control.checkbox
            id="{{ $pestParameter }}"
            heading="{{ $pest->name() }}"
            href="{{ $pest->href() }}"
            :checked="$usesPest"
        >
            {{ $pest->description() }}

            <x-slot name="tags">
                <x-tags.community />
            </x-slot>
        </x-form-control.checkbox>
    </div>
</x-form-section>
