<?php

namespace InitializerForLaravel\Core\Project;

use Illuminate\Contracts\Support\Responsable;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use InitializerForLaravel\Core\Exception\MissingTemplate;
use PhpZip\ZipFile;

readonly final class Project implements Responsable
{
    public function __construct(public string $name, public ZipFile $archive)
    {
    }

    public static function from(TemplateStorage $storage, string $name): self
    {
        $archive = $storage->get();
        if (!$archive) {
            throw new MissingTemplate();
        }

        return new self($name, $archive);
    }

    public function toResponse($request)
    {
        return $this->archive->outputAsSymfonyResponse("$this->name.zip");
    }
}
