<?php

namespace InitializerForLaravel\Core\Contracts;

use PhpZip\ZipFile;

/**
 * Manages access to a single {@link ZipFile}, that is considered the current
 * version of the template.
 */
interface TemplateStorage
{
    /**
     * The archive containing the current version of the template.
     */
    public function get(): ?ZipFile;

    /**
     * The version of the currently stored template.
     */
    public function version(): ?string;

    /**
     * Replaces the current template with a newer one.
     */
    public function update(string $version, ZipFile $archive): void;
}
