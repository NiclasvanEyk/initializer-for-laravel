<?php

namespace Domains\ProjectTemplate\Console\Commands;

use Domains\ProjectTemplate\LaravelDownloader;
use Illuminate\Console\Command;

class DownloadCommand extends Command
{
    protected $signature = 'initializer:download';
    protected $description = 'Downloads the latest version of laravel';

    public function handle()
    {
        $downloader = new LaravelDownloader(sys_get_temp_dir());
        $downloader->download($this->getOutput());

        $this->info('Download finished successfully!');
    }
}
