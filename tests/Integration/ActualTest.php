<?php

namespace Tests\Integration;

use Domains\CreateProjectForm\Sections\Metadata;
use Domains\ProjectTemplateCustomization\ProjectTemplateCustomizer;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Tests\Feature\Domains\ProjectCreation\CreateProjectFormFixtures;
use Tests\TestCase;

/**
 * @group Docker
 */
class ActualTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
    }

    /** @test */
    public function it_can_be_installed()
    {
        $cwd = Storage::path('');
        $customizer = resolve(ProjectTemplateCustomizer::class);

        $archive = $customizer->build(
            CreateProjectFormFixtures::allOptionsEnabled(
                metadata: new Metadata("test", "test"),
            ),
        );

        $archive->extractTo($cwd);
        $this->initialize($cwd);

        // TODO: Assertions
    }

    protected function tearDown(): void
    {
        Process::fromShellCommandline(
            'docker-compose down',
            Storage::path(''),
        );

        parent::tearDown();
    }

    private function initialize(string $cwd): void
    {
        $process = new Process(
            command: ["./initialize", "--no-interaction"],
            cwd: $cwd,
            timeout: 600, // 10 minutes should be enough
        );
        $process->setTty(true);
        $process->enableOutput();

        $process->start();
        $exitCode = $process->wait();

        if ($exitCode !== 0) {
            echo $process->getOutput();
            echo $process->getErrorOutput();
        }

        $this->assertEquals(0, $exitCode);
    }
}
