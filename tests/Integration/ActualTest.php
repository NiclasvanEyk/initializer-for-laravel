<?php

namespace Tests\Integration;

use Domains\CreateProjectForm\Sections\Metadata;
use Domains\ProjectTemplateCustomization\ProjectTemplateCustomizer;
use Illuminate\Support\Facades\Http;
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
                metadata: new Metadata('test', 'test'),
            ),
        );

        $archive->extractTo($cwd);
        $this->initialize($cwd);

        // Jetstream
        $this->assertStringContainsString(
            'Register',
            Http::get('localhost')->body(),
            'Jetstream does not seem to have been installed',
        );

        // Mailpit
        $this->assertEquals(
            200,
            Http::get('localhost:8025')->status(),
            'Mailpit does not seem to have been installed',
        );

        // Meilisearch
        $this->assertEquals(
            200,
            Http::get('localhost:7700')->status(),
            'MeiliSearch does not seem to have been installed',
        );
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
            command: ['/bin/bash', './initialize'],
            cwd: $cwd,
            timeout: 1000,
        );
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
