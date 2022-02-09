@php
    use Domains\CreateProjectForm\Sections\Mail\MailDriverOption;
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\RelatedPackages\Infrastructure\AwsSdk;
    use Domains\Laravel\RelatedPackages\Mail as MailPackages;

    $driverParameter = P::MAIL_DRIVER;
    $driver = enum_option_selected($driverParameter, MailDriverOption::default())->value;
    $model = Str::studly($driverParameter);

    $mailgun = new MailPackages\MailgunMailer();
    $mailgunOption = MailDriverOption::MAILGUN->value;

    $postmark = new MailPackages\PostmarkMailer();
    $postmarkOption = MailDriverOption::POSTMARK->value;

    $ses = new AwsSdk();
    $sesOption = MailDriverOption::SES->value;

    $mailhog = new \Domains\Laravel\Sail\Mailhog();
    $mailhogParameter = P::USES_MAILHOG;
    $usesMailhog = checkbox_checked(P::USES_MAILHOG, default: true)
@endphp

<x-form-section name="Mail">
    <x-slot name="description">
        <p>
            Laravel provides out-of-the-box support for
            <x-link href="https://laravel.com/docs/mail">sending mail</x-link>
            via <code>sendmail</code> and SMTP. Additional drivers can be
            installed for popular services like Postmark or Mailgun.
            Alternatively, you can
            <x-link href="https://laravel.com/docs/mail#additional-symfony-transports">easily configure</x-link>
            one of the
            <x-link href="https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport">3rd party transports</x-link>
            supported by Symfony Mailer.
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.mail />
    </x-slot>

    <x-form-control.group
        heading="Additional Driver"
        href="https://laravel.com/docs/mail#driver-prerequisites"
        x-data="{'{{ $model }}': '{{ $driver }}'}"
    >
        <x-radio-option-none
            :model="$model"
            :name="$driverParameter"
        />

        <x-radio-option
            :id="$mailgunOption"
            :label="$mailgun->name()"
            :href="$mailgun->href()"
            :model="$model"
            :name="$driverParameter"
        >
            {{ $mailgun->description() }}
        </x-radio-option>

        <x-radio-option
            :id="$postmarkOption"
            :label="$postmark->name()"
            :href="$postmark->href()"
            :model="$model"
            :name="$driverParameter"
        >
            {{ $postmark->description() }}
        </x-radio-option>

        <x-radio-option
            :id="$sesOption"
            label="Amazon Simple Email Service (SES)"
            href="https://aws.amazon.com/de/ses/"
            :model="$model"
            :name="$driverParameter"
        >
            A cost-effective, flexible, and scalable email service that enables developers to send mail from within any application.
        </x-radio-option>
    </x-form-control.group>

    <p class="text-gray-600 dark:text-gray-400">
        <x-link href="https://github.com/mailhog/MailHog">Mailhog</x-link>
        is included by default to ease local development. It intercepts
        mails sent by your application and displays them in a simple web
        interface.
    </p>

    <x-sail.option
        :name="$mailhogParameter"
        :checked="$usesMailhog"
        :option="$mailhog"
    />
</x-form-section>