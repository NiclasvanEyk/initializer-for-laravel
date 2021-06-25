<?php

namespace Domains\ProjectTemplate;

use Domains\Composer\ComposerJsonFile;
use Domains\Support\FileSystem\Path;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Laravel\Installer\Console\NewCommand;
use Symfony\Component\Console\Output\OutputInterface;

class LaravelDownloader
{
    const TEMPLATE_PROJECT_NAME = 'initializer-template';

    public function __construct(private string $baseDirectory) { }

    private function templatePath(string ...$path) : string
    {
        return Path::join(
            $this->baseDirectory,
            self::TEMPLATE_PROJECT_NAME,
            ...$path,
        );
    }

    public function download(?OutputInterface $outputBuffer = null): void
    {
        $name = self::TEMPLATE_PROJECT_NAME;
        chdir($this->baseDirectory);

        $exitCode = Artisan::call(NewCommand::class, [
            '--force' => true,
            'name' => $name,
        ], $outputBuffer);

        if ($exitCode !== 0) {
            throw new \Exception("Download exited with code '$exitCode'!");
        }

        $composerJson = ComposerJsonFile::open(
            $this->templatePath('composer.json')
        );

        // All of these get automatically installed, but are not needed by us.
        // Maybe it will be better in the future to just clone it from GH, but
        // for now, this works fine.
        File::deleteDirectory($this->templatePath('vendor'));
        File::delete([
            $this->templatePath('.env'),
            $this->templatePath('README.md'),
            $this->templatePath('composer.json'),
            $this->templatePath('composer.lock'),
        ]);

        (new TemplateStorage())->store($this->templatePath(), $composerJson);
    }
}
