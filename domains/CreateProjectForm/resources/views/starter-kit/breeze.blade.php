<x-starter-kit::option
    id="{{\Domains\Laravel\StarterKit\StarterKit::BREEZE}}"
    heading="{{$breeze->name()}}"
    href="{{$breeze->href()}}"
    logo-src="/img/logos/starter/breeze.svg"
    logo-alt="Geometric spinning fan (Laravel Breeze Logo)"
    color="yellow"
    :model="$model"
>
    <p class="mb-4 text-center">
        A simple and easy to customize starter for your application.
    </p>
    <ul class="w-full divide-y divide-gray-300">
        <li class="px-2 py-3 sm:p-2">Login / Logout</li>
        <li class="px-2 py-3 sm:p-2">Password management</li>
        <li class="px-2 py-3 sm:p-2">Publishable assets</li>
        <li class="px-2 py-3 sm:p-2">
            <x-inline-radio
                id="{{$breezeFrontend}}-{{$blade}}" value="{{$blade}}"
                name="{{$breezeFrontend}}"
                :checked="$breezeFrontendChosen === $blade"
                colored="{{$activeAlpineCondition}}"
                color="yellow" class="inline-flex"
            >Blade</x-inline-radio>, <x-inline-radio
                id="{{$breezeFrontend}}-{{$livewire}}" value="{{$livewire}}"
                name="{{$breezeFrontend}}"
                :checked="$breezeFrontendChosen === $livewire"
                colored="{{$activeAlpineCondition}}"
                color="yellow" class="inline-flex"
            >Livewire</x-inline-radio>, <x-inline-radio
                id="{{$breezeFrontend}}-{{$react}}" value="{{$react}}"
                name="{{$breezeFrontend}}"
                :checked="$breezeFrontendChosen === $react"
                colored="{{$activeAlpineCondition}}"
                color="yellow" class="mx-1 inline-flex"
            >React</x-inline-radio>
            or
            <x-inline-radio
                id="{{$breezeFrontend}}-{{$vue}}" value="{{$vue}}"
                name="{{$breezeFrontend}}"
                :checked="$breezeFrontendChosen === $vue"
                colored="{{$activeAlpineCondition}}"
                color="yellow" class="mx-1 inline-flex"
            >Vue</x-inline-radio>

            frontend
        </li>
        <li class="px-2 py-3 sm:p-2">
            Optional <x-inline-radio
                id="{{$breezeFrontend}}-{{$api}}" value="{{$api}}"
                name="{{$breezeFrontend}}"
                :checked="$breezeFrontendChosen === $api"
                colored="{{$activeAlpineCondition}}"
                color="yellow" class="mx-1 inline-flex"
            >API</x-inline-radio>
            stack without any frontend scaffolding
        </li>
    </ul>
</x-starter-kit::option>