<?php

namespace Domains\ProjectTemplate\Console\Commands;

use Domains\ProjectTemplate\ProjectTemplateService;
use Illuminate\Console\Command;
use Log;

class UpdateTemplateCommand extends Command
{
    protected $signature = 'initializer:update-template';
    protected $description = 'Downloads the latest release of Laravel if necessary.';

    public function handle(ProjectTemplateService $template) : void
    {
        if (! $template->canBeUpdated()) {
            $this->logAndInfo("Local template storage does not need to be updated");

            return;
        }

        $this->logAndInfo("Downloading latest release...");
        $template->update();

        $this->logAndInfo("Template was updated to the latest release!");
    }

    private function logAndInfo(string $message) : void
    {
        $this->info($message);
        Log::info($message);
    }
}