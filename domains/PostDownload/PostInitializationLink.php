<?php

namespace Domains\PostDownload;

class PostInitializationLink
{
    public string $href;

    public function __construct(
        public string $title,
        string $href = '',
        public string $base = 'http://localhost',
    ) {
        $this->href = $this->base.$href;
    }
}
