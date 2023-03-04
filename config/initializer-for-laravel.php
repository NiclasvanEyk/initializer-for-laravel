<?php

use App\Initializer\Configuration\ComposerPackage;
use App\View\Options;
use App\Initializer\Setup;
use App\Initializer\Configuration\Option;
use InitializerForLaravel\Core\Configuration\{Choice,
    Dependency,
    Paragraph,
    Section};
use Illuminate\Support\Str;
use App\Initializer\Configuration\Sail\Service;

return [
    'sections' => [
        new Section(
            name: 'Authentication',
            icon: 'TODO',
            description: Str::markdown(<<<MARKDOWN
            Depending on which starter kit you choose, it might make sense to
            install additional packages. If you are unsure whether you need them
            or not, have a look at the [authentication ecosystem overview](https://laravel.com/docs/authentication#ecosystem-overview)
            section of the official documentation, which explains everything
            well.
            MARKDOWN),
            children: [
                Option::laravel(
                    Options::Fortify,
                    description: "
                    A backend-only implementation for Laravel's authentication
                    features. Allows you to build your own custom user interface
                    for authentication, without reimplementing all the backend
                    functionality. Not needed if you chose Breeze or Jetstream
                    as your starter kit.",
                    setup: [
                        Setup::publishConfigFile("Laravel\Fortify\FortifyServiceProvider"),
                        Setup::migrateDatabase(),
                    ]
                ),
                Option::laravel(
                    Options::Passport,
                    description: '
                    A full OAuth2 server implementation for your Laravel
                    application in a matter of minutes.',
                    setup: [
                        Setup::migrateDatabase(),
                        Setup::artisan("passport:install"),
                        // TODO: Add Trait to user model
                    ]
                ),
                Option::laravel(
                    Options::Socialite,
                    description: '
                    Integrations with popular OAuth providers, so your users can
                    login via Facebook, Twitter, Google and more.',
                ),
            ]
        ),
        new Section(
            name: "File Storage",
            icon: 'TODO',
            description: Str::markdown(<<<MARKDOWN
            Laravel uses [Flysystem](https://flysystem.thephpleague.com) to
            abstract filesystem access to like your local `storage` folder,
            remote (S)FTP servers or cloud buckets.
            MARKDOWN),
            children: [
                Option::composer(
                    package: "league/flysystem-ftp",
                    name: "FTP",
                    description: "",
                    options: ['version' => "^3.0"]
                ),
                Option::composer(
                    package: 'league/flysystem-sftp-v3',
                    name: 'SFTP',
                    description: '',
                    options: ['version' => '^3.0']
                ),
                Option::composer(
                    package: 'league/flysystem-read-only',
                    name: 'Readonly',
                    description: '',
                    options: ['version' => '^3.0']
                ),
                Option::composer(
                    package: 'league/flysystem-path-prefixing',
                    name: 'Scoped',
                    description: '',
                    options: ['version' => '^3.0']
                ),
                new Paragraph("
                    of the box. Choose the ones you need from the options below. To
                    simulate a S3-like filesystem, you can choose to include the MinIO
                    sail service, which is api compatible with S3, but runs locally so
                    you don't need to configure cloud storage for your local development
                    needs.
                "),
                Option::composer(
                    package: 'league/flysystem-aws-s3-v3',
                    name: 'AWS',
                    description: '',
                    options: ['version' => '^3.0']
                ),
                Option::sail(
                    service: Service::MinIO,
                    description: '',
                    link: ''
                ),
            ]
        ),
        new Section(
            name: 'Cache',
            icon: 'TODO',
            description: Str::markdown(<<<MARKDOWN
            TODO
            MARKDOWN),
            children: [
                new Choice(
                    id: 'cache',
                    name: 'Driver',
                    link: '', // TODO
                    default: Service::Redis,
                    options: [
                        Option::sail(
                            service: Service::Redis,
                            description: '',
                            link: 'https://redis.io',
                            composer: [Dependency::composer('predis/predis')],
                        ),
                        Option::sail(
                            service: Service::Memcached,
                            description: 'High-performance, distributed memory object caching system.',
                            link: '', // TODO
                        ),
                        Option::composer(
                            id: 'dynamodb',
                            name: "DynamoDB",
                            description: "", // TODO
                            package: ComposerPackage::awsSdk(),
                        )
                    ])
            ],
        ),
    ],
];
