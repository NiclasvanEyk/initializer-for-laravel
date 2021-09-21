<x-starter-kit::option
    id="{{\Domains\Laravel\StarterKit\StarterKit::JETSTREAM}}"
    heading="{{ $jetstream->name() }}"
    href="{{ $jetstream->href() }}"
    logo-src="/img/logos/starter/jetstream.svg"
    logo-alt="Abstract arc inside a circle (Laravel Jetstream Logo)"
    color="indigo"
    :model="$model"
>
    <p class="mb-4 text-center">
        A production-ready and feature-rich starter for your application.
    </p>
    <ul class="w-full divide-y divide-gray-300">
        <li class="px-2 py-3 sm:p-2">Login / Logout</li>
        <li class="px-2 py-3 sm:p-2">Password management</li>
        <li class="px-2 py-3 sm:p-2">Profile management</li>
        <li class="px-2 py-3 sm:p-2">Email verification</li>
        <li class="px-2 py-3 sm:p-2">Two-factor authentication</li>
        <li class="px-2 py-3 sm:p-2">Session management</li>
        <li class="px-2 py-3 sm:p-2">API support via Laravel Sanctum</li>
        <li class="px-2 py-3 sm:p-2">
            <label
                for="{{$jetstreamTeams}}"
                class="flex flex-row items-center w-full"
            >
                <input
                    id="{{$jetstreamTeams}}" name="{{$jetstreamTeams}}"
                    class="w-4 h-4 mr-2 transition border-gray-300 rounded focus:ring-indigo-500"
                    x-bind:class="{{$activeAlpineCondition}}
                        ? 'text-indigo-600'
                        : 'text-gray-300 opacity-20'
                    "
                    type="checkbox" @if($jetstreamTeamsChecked) checked @endif()
                />
                Team management <x-optional class="ml-1" />
            </label>
        </li>
        <li class="flex flex-row items-center px-2 py-3 sm:p-2">
            <x-inline-radio
                id="{{$jetstreamFrontend}}-{{$inertia}}" value="{{$inertia}}"
                name="{{$jetstreamFrontend}}"
                :checked="$jetstreamFrontendChosen === $inertia"
                colored="{{$activeAlpineCondition}}"
                color="indigo" class="mr-1"
            >
                Inertia
            </x-inline-radio>
            or
            <x-inline-radio
                id="{{$jetstreamFrontend}}-{{$livewire}}" value="{{$livewire}}"
                name="{{$jetstreamFrontend}}"
                :checked="$jetstreamFrontendChosen === $livewire"
                colored="{{$activeAlpineCondition}}"
                color="indigo" class="mx-1"
            >
                Livewire
            </x-inline-radio>

            frontend
        </li>
    </ul>
</x-starter-kit::option>
