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

        <div class="prose dark:prose-light max-w-none">
            <h2 class="!text-xl">Almost there</h2>

            <p>
                When you submit this form by pressing the red "Generate" button,
                a zip archive will be generated and downloaded. This archive
                contains a slightly adjusted version of the default Laravel
                application. Most importantly it contains a shell script which
                completes the initialization process and actually installs all
                selected components. So after you've downloaded and unzipped the
                archive, open a terminal in your project folder and run
            </p>

            <pre><code>./initialize</code></pre>

            <p>
                Alternatively you can check the generated Readme for further
                instructions. If you want to re-use or share your
                configuration, press the "Share" button to generate a link.
            </p>
        </div>

        <div class="flex flex-row items-center justify-center w-full space-x-6">
        <button
                type="submit"
                class="inline-flex flex-row items-center justify-center w-full px-4 py-3 text-xl font-bold text-white transition bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 sm:w-1/3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            >
                <x-icons.download />

                Generate
            </button>

            <button
                type="submit"
                class="inline-flex flex-row items-center justify-center w-full px-4 py-3 text-xl font-bold text-white transition bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 sm:w-1/3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            >
                <x-icons.template />

                Share
            </button>
        </div>

        <div></div>
    </form>
</x-layout.default>