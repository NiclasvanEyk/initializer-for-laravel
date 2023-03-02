<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;
use InitializerForLaravel\Core\Configuration\Choice;
use InitializerForLaravel\Core\Configuration\Dependency;
use InitializerForLaravel\Core\Configuration\Section;
use InitializerForLaravel\Core\Configuration\Option;
use function array_key_exists;

class VerifyPackagesCoverage extends Command
{
    protected $name = 'initializer:package-coverage';
    protected $description = 'Verifies that all `composer require`able packages described in the docs are choosable.';

    public function handle()
    {

        $initializerPackages = $this->initializerPackages();
        $mentionedPackages = $this->mentionedPackages();
        $ignored = [
            'spatie/flysystem-dropbox' => 'Only mentioned as an example of a custom flysystem driver',
            'laravel/homestead' => 'Should be used globally, rather than per project',
            'laravel/sanctum' => 'Is included by default',
            'laravel/pint' => 'Is included by default',
        ];

        $missing = $mentionedPackages->diff($ignored)->diff($initializerPackages);
        $amount = $missing->count();
        [$laravelPackages, $other] = $mentionedPackages->partition(
            fn(string $package) => Str::startsWith($package, "laravel/")
        );

        $this->info("First Party");
        $this->printPackageList($laravelPackages, $initializerPackages, $ignored);
        $this->newLine();

        $this->info('Other');
        $this->printPackageList($other, $initializerPackages, $ignored);
        $this->newLine();

        if ($amount > 0) {
            $plural = $amount > 1 ? 's' : '';
            $this->components->error("Missing $amount package$plural!");
            return self::FAILURE;
        } else {
            $this->components->info("All packages mentioned!");
            return self::SUCCESS;
        }
    }

    private function printPackageList(Collection $search, Collection $mentioned, array $ignored): void
    {
        foreach ($search as $package) {
            if ($mentioned->contains($package)) {
                $this->line("✅ $package");
            } else if (array_key_exists($package, $ignored)) {
                $reason = $ignored[$package];
                $this->line("<fg=gray>  $package ($reason)</>");
            } else {
                $this->line("❌ $package");
            }
        }
    }

    private function mentionedPackages(): Collection
    {
        $output = Process::command("src search --json --stream -- 'r:laravel/docs composer require'")
            ->run()
            ->throw()
            ->output();

        $lines = collect(explode("\n", $output));
        return $lines
            ->map(fn(string $line) => json_decode($line, associative: true))
            ->filter(fn($result) => isset($result['type']) && $result['type'] === 'content')
            ->flatMap(fn(array $result) => $result['chunkMatches'])
            ->map(fn(array $match) => trim($match['content']))
            ->map(fn(string $match) => Str::after($match, 'composer require'))
            ->flatMap(fn(string $match) => explode(' ', $match))
            ->filter(fn(string $part) => Str::contains($part, '/'))
            ->unique()
            ->sort()
            ->values();
    }

    private function initializerPackages(): Collection
    {
        return collect(config('initializer-for-laravel')['sections'])
            ->flatMap(fn (Section $section) => $section->children)
            ->filter(fn ($child) => $child instanceof Option || $child instanceof Choice)
            ->flatMap(function (Option|Choice $subject) {
                return $subject instanceof Option
                    ? [$subject]
                    : $subject->options;
            })
            ->flatMap(fn (Option $option) => $option->dependencies)
            ->filter(fn (Dependency $dependency) => $dependency->packageManager === Dependency::COMPOSER)
            ->map(fn (Dependency $dependency) => $dependency->id)
            ->unique()
            ->sort()
            ->values();
    }
}
