<x-layout.default>
    <main>
        <x-validation.errors :errors="$errors"></x-validation.errors>

        <form
            id="create-project-form"
            method="post"
            action="/create-project"
            class="space-y-20"
        >
            @include('partials.form-section.project-metadata')

            @include('partials.form-section.starter-kit')

            @include('partials.form-section.authentication')

            @include('partials.form-section.database')

            @include('partials.form-section.storage')

            @include('partials.form-section.cache')

            @include('partials.form-section.queue')

            @include('partials.form-section.mail')

{{--            @include('partials.form-section.notifications')--}}

            @include('partials.form-section.broadcasting')

            @include('partials.form-section.search')

            @include('partials.form-section.dev-tools')

            @include('partials.form-section.testing')

            @include('partials.form-section.payments')

            <div class="prose dark:prose-invert max-w-none">
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

            <div class="flex flex-col items-center justify-center w-full space-y-6 sm:space-x-6 sm:space-y-0 sm:flex-row">
                <x-button.big type="submit">
                    <x-icons.download /> Generate
                </x-button.big>

                <x-button.big type="button" secondary onclick="Initializer.share('create-project-form')">
                    <x-icons.template /> Share
                </x-button.big>
            </div>
        </form>
    </main>
</x-layout.default>