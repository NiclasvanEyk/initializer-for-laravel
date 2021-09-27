<?php

namespace Tests\Feature\Domains\ProjectCreation\ArchiveManipulation;

use Domains\ProjectTemplateCustomization\ArchiveManipulation\InitializationScriptGenerator;
use Tests\Feature\Domains\ProjectCreation\CreateProjectFormFixtures;
use Tests\TestCase;

class InstallScriptGeneratorTest extends TestCase
{
    private InitializationScriptGenerator $generator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = $this->app->make(InitializationScriptGenerator::class);
    }

    /** @test */
    public function it_contains_project_setup_instructions(): void
    {
        $result = $this->generator->render(
            CreateProjectFormFixtures::allOptionsEnabled(),
        );

        $this->assertStringContainsString('passport:install', $result);
    }
}
