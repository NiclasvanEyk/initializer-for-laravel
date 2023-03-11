<?php

namespace InitializerForLaravel\Core\Storage;

readonly final class Template
{
    public function __construct(
        public string $url,
        public string $version,
    ) {
    }
}
