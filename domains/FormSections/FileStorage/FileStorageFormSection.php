<?php

namespace Domains\FormSections\FileStorage;

use Domains\Core\Contributions\ProvidesComposerPackages;
use Domains\Core\FormSection;
use Domains\Core\View\Blocks\Builders\CheckBoxGroup;
use Domains\Core\View\FormSectionView;
use Illuminate\Support\Collection;

class FileStorageFormSection extends FormSection implements ProvidesComposerPackages
{
    public function view(): FormSectionView
    {
        return (new FormSectionView('File Storage', 'folder'))
            ->paragraph('')
            ->paragraph("Some filesystems are not as popular, so they are not supported out of the box. Choose the ones you need from the options below. To simulate a S3-like filesystem, you can choose to include the MinIO sail service, which is api compatible with S3, but runs locally so you don't need to configure cloud storage for your local development needs.")
            ->checkBox()
            ->checkBoxGroup('', '', fn (CheckBoxGroup $group) => $group
                ->checkBox()
            );
    }

    public function composerPackages(): Collection
    {
    }
}
