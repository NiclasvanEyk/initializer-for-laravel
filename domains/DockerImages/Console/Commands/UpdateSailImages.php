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
    public function handle(): int
    {
        $runtimesPath = base_path('vendor/laravel/sail/runtimes');
        $pwd = getcwd();

        if ($pwd === false) {
            return 1;
        }

        foreach (File::directories($runtimesPath) as $runtimePath) {
            $runtime = basename($runtimePath);
            if (in_array($runtime, ['7.4', '8.0'])) {
                $this->info("Skipping '$runtime'...");
                continue;
            }

            $this->line("Building <info>{$this->tag($runtime)}</info>...");
            chdir("$runtimesPath/$runtime");

            $this->buildImageFor($runtime);
            $this->pushImageOf($runtime);
        }

        chdir($pwd);

        $this->line('Finished updating runtime images!');

        return 0;
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
