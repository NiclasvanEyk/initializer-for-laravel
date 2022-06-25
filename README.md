# 🚀 Initializer for Laravel

Initializer for Laravel takes a visual, approach to setting up a new Laravel project. Fill out the form, choose the components you like and hit the red "Generate" button at the bottom to download a zip archive containing your fresh application. Once you've extracted the archive, execute `./initialize` in your terminal and the script will install all components into your application. 

## Features

- Overview of all first-party and directly related components of the Laravel ecosystem
- Sharable links to re-use your current configuration for your next project
- Automatic installation - no need to manually execute e.g. `php artisan scout:install`

## Contributing

This project is developed using [Laravel Sail](https://laravel.com/docs/sail). After you [installed all dependencies](https://laravel.com/docs/sail#installing-composer-dependencies-for-existing-projects), the site should be running on http://localhost:8000. Use `vendor/bin/sail npm run watch` to compile the frontend assets and `vendor/bin/sail artisan initializer:update-template` to quickly download the latest version of default [laravel/laravel]() application into your storage.

A [devcontainer.json](.devcontainer/devcontainer.json) configuration is prepared, so you can easily contribute through a GitHub code space or develop inside a container using VS Code. In this case a lot of the setup process is automated for you. If you want better auto-completion or auto-imports, follow the [the intelephense extension quick start guide](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client#quick-start).

## Supporting

If you like supporting the project, consider [sponsoring](https://github.com/sponsors/NiclasvanEyk), as hosting websites costs money. 

Alternatively you could also register for DigitalOcean using the link below. Everyone signing up trough that link gets 100<span>$</span> in platform credit to play around with for 60 days. If you decide to spend 25<span>$</span> on DigitalOcean, I get 25<span>$</span> in platform credit, which is enough to host the site for 5 months.

[![DigitalOcean Referral Badge](https://web-platforms.sfo2.digitaloceanspaces.com/WWW/Badge%203.svg)](https://www.digitalocean.com/?refcode=40b8920547a9&utm_campaign=Referral_Invite&utm_medium=Referral_Program&utm_source=badge)
