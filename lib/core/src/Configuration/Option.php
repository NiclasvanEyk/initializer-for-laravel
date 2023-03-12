<?php

namespace InitializerForLaravel\Core\Configuration;

use Domains\PostDownload\PostDownloadTask;
use InitializerForLaravel\Core\Contracts\Option as OptionContract;
use InitializerForLaravel\Core\Project\Readme\Link;

readonly final class Option implements OptionContract
{
    use SimpleDataClass;

    /**
     * @param string[] $tags
     * @param Dependency[] $dependencies
     * @param string|PostDownloadTask[] $setup
     * @param ?Link $readmeLink
     */
    public function __construct(
        public string       $id,
        public string       $name,
        public string       $description,
        public ?string      $link = null,
        public array        $tags = [],
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function link(): ?string
    {
        return $this->link;
    }

    public function tags(): array
    {
        return $this->tags;
    }
}
