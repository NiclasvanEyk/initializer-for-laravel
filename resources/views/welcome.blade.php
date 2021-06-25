<x-layout.default>
    <x-form-divider></x-form-divider>

    @include('partials.form-section.project-metadata')

    <x-form-divider></x-form-divider>

    @include('partials.form-section.local-development')

    <x-form-divider></x-form-divider>

    @include('partials.form-section.first-party-packages')

    <div class="py-3 text-right">
        <button type="submit" class="inline-flex justify-center items-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Generate
        </button>
    </div>
</x-layout.default>
