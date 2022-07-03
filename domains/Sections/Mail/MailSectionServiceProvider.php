<?php

namespace Domains\Sections\Mail;

use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Sections\Mail\MailDriverOption;
use Domains\Laravel\RelatedPackages\Infrastructure\AwsSdk;
use Domains\Laravel\RelatedPackages\Mail\MailgunMailer;
use Domains\Laravel\RelatedPackages\Mail\PostmarkMailer;
use Domains\Laravel\Sail\Mailhog;
use Domains\Platform\Contracts\ProvidesComposerDependencies;
use Domains\Platform\Contracts\ProvidesSailServices;
use Domains\Platform\Support\SectionServiceProvider;
use Illuminate\Support\Collection;

class MailSectionServiceProvider extends SectionServiceProvider implements ProvidesSailServices, ProvidesComposerDependencies
{
    public function sailServices(CreateProjectForm $form): Collection
    {
        $services = new Collection();

        if ($form->mail->usesMailhog) {
            $services->add(new Mailhog());
        }

        return $services;
    }

    public function composerDependencies(CreateProjectForm $form): Collection
    {
        return new Collection(match ($form->mail->driver) {
            default => [],
            MailDriverOption::MAILGUN => [new MailgunMailer()],
            MailDriverOption::POSTMARK => [new PostmarkMailer()],
            MailDriverOption::SES => [new AwsSdk()],
        });
    }
}
