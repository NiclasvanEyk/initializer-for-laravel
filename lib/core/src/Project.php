<?php

namespace InitializerForLaravel\Core;

use Illuminate\Contracts\Support\Responsable;
use InitializerForLaravel\Core\Contracts\TemplateStorage;
use InitializerForLaravel\Core\Exception\MissingTemplate;
use InitializerForLaravel\Core\Project\ProjectRenderer;
use InitializerForLaravel\Core\Project\Readme;
use InitializerForLaravel\Core\Scripts\ProjectScripts;
use PhpZip\ZipFile;

use function resolve;

final class Project implements Responsable
{
    public Readme $readme;
    public ProjectScripts $scripts;

    public function __construct(
        public readonly ZipFile $archive,
        public string $name = 'Unknown',
        public string $description = ''
    ) {
        $this->readme = new Readme($this);
        $this->scripts = new ProjectScripts();
    }

    public static function from(TemplateStorage $storage): self
    {
        $archive = $storage->get();
        if (! $archive) {
            throw new MissingTemplate();
        }

        return new self($archive);
    }

    public function toResponse($request)
    {
        $this->renderer()->render($this);

        return $this->archive->outputAsSymfonyResponse("$this->name.zip");
    }

    private function renderer(): ProjectRenderer
    {
        return resolve(ProjectRenderer::class);
    }
}
