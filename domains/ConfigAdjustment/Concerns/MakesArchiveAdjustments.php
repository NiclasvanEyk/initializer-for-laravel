<?php

namespace Domains\ConfigAdjustment\Concerns;

use Illuminate\Support\Str;
use PhpZip\ZipFile;

trait MakesArchiveAdjustments
{
    protected function replaceInFile(ZipFile $archive, string $file, array $replacements): void
    {
        $contents = $archive->getEntryContents($file);
        $replacedContents = Str::replace(
            array_keys($replacements),
            array_values($replacements),
            $contents,
        );

        $archive->addFromString($file, $replacedContents);
    }

    protected function replaceEnvExample(ZipFile $archive, array $replacements): void
    {
        $this->replaceInFile($archive, '.env.example', $replacements);
    }
}
