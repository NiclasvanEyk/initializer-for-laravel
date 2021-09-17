<x-layout.default>
    <x-validation.errors :errors="$errors"></x-validation.errors>

    <form
        id="create-project-form"
        method="post"
        action="/create-project"
        class="space-y-16"
    >
        @include('partials.form-section.project-metadata')

        @include('partials.form-section.starter-and-auth')

        @include('partials.form-section.database')

        @include('partials.form-section.storage')

        @include('partials.form-section.cache')

        @include('partials.form-section.queue')

        @include('partials.form-section.search')

        @include('partials.form-section.dev-tools')

        @include('partials.form-section.testing')

        @include('partials.form-section.payments')

        <div class="py-3 flex flex-row w-full justify-end">
            <button
                type="submit"
                class="font-semibold text-lg inline-flex flex-row items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            >
                <x-icons.download />

                Generate
            </button>
        </div>
    </form>
</x-layout.default>
