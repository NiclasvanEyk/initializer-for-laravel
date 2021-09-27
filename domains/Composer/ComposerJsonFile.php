<?php

namespace Domains\Composer;

use Illuminate\Support\Arr;

/**
 * Can be used to mutate the contents of a `composer.json` file.
 *
 * Make sure to call {@link ComposerJsonFile::flush()} to actually write the
 * changes to disk, otherwise it is only changed in memory!
 */
final class ComposerJsonFile
{
    /**
     * @param  array<string, mixed>  $contents
     */
    private function __construct(private array $contents)
    {
    }

    public static function fromString(string $rawContents): self
    {
        return new self(json_decode(
            $rawContents,
            associative: true,
            flags: JSON_THROW_ON_ERROR
        ));
    }

    /** @return array<string, mixed> */
    public function contents(): array
    {
        return $this->contents;
    }

    public function prettyContents(): string
    {
        $encoded = json_encode(
            $this->contents,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );

        if ($encoded === false) {
            throw new \Exception('Error while encoding composer.json: '.json_last_error_msg());
        }

        return $encoded;
    }

    public function require(string $package, string $version): static
    {
        Arr::set($this->contents, "require.$package", $version);

        return $this;
    }

    public function requireDev(string $package, string $version): static
    {
        Arr::set($this->contents, "require-dev.$package", $version);

        return $this;
    }

    public function setFullProjectName(string $fullProjectName): static
    {
        Arr::set($this->contents, 'name', $fullProjectName);

        return $this;
    }

    public function setDescription(string $description): static
    {
        Arr::set($this->contents, 'description', $description);

        return $this;
    }

    public function setPhpVersion(string $version): static
    {
        Arr::set($this->contents, 'require.php', "^$version");

        return $this;
    }

    public function removeScript(string $script): static
    {
        Arr::forget($this->contents, "scripts.$script");

        return $this;
    }
}
