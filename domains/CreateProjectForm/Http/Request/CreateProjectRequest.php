<?php

namespace Domains\CreateProjectForm\Http\Request;

use Domains\Composer\PackageName;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\BuildsCreateProjectForm;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameterLabel;
use Domains\CreateProjectForm\Sections\Broadcasting;
use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption;
use Domains\CreateProjectForm\Sections\Mail;
use Domains\CreateProjectForm\Sections\Mail\MailDriverOption;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use Domains\CreateProjectForm\Validation\Rules\ValidBreezeFrontendOption;
use Domains\CreateProjectForm\Validation\Rules\ValidCacheOption;
use Domains\CreateProjectForm\Validation\Rules\ValidCashierDriverOption;
use Domains\CreateProjectForm\Validation\Rules\ValidDatabaseOption;
use Domains\CreateProjectForm\Validation\Rules\ValidJetstreamFrontendOption;
use Domains\CreateProjectForm\Validation\Rules\ValidPhpVersionOption;
use Domains\CreateProjectForm\Validation\Rules\ValidQueueDriverOption;
use Domains\CreateProjectForm\Validation\Rules\ValidStarterKitOption;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * Values that are needed to create a {@link CreateProjectForm}.
 */
class CreateProjectRequest extends FormRequest
{
    use BuildsCreateProjectForm;

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            /** @see Metadata */
            P::VENDOR => [
                'required',
                'string',
                'regex:/'.PackageName::VENDOR_REGEX.'/',
            ],
            P::PROJECT => [
                'required',
                'string',
                'regex:/'.PackageName::PACKAGE_REGEX.'/',
            ],
            P::PHP => ['sometimes', 'string', new ValidPhpVersionOption()],
            P::DESCRIPTION => ['nullable', 'sometimes', 'string'],

            /** @see Authentication */
            P::STARTER => ['sometimes', 'string', new ValidStarterKitOption()],
            P::JETSTREAM_FRONTEND => [
                'sometimes',
                'string',
                new ValidJetstreamFrontendOption(),
            ],
            P::USES_JETSTREAM_TEAMS => ['sometimes'],
            P::BREEZE_FRONTEND => [
                'sometimes',
                'string',
                new ValidBreezeFrontendOption(),
            ],
            P::USES_FORTIFY => ['sometimes'],
            P::USES_PASSPORT => ['sometimes'],
            P::USES_SOCIALITE => ['sometimes'],

            /** @see Database */
            P::DATABASE => ['sometimes', 'string', new ValidDatabaseOption()],

            /** @see Cache */
            P::CACHE_DRIVER => ['sometimes', 'string', new ValidCacheOption()],

            /** @see Search */
            P::SCOUT_DRIVER => ['sometimes', new Enum(ScoutDriver::class)],

            /** @see Queue */
            P::QUEUE_DRIVER => [
                'sometimes',
                'string',
                new ValidQueueDriverOption(),
            ],

            /** @see Mail */
            P::MAIL_DRIVER => ['sometimes', new Enum(MailDriverOption::class)],
            P::USES_MAILHOG => ['sometimes'],

            /** @see Broadcasting */
            P::BROADCASTING_CHANNEL => ['sometimes', new Enum(BroadcastingChannelOption::class)],

            /** @see DevelopmentTools */
            P::USES_TELESCOPE => ['sometimes'],
            P::USES_ENVOY => ['sometimes'],
            P::USES_PAIL => ['sometimes'],

            /** @see Testing */
            P::USES_DUSK => ['sometimes'],
            P::USES_PEST => ['sometimes'],

            /** @see Payment */
            P::CASHIER_DRIVER => [
                'sometimes',
                'string',
                new ValidCashierDriverOption(),
            ],

            /** @see Storage */
            P::USES_MINIO => ['sometimes'],
            P::USES_FLYSYSTEM_SFTP_DRIVER => ['sometimes'],
            P::USES_FLYSYSTEM_S3_DRIVER => ['sometimes'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return CreateProjectRequestParameterLabel::$map;
    }
}
