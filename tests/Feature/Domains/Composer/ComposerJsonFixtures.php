<?php

namespace Tests\Feature\Domains\Composer;

use Domains\Composer\ComposerJsonFile;

class ComposerJsonFixtures
{
    public static function thisProject(): ComposerJsonFile
    {
        return ComposerJsonFile::fromString(
            file_get_contents(__DIR__.'/../../../../composer.json'),
        );
    }
}
