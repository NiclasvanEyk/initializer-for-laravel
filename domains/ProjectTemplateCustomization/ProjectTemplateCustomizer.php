<?php

namespace Domains\ProjectTemplateCustomization;

use Domains\Composer\ComposerJsonFile;
use Domains\CreateProjectForm\CreateProjectForm;
use Domains\ProjectTemplate\TemplateStorage;
use Domains\ProjectTemplateCustomization\ArchiveManipulation\CacheConfigurer;
use Domains\ProjectTemplateCustomization\ArchiveManipulation\ComposerJsonGenerator;
use Domains\ProjectTemplateCustomization\ArchiveManipulation\DatabaseConfigurer;
use Domains\ProjectTemplateCustomization\ArchiveManipulation\InitializationScriptGenerator;
use Domains\ProjectTemplateCustomization\ArchiveManipulation\ReadmeGenerator;
use PhpZip\ZipFile;

/**
 * Builds the final archive from the laravel/laravel template.
 */
class ProjectTemplateCustomizer
{
    public function __construct(
        private TemplateStorage               $template,
        private ReadmeGenerator               $readmeGenerator,
        private ComposerJsonGenerator         $composerJsonGenerator,
        private InitializationScriptGenerator $installScriptGenerator,
        private DatabaseConfigurer            $databaseConfigurer,
        private CacheConfigurer               $cacheConfigurer,
    ) { }

    public function build(CreateProjectForm $form): ZipFile
    {
        $archive = $this->template->currentArchive();
        $composerJson = ComposerJsonFile::fromString(
            $archive->getEntryContents('composer.json'),
        );

        $this->addReadme($archive, $form);
        $this->addComposerJson($archive, $form, $composerJson);
        $this->addInstallScript($archive, $form);

        $this->adjustDatabaseDefaults($archive, $form);
        $this->adjustCacheDefaults($archive, $form);

        return $archive;
    }

    public function addReadme(
        ZipFile $archive,
        CreateProjectForm $form,
    ): void {
        $archive->addFromString(
            'README.md',
            $this->readmeGenerator->render($form),
        );
    }

    public function addComposerJson(
        ZipFile $archive,
        CreateProjectForm $form,
        ComposerJsonFile $composerJson,
    ): void {
        $archive->addFromString(
            'composer.json',
            $this->composerJsonGenerator->render($form, $composerJson),
        );
    }

    public function adjustDatabaseDefaults(
        ZipFile $archive,
        CreateProjectForm $form,
    ): void {
        $this->databaseConfigurer->adjustDefaults(
            $archive,
            $form->database->database,
        );
    }

    private function adjustCacheDefaults(
        ZipFile $archive,
        CreateProjectForm $form,
    ): void {
        $this->cacheConfigurer->adjustDefaults($archive, $form->cache->driver);
    }

    public function addInstallScript(
        ZipFile $archive,
        CreateProjectForm $form,
    ): void {
        $archive->addFromString(
            $this->installScriptGenerator->scriptName(),
            $this->installScriptGenerator->render($form),
        );

        // Make sure the script is executable
        $archive->getEntry(
            $this->installScriptGenerator->scriptName()
        )->setUnixMode(0100754);
    }
}
