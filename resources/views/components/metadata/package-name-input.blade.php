@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameterLabel as Label;

    $vendorParameter = P::VENDOR;
    $vendor = old($vendorParameter, request($vendorParameter));

    $projectParameter = P::PROJECT;
    $project = old($projectParameter, request($projectParameter));

    $inputClasses = "
        mt-1 block w-full shadow-sm sm:text-sm
        focus:ring-red-500 focus:border-red-500 border-gray-300
    ";

    $customVendorSpecified = request()->has($vendorParameter);
@endphp

<script>
    /**
     * Normalized characters for composer names.
     *
     * @param {InputEvent} event
     * @see https://getcomposer.org/doc/04-schema.md#name
     */
    function correctComposerNameOnInput(event) {
        event.target.value = (event.target.value || '')
            .replace(' ', '-')
            .toLowerCase();
    }
</script>

{{-- See https://getcomposer.org/doc/04-schema.md#name --}}
<div
    class="col-span-1 grid grid-cols-3"
    style="grid-template-columns: auto 2em auto;"
>
    <div>
        <label for="{{$vendorParameter}}" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{Label::VENDOR}}
        </label>
        <input type="text" name="{{$vendorParameter}}" id="{{$vendorParameter}}"
               value="{{ $vendor }}"
               pattern="{{\Domains\Composer\PackageName::VENDOR_REGEX}}"
               title="{{\Domains\Composer\PackageName::HUMAN_READABLE_DESCRIPTION}}"
               oninput="correctComposerNameOnInput(event)"
               class="{{$inputClasses}} rounded-l-md dark:bg-black dark:text-gray-100"
               @if(!$customVendorSpecified) autofocus @endif
        >
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">&nbsp;</label>
        <input
            type="text" disabled readonly value="/"
            class="mt-1 bg-gray-100 block shadow-sm sm:text-sm text-center w-full
                   border-gray-300 border-l-0 border-r-0 dark:bg-gray-900 dark:text-gray-100"
        />
    </div>

    <div class="auto-cols-auto">
        <label for="{{$projectParameter}}" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ Label::PROJECT }}
        </label>
        <input
            type="text" name="{{$projectParameter}}" id="{{$projectParameter}}"
            pattern="{{\Domains\Composer\PackageName::PACKAGE_REGEX}}"
            oninput="correctComposerNameOnInput(event)"
            value="{{ $project }}"
            title="{{\Domains\Composer\PackageName::HUMAN_READABLE_DESCRIPTION}}"
            class="{{$inputClasses}} rounded-r-md dark:bg-black dark:text-gray-100"
            @if($customVendorSpecified) autofocus @endif
        />
    </div>
</div>
