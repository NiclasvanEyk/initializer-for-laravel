<?php

namespace Domains\CreateProjectForm\Sections\Mail;

enum MailDriverOption: string
{
    case NONE = 'none';
    case MAILGUN = 'mailgun';
    case POSTMARK = 'postmark';
    case SES = 'ses';

    public static function default(): self
    {
        return self::NONE;
    }
}
