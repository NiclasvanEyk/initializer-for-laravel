@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\CreateProjectForm\Sections\Metadata\PhpVersion;

    $php = P::PHP;
    $phpVersion = request(P::PHP, PhpVersion::v8_0);
    $allPhpVersions = PhpVersion::values();
    $latestPhpVersion = PhpVersion::latest();
    $description = P::DESCRIPTION;
@endphp

<x-form-section name="Metadata">
    <x-slot name="description">
        Tell us a bit about the project you are creating.
    </x-slot>

    <x-slot name="icon">
        <x-icons.info />
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-4">
        <x-metadata.package-name-input></x-metadata.package-name-input>

        <div class="col-span-3">
            <label for="{{$php}}" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                PHP Version
            </label>

            <select
                required
                name="{{$php}}" id="{{$php}}"
                class="mt-1 block w-full shadow-sm sm:text-sm rounded
                       dark:bg-gray-900 dark:text-gray-100
                       focus:ring-red-500 focus:border-red-500 border-gray-300"
            >
                @foreach($allPhpVersions as $version)
                    <option
                        value="{{ $version }}"
                        @if($version === $phpVersion) selected @endif
                    >
                        {{ $version }}
                        @if($version === $latestPhpVersion)(latest)@endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-span-3">
            <label for="laravelVersion" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                Laravel Version
            </label>

            <span id="laravelVersion"
                class="mt-1 block w-full shadow-sm sm:text-sm rounded
                    py-2 px-4 border border-gray-300 dark:bg-gray-900 dark:text-gray-100
                "
            >
                <x-link href="https://github.com/laravel/laravel/releases">
                    {{ $currentLaravelVersion }}
                </x-link>
            </span>
        </div>
    </div>

    <div class="mt-4">
        <label for="{{$description}}" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
            Description <x-optional></x-optional>
        </label>
        <div class="mt-1">
            <textarea
                id="{{$description}}" name="{{$description}}"
                rows="3"
                class="shadow-sm mt-1 block w-full resize-none
                    dark:bg-gray-900 dark:text-gray-100
                    focus:ring-red-500 focus:border-red-500
                    sm:text-sm border-gray-300 rounded-md"
                placeholder="A brief description for your project"
            ></textarea>
        </div>
    </div>
</x-form-section>