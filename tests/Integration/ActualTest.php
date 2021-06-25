<?php

namespace Tests\Integration;

use Domains\CreateProjectForm\Sections\Metadata;
use Domains\ProjectTemplateCustomization\ProjectTemplateCustomizer;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Tests\Feature\Domains\ProjectCreation\CreateProjectFormFixtures;
use Tests\TestCase;

class ActualTest extends TestCase
{
    /** @test */
    public function it_can_be_installed()
    {
        Storage::fake();
        $baseDirectory = Storage::path('');

        $form = CreateProjectFormFixtures::allOptionsEnabled(
            metadata: new Metadata("test", "test"),
        );

        $archive = resolve(ProjectTemplateCustomizer::class)->build($form);
        $archive->extractTo($baseDirectory);

        $process = new Process(
            command: ["./initialize"],
            cwd: $baseDirectory,
            timeout: 600, // 10 minutes should be enough
        );
        $process->enableOutput();

        $process->start(function ($type, $buffer) {
            echo $buffer;
        });
        $exitCode = $process->wait(function ($type, $buffer) {
            echo $buffer;
        });

        $this->assertEquals(0, $exitCode);
    }
}
