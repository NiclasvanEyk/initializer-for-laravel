<?php

namespace Domains\ConfigAdjustment;

use Domains\ConfigAdjustment\Concerns\MakesArchiveAdjustments;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use Domains\CreateProjectForm\Sections\Search;
use PhpZip\ZipFile;

class SearchAdjuster
{
    use MakesArchiveAdjustments;

    public function adjustDefaults(
        ZipFile $archive,
        Search $search,
    ): void {
        switch ($search->driver) {
            case ScoutDriver::CUSTOM:
            case ScoutDriver::NONE:
                break;

            case ScoutDriver::MEILISEARCH:
                // Sail already does this, but only for the .env, not for the
                // .env.example, which is a huge oversight if you ask me.
                // This means the key will be in there twice, but I think this
                // as it's only for the person running this, all subsequent
                // installs will only have one entry.
                $this->setScoutDriver($archive, 'meilisearch');
                break;

            case ScoutDriver::ALGOLIA:
                $this->setScoutDriver($archive, 'algolia');
                break;

            case ScoutDriver::DATABASE:
                $this->setScoutDriver($archive, 'database');
                break;
        }
    }

    private function setScoutDriver(ZipFile $archive, string $driver): void
    {
        $this->replaceEnvExample($archive, [
            'MAIL_MAILER' => "SCOUT_DRIVER=$driver"."\n\n".'MAIL_MAILER',
        ]);
    }
}
