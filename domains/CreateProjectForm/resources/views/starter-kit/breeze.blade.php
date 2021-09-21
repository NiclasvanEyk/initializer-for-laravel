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
        <li class="flex flex-row items-center px-2 py-3 sm:p-2">
            <x-inline-radio
                id="{{$breezeFrontend}}-{{$blade}}" value="{{$blade}}"
                name="{{$breezeFrontend}}"
                :checked="$breezeFrontendChosen === $blade"
                colored="{{$activeAlpineCondition}}"
                color="yellow" class="mr-1"
            >
                Blade
            </x-inline-radio>,
            <x-inline-radio
                id="{{$breezeFrontend}}-{{$react}}" value="{{$react}}"
                name="{{$breezeFrontend}}"
                :checked="$breezeFrontendChosen === $react"
                colored="{{$activeAlpineCondition}}"
                color="yellow" class="mx-1"
            >
                React
            </x-inline-radio>
            or
            <x-inline-radio
                id="{{$breezeFrontend}}-{{$vue}}" value="{{$vue}}"
                name="{{$breezeFrontend}}"
                :checked="$breezeFrontendChosen === $vue"
                colored="{{$activeAlpineCondition}}"
                color="yellow" class="mx-1"
            >
                Vue
            </x-inline-radio>

            frontend
        </li>
    </ul>
</x-starter-kit::option>
