<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;
use InitializerForLaravel\Core\View\Model\Option;
use InitializerForLaravel\Core\View\Model\Section;

class VerifyPackagesCoverage extends Command
{
    protected $name = 'initializer:package-coverage';
    protected $description = 'Verifies, that all `composer require`able packages described in the docs are choosable.';

    public function handle()
    {
        $initializerPackages = $this->initializerPackages();
        $mentionedPackages = $this->mentionedPackages();
        $ignore = collect([
            // Only mentioned as an example of a custom flysystem driver
            'spatie/flysystem-dropbox',
        ]);

        $missing = $mentionedPackages
            ->diff($ignore)
            ->diff($initializerPackages);
        $amount = $missing->count();
        $plural = $amount > 1 ? 's' : '';
        $this->components->bulletList($missing->toArray());
        $this->components->error("Missing $amount package$plural!");
    }

    private function mentionedPackages(): Collection
    {
        $output = Process::command("src search --json --stream -- 'r:laravel/docs composer require'")
            ->run()
            ->throw()
            ->output();

        $lines = collect(explode("\n", $output));

        return $lines
            ->map(fn (string $line) => json_decode($line, associative: true))
            ->filter(fn ($result) => isset($result['type']) && $result['type'] === 'content')
            ->flatMap(fn (array $result) => $result['chunkMatches'])
            ->map(fn (array $match) => trim($match['content']))
            ->map(fn (string $match) => Str::after($match, 'composer require'))
            ->flatMap(fn (string $match) => explode(' ', $match))
            ->filter(fn (string $part) => Str::contains($part, '/'))
            ->unique()
            ->sort()
            ->values();
    }

    private function initializerPackages(): Collection
    {
        return collect(config('initializer-for-laravel')['sections'])
            ->flatMap(fn (Section $section) => $section->children)
            ->filter(fn ($child) => $child instanceof Option)
            ->flatMap(fn (Option $option) => Arr::wrap($option->composer))
            ->flatMap(fn (string $packageString) => explode(' ', $packageString))
            ->filter(fn (string $part) => Str::contains($part, '/'))
            ->unique()
            ->sort()
            ->values()
            ->dump();
    }
}
