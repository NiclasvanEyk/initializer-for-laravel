@php
    /** @var \Domains\Statistics\StatisticsSummary $statistics */
@endphp
<x-layout.default>
    <article class="flex-1 max-w-full mx-auto mb-10 prose dark:prose-invert" style="max-width: min(65ch, 100%);">
        <h1>About</h1>

        <nav class="flex flex-row items-center justify-between py-4">
            <x-link href="https://github.com/NiclasvanEyk/initializer-for-laravel">GitHub</x-link>
            <x-link href="https://github.com/NiclasvanEyk/initializer-for-laravel/issues/new">Report a Bug</x-link>
            <x-link href="https://github.com/NiclasvanEyk/initializer-for-laravel/discussions">Feature Requests</x-link>
            <x-link href="https://github.com/sponsors/NiclasvanEyk?frequency=one-time">Donate</x-link>
        </nav>

        <p>
            Initializer for Laravel takes a visual, approach to setting up a new
            Laravel project. Fill out the form, choose the components you like
            and hit the red "Generate" button at the bottom to download a zip
            archive containing your fresh application. Once you've extracted the
            archive, execute <code>./initialize</code> in your terminal and the
            script will install all components into your application.
        </p>

        <p
            class="text-4xl mt-10 text-center tracking-tight font-extrabold text-gray-900 dark:text-gray-200 sm:text-5xl md:text-6xl mb-0">
            <span class="text-primary-500">{{ $statistics->total }}</span>
            <span class="text-3xl align-middle">projects initialized 🚀</span>
        </p>
        <p class="text-xs text-center">Last checked: {{ $statistics->lastCheckedAt->shortRelativeToNowDiffForHumans() }}
        </p>

        {{-- ---------------------------------------------------------------- --}}

        <h2 id="prerequisites">Prerequisites</h2>

        <p>
            Initializer for Laravel requires you to have
            <x-link href="https://www.docker.com/">Docker</x-link> and
            <code>docker-compose</code> installed and running. A quick guide on
            how to set everything up for various operation systems is explained
            by the
            <x-link href="https://laravel.com/docs#your-first-laravel-project">
                official Laravel documentation
            </x-link>.
        </p>

        <p>
            To make the setup as easy as possible, we use
            <x-link href="https://laravel.com/docs/sail">Laravel Sail</x-link>
            and its services. The blue
            <x-tags.sail :tooltip="false" /> tag
            indicates that an option has a corresponding software component,
            which would normally need to be manually installed on your system.
            By using the power of containers, we are able to automatically
            install such components automatically where it makes sense. For
            example, if you choose to include Redis as a cache for your project,
            we'll automatically enable the service in the generated
            <code>docker-compose.yml</code> file, and once you have initialized
            your application, Redis will be running on your computer inside a
            container.
        </p>

        {{-- ---------------------------------------------------------------- --}}

        <h2 id="motivation">Motivation</h2>

        <p>
            The Laravel "Getting Started" section of the documentation describes
            how the following command can be used to quickly create a new
            Laravel application:
        </p>

        <pre>curl -s "https://laravel.build/example-app" | bash</pre>

        <p>
            This downloads and executes a script from the Laravel servers, which
            generates a new application using Docker. While this works really
            well, you only get the default configurations and some limited
            customization options regarding the included Sail services. Also
            while by default a container for MeiliSearch and Selenium gets
            included, the dependencies for actually connecting and using those
            (Laravel Scout, the MeiliSearch PHP SDK and Laravel Dusk) are
            missing and need to be installed manually.
        </p>

        <p>
            A web form opens up more customization options, where each of the
            components is presented and summarized, with links pointing to more
            detailed documentation.
        </p>

        {{-- ---------------------------------------------------------------- --}}

        <h2 id="credits">Credits & Inspiration</h2>

        <p>
            This project was inspired by the
            <x-link href="https://start.spring.io">Spring Initialzr</x-link>,
            which generates similar archives for applications using the
            <x-link href="https://spring.io">Spring Framework</x-link>. While
            Initializer for Laravel focuses more closely on first-party
            packages, I used the same idea to generate zip archives that are
            parameterized using an online form.
        </p>
    </article>
</x-layout.default>
