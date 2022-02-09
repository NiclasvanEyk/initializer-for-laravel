<?php

namespace Domains\Laravel\RelatedPackages\Mail;

use Domains\Composer\ComposerDependency;

class MailgunMailer extends ComposerDependency
{
    public function id(): string
    {
        return 'mailgun';
    }

    public function packageId(): string
    {
        return 'symfony/mailgun-mailer';
    }

    public function name(): string
    {
        return 'Mailgun';
    }

    public function description(): string
    {
        return 'Mailgun integration for Symfony Mailer.';
    }

    public function href(): ?string
    {
        return 'https://github.com/symfony/mailgun-mailer';
    }
}
