<x-layout.default>
    <article class="prose dark:prose-light mx-auto mb-10 flex-1">
        <h1>About</h1>

        <p>
            Initializer for Laravel takes a visual, beginner-friendly approach
            to setting up a new Laravel project. By default it produces nearly
            the same result as following the process described in Laravel's
            <x-link href="https://laravel.com/docs/installation">
                Getting Started
            </x-link> documentation would produce, just with a few more
            packages, to make sure the default Sail services work. For example
            while a new application includes a <code>docker-compose</code>
            service for Meilisearch and Selenium, the necessary packages to
            connect to the Meilisearch instance or run Laravel Dusk tests
            using the built-in `sail dusk` command are missing. Initializer for
            Laravel always makes sure that the correct packages and Sail
            services are installed where it makes sense.
        </p>

        <p>
            By listing all available options it surfaces otherwise easily
            overlooked features or packages, like the possible configuration of
            the starter kits or the choices between different database
            management systems.
        </p>

        <h2 id="credits">Credits</h2>

        <p>
            This project was inspired by the
            <x-link href="https://start.spring.io">
                Spring Initialzr Project
            </x-link>, which makes it very easy to set up new applications using
            the <x-link href="https://spring.io">Spring Framework</x-link>.
        </p>
    </article>
</x-layout.default>
