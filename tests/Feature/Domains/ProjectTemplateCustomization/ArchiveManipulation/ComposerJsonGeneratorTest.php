<?php

namespace Tests\Feature\Domains\ProjectTemplateCustomization\ArchiveManipulation;

use Domains\Composer\ProjectTemplateCustomization\ComposerJsonGenerator;
use Domains\CreateProjectForm\Sections\Metadata;
use Illuminate\Support\Arr;
use Tests\Feature\Domains\Composer\ComposerJsonFixtures;
use Tests\Feature\Domains\ProjectCreation\CreateProjectFormFixtures;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domains\Composer\ProjectTemplateCustomization\ComposerJsonGenerator
 */
class ComposerJsonGeneratorTest extends TestCase
{
    /**
     * @test
     *
     * @covers ::syncMetaData
     */
    public function it_syncs_metadata_fields(): void
    {
        $form = CreateProjectFormFixtures::allOptionsEnabled(
            metadata: new Metadata(
                vendorName: 'test',
                projectName: 'test-project',
                description: 'foo-bar',
                phpVersion: Metadata\PhpVersion::v8_2,
            ),
        );
        $composerJson = ComposerJsonFixtures::thisProject();

        $contents = $this->generator()->render($form, $composerJson);

        $this->assertStringContainsString(
            '"name": "test/test-project",',
            $contents,
            'it should have synced the vendor and project names!'
        );
        $this->assertStringContainsString(
            '"description": "foo-bar",',
            $contents,
            'it should have synced the description!'
        );
        $this->assertStringContainsString(
            '"php": "^8.2",',
            $contents,
            'it should have synced the php version!'
        );
    }

    /**
     * @test
     *
     * @covers ::requirePackages
     */
    public function it_resolves_package_versions(): void
    {
        $form = CreateProjectFormFixtures::allOptionsEnabled();
        $composerJson = ComposerJsonFixtures::thisProject();

        $contents = $this->generator()->render($form, $composerJson);
        $parsed = json_decode($contents, true);
        $requires = Arr::get($parsed, 'require');
        $devRequires = Arr::get($parsed, 'require-dev');

        $this->assertArrayHasKey('doctrine/dbal', $requires);
        $this->assertArrayHasKey('laravel/telescope', $devRequires);
    }

    /**
     * @test
     *
     * @covers ::removeUnnecessaryScripts
     */
    public function it_removes_unnecessary_scripts(): void
    {
        $form = CreateProjectFormFixtures::allOptionsEnabled();
        $composerJson = ComposerJsonFixtures::thisProject();

        $contents = $this->generator()->render($form, $composerJson);

        $unnecessaryScripts = [
            'post-root-package-install',
            'post-create-project-cmd',
        ];
        foreach ($unnecessaryScripts as $script) {
            $this->assertStringNotContainsString($script, $contents);
        }
    }

    private function generator(): ComposerJsonGenerator
    {
        return resolve(ComposerJsonGenerator::class);
    }
}
