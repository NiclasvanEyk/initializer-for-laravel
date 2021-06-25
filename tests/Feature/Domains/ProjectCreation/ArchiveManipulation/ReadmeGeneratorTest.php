<?php

namespace Tests\Feature\Domains\ProjectCreation\ArchiveManipulation;

use Domains\ProjectTemplateCustomization\ArchiveManipulation\ReadmeGenerator;
use Domains\ProjectTemplateCustomization\ProjectMetadata;
use Tests\TestCase;

/**
 * @covers \Domains\ProjectTemplateCustomization\ArchiveManipulation\ReadmeGenerator
 */
class ReadmeGeneratorTest extends TestCase
{
    private ReadmeGenerator $generator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->generator = $this->app->make(ReadmeGenerator::class);
    }

    /** @test */
    public function it_renders_a_meaningful_title(): void
    {
        $this->assertStringContainsString(
            '# foo/bar',
            $this->generator->render(new ProjectBlueprint(new ProjectMetadata(
                'foo',
                'bar',
            )))
        );
    }

    /** @test */
    public function it_outputs_the_project_description(): void
    {
        $this->assertStringContainsString(
            'This is a super descriptive text!',
            $this->generator->render(new ProjectBlueprint(new ProjectMetadata(
                'foo',
                'bar',
                'This is a super descriptive text!'
            )))
        );
    }
}
