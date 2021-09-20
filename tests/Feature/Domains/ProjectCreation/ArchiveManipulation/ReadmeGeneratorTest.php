<?php

namespace Tests\Feature\Domains\ProjectCreation\ArchiveManipulation;

use Domains\CreateProjectForm\Sections\Metadata;
use Domains\ProjectTemplateCustomization\ArchiveManipulation\ReadmeGenerator;
use Tests\Feature\Domains\ProjectCreation\CreateProjectFormFixtures;
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
        $form = CreateProjectFormFixtures::allOptionsEnabled(
            metadata: new Metadata(
                vendorName: 'foo',
                projectName: 'bar',
            ),
        );

        $this->assertStringContainsString(
            '# foo/bar',
            $this->generator->render($form),
        );
    }

    /** @test */
    public function it_outputs_the_project_description(): void
    {
        $form = CreateProjectFormFixtures::allOptionsEnabled(
            metadata: new Metadata(
                vendorName: 'foo',
                projectName: 'bar',
                description: 'This is a super descriptive text!'
            ),
        );

        $this->assertStringContainsString(
            'This is a super descriptive text!',
            $this->generator->render($form),
        );
    }
}
