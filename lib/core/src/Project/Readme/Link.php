<?php

namespace InitializerForLaravel\Core\Project\Readme;

use InitializerForLaravel\Core\Configuration\SimpleDataClass;

/**
 * A link pointing to an interesting URL that is available to the project.
 */
readonly final class Link
{
    use SimpleDataClass;

    public function __construct(public string $description, public string $url)
    {
    }
}
