<?php

use App\View\Options;
use InitializerForLaravel\Core\Setup\CommonTasks as Setup;
use InitializerForLaravel\Core\View\Model\Option;
use InitializerForLaravel\Core\View\Model\Paragraph;
use InitializerForLaravel\Core\View\Model\Section;

return [
    'sections' => [
        new Section(
            'Authentication',
            <<<MARKDOWN
            Depending on which starter kit you choose, it might make sense to
            install additional packages. If you are unsure whether you need them
            or not, have a look at the [authentication ecosystem overview](https://laravel.com/docs/authentication#ecosystem-overview)
            section of the official documentation, which explains everything
            well.
            MARKDOWN,
            [
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
            "File Storage",
            "Laravel uses [Flysystem](https://flysystem.thephpleague.com) to
             abstract filesystem access to like your local `storage` folder,
             remote (S)FTP servers or cloud buckets.",
            [
                new Option(
                    Options::FlysystemFtp->value,
                    'FTP',
                    '',
                    composer: 'league/flysystem-ftp "^3.0"'
                ),
                new Option(
                    Options::FlysystemSftp->value,
                    'SFTP',
                    '',
                    composer: 'league/flysystem-sftp-v3 "^3.0"'
                ),
                new Option(
                    Options::FlysystemReadonly->value,
                    'Readonly',
                    '',
                    composer: 'league/flysystem-read-only "^3.0"'
                ),
                new Option(
                    Options::FlysystemScoped->value,
                    'Scoped',
                    '',
                    composer: 'league/flysystem-path-prefixing "^3.0"'
                ),
                new Paragraph("
                    of the box. Choose the ones you need from the options below. To
                    simulate a S3-like filesystem, you can choose to include the MinIO
                    sail service, which is api compatible with S3, but runs locally so
                    you don't need to configure cloud storage for your local development
                    needs.
                "),
                new Option(
                    Options::FlysystemSftp->value,
                    'AWS S3',
                    '',
                    composer: 'league/flysystem-aws-s3-v3 "^3.0"'
                ),
                new Option(
                    Options::MinIO->value,
                    'MinIO',
                    '',
                    composer: 'league/flysystem-path-prefixing "^3.0"'
                ),
            ]
        )
    ],
];
