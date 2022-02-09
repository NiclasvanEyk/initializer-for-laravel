<?php

namespace Domains\ConfigAdjustment\Concerns;

use Illuminate\Support\Str;
use PhpZip\Exception\ZipEntryNotFoundException;
use PhpZip\Exception\ZipException;
use PhpZip\ZipFile;

trait MakesArchiveAdjustments
{
    /**
     * @param ZipFile $archive
     * @param string $file
     * @param array<string, string> $replacements
     * @return void
     * @throws ZipEntryNotFoundException
     * @throws ZipException
     */
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

    /**
     * @param ZipFile $archive
     * @param array<string, string> $replacements
     * @return void
     * @throws ZipEntryNotFoundException
     * @throws ZipException
     */
    protected function replaceEnvExample(ZipFile $archive, array $replacements): void
    {
        $this->replaceInFile($archive, '.env.example', $replacements);
    }
}
