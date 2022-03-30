<?php

namespace Domains\Core\Contributions;

use Domains\CreateProjectForm\CreateProjectForm;
use PhpZip\ZipFile;

interface ManipulatesArchive
{
    /**
     * Mutate the contents of {@link archive} by utilizing
     * <pre>$archive->addFromString</pre> and similar methods.
     *
     * @param  ZipFile  $archive
     * @param  CreateProjectForm  $form
     */
    public function manipulateArchive(ZipFile $archive, CreateProjectForm $form): void;
}
