<?php

namespace InitializerForLaravel\Core\Contracts;

use InitializerForLaravel\Core\Storage\Template;
use InitializerForLaravel\Packagist\DownloadedPackage;
use InitializerForLaravel\Packagist\Package;
use PhpZip\ZipFile;

interface TemplateRetriever
{
    public function latest(): Template;
    public function fetch(Template $template): ZipFile;
}
