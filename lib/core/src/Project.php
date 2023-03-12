<?php

namespace InitializerForLaravel\Core;

use Illuminate\Contracts\Support\Responsable;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use InitializerForLaravel\Core\Exception\MissingTemplate;
use InitializerForLaravel\Core\Project\Readme;
use InitializerForLaravel\Core\Scripts\PrepareEnvironment;
use PhpZip\ZipFile;

readonly final class Project implements Responsable
{
    public Readme $readme;
    public PrepareEnvironment $prepareEnvironmentScript;

    public function __construct(public string $name, public ZipFile $archive)
    {
        $this->readme = new Readme($this);
        $this->prepareEnvironmentScript = new PrepareEnvironment();
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
