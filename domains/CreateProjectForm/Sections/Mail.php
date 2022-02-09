<?php

namespace Domains\CreateProjectForm\Sections;

use Domains\Composer\ComposerDependency;
use Domains\CreateProjectForm\Sections\Mail\MailDriverOption;
use Domains\Laravel\RelatedPackages\Infrastructure\AwsSdk;
use Domains\Laravel\RelatedPackages\Mail\MailgunMailer;
use Domains\Laravel\RelatedPackages\Mail\PostmarkMailer;

class Mail
{
    public function __construct(
        public readonly ?MailDriverOption $driver,
        public readonly bool $usesMailhog,
    ) { }

    public function package(): ?ComposerDependency
    {
        return match($this->driver) {
            default => null,
            MailDriverOption::MAILGUN => new MailgunMailer(),
            MailDriverOption::POSTMARK => new PostmarkMailer(),
            MailDriverOption::SES => new AwsSdk(),
        };
    }
}
