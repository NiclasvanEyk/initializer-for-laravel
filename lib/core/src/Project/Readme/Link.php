<?php

namespace InitializerForLaravel\Core\Project\Readme;

/**
 * A link pointing to an interesting URL that is available to the project.
 */
readonly final class Link
{
    public function __construct(public string $description, public string $url)
    {
    }
}
