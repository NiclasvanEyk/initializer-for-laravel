<?php

namespace InitializerForLaravel\Core\Project\Readme;

/**
 * A link pointing to an interesting URL that is available to the project.
 */
final class Links
{
    /**
     * @param Link[] $entries
     */
    public function __construct(public array $entries = [])
    {
    }

    public function add(string $description, string $url): self
    {
        $this->entries[] = new Link($description, $url);
        return $this;
    }
}
