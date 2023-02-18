<?php

namespace Domains\Laravel\RelatedPackages\Mail;

use InitializerForLaravel\Composer\ComposerDependency;

class PostmarkMailer extends ComposerDependency
{
    public function id(): string
    {
        return 'postmark';
    }

    public function packageId(): string
    {
        return 'symfony/postmark-mailer';
    }

    public function name(): string
    {
        return 'Postmark';
    }

    public function description(): string
    {
        return 'Postmark integration for Symfony Mailer.';
    }

    public function href(): ?string
    {
        return 'https://github.com/symfony/postmark-mailer';
    }
}
