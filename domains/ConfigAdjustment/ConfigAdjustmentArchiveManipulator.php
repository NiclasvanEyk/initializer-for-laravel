<?php

namespace Domains\ConfigAdjustment;

use Domains\ArchiveManipulation\ArchiveManipulator;
use Domains\CreateProjectForm\CreateProjectForm;
use PhpZip\ZipFile;

class ConfigAdjustmentArchiveManipulator implements ArchiveManipulator
{
    public function __construct(
        private CacheAdjuster $cache,
        private DatabaseAdjuster $database,
        private BroadcastingAdjuster $broadcasting,
        private SearchAdjuster $search,
        private FlysystemAdjuster $flysystem,
    ) {
    }

    public function manipulate(ZipFile $archive, CreateProjectForm $form): void
    {
        $this->database->adjustDefaults($archive, $form->database->database);
        $this->cache->adjustDefaults($archive, $form->cache->driver);
        $this->broadcasting->adjustDefaults($archive, $form->broadcasting);
        $this->search->adjustDefaults($archive, $form->search);
        $this->flysystem->adjustDefaults($archive, $form->storage);
    }
}
