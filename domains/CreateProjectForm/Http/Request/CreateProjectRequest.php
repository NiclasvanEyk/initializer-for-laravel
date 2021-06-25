<?php

namespace Domains\CreateProjectForm\Http\Request;

use Domains\Composer\PackageName;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\BuildsCreateProjectForm;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameterLabel;
use Domains\CreateProjectForm\Validation\Rules\ValidBreezeFrontendOption;
use Domains\CreateProjectForm\Validation\Rules\ValidCacheOption;
use Domains\CreateProjectForm\Validation\Rules\ValidDatabaseOption;
use Domains\CreateProjectForm\Validation\Rules\ValidJetstreamFrontendOption;
use Domains\CreateProjectForm\Validation\Rules\ValidPhpVersionOption;
use Domains\CreateProjectForm\Validation\Rules\ValidQueueDriverOption;
use Domains\CreateProjectForm\Validation\Rules\ValidScoutDriverOption;
use Domains\CreateProjectForm\Validation\Rules\ValidStarterKitOption;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

/**
 * Values that are needed to create a {@link CreateProjectForm}.
 *
 * @property-read string $vendor The package vendor name
 * @property-read string $project The name of the project
 * @property-read string $php The minimum PHP version required by the project
 * @property-read string|null $description A short description for the project
 *
 * @property-read string $starter Which starter kit should be used
 * @property-read bool $usesFortify
 * @property-read bool $usesPassport
 * @property-read bool $usesSocialite
 *
 * @property-read string $database One of the sail supported databases
 *
 * @property-read string $cacheDriver Which cache to use
 *
 * @property-read string $queueDriver Which queue to use
 * @property-read bool $usesHorizon
 *
 * @property-read bool $usesScout
 * @property-read string $scoutDriver
 *
 * @property-read bool $usesTelescope
 * @property-read bool $usesMailhog
 * @property-read bool $usesEnvoy
 *
 * @property-read bool $usesDusk
 * @property-read bool $usesSelenium
 * @property-read bool $usesPest
 *
 * @property-read bool $usesPaddle
 * @property-read bool $usesStripe
 *
 * @property-read bool $usesMinIO
 */
class CreateProjectRequest extends FormRequest
{
    use BuildsCreateProjectForm;

    public function rules(): array
    {
        return [
            /** @see Metadata */
            P::VENDOR => [
                'required',
                'string',
                'regex:/'. PackageName::VENDOR_REGEX . '/',
            ],
            P::PROJECT => [
                'required',
                'string',
                'regex:/'. PackageName::PACKAGE_REGEX . '/',
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
            P::SCOUT_DRIVER => [
                'sometimes',
                new ValidScoutDriverOption(),
            ],

            /** @see Queue */
            P::QUEUE_DRIVER => [
                'sometimes',
                'string',
                new ValidQueueDriverOption(),
            ],

            /** @see DevelopmentTools */
            P::USES_TELESCOPE => ['sometimes'],
            P::USES_MAILHOG => ['sometimes'],
            P::USES_ENVOY => ['sometimes'],

            /** @see Testing */
            P::USES_DUSK => ['sometimes'],
            P::USES_PEST => ['sometimes'],

            /** @see Payment */
            P::USES_PADDLE => ['sometimes'],
            P::USES_STRIPE => ['sometimes'],
            P::USES_MOLLIE => ['sometimes'],

            /** @see Storage */
            P::USES_MINIO => ['sometimes'],
        ];
    }

    public function attributes()
    {
        return CreateProjectRequestParameterLabel::$map;
    }
}
