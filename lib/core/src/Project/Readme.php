<?php

namespace InitializerForLaravel\Core\Project;

use InitializerForLaravel\Core\Project;
use InitializerForLaravel\Core\Project\Readme\Links;

readonly final class Readme
{
    public function __construct(
        public Project $project,
        public Links $links = new Links()
    ) {
    }
}
