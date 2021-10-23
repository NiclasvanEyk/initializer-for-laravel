<?php

namespace Domains\DockerImages\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateSailImages extends Command
{
    protected $name = 'initializer:update-sail-images';
    protected $description = 'Publishes all Laravel Sail runtimes to the Docker hub';

    /**
     * @throws Exception
     */
    public function handle()
    {
        $runtimesPath = base_path('vendor/laravel/sail/runtimes');
        $pwd = getcwd();

        foreach (File::directories($runtimesPath) as $runtimePath) {
            $runtime = basename($runtimePath);
            $this->line("Building <info>{$this->tag($runtime)}</info>...");
            chdir("$runtimesPath/$runtime");

            $this->buildImageFor($runtime);
            $this->pushImageOf($runtime);
        }

        chdir($pwd);

        $this->line('Finished updating runtime images!');
    }

    /**
     * @throws Exception
     */
    private function buildImageFor(string $runtime): void
    {
        $exitCode = 0;
        passthru("docker build --build-arg WWWGROUP=0 -t {$this->tag($runtime)} .", $exitCode);

        if ($exitCode !== 0) {
            throw new Exception("Failed running `docker build` for PHP $runtime!");
        }
    }

    /**
     * @throws Exception
     */
    private function pushImageOf(string $runtime): void
    {
        $exitCode = 0;
        passthru("docker push {$this->tag($runtime)}", $exitCode);

        if ($exitCode !== 0) {
            throw new Exception("Failed running `docker push` for PHP $runtime!");
        }
    }

    private function tag(string $runtime): string
    {
        return "initializerforlaravel/sail-php-$runtime";
    }
}
