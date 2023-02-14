<?php

namespace Tests\Feature\Domains\Composer;

use Composer\Package\Version\VersionSelector;
use Domains\Composer\InlineComposerDependency;
use Domains\Composer\NoInstallationCandidateFoundException;
use Domains\Composer\PackageVersionToInstallResolver;
use Domains\Composer\VersionSelectorFactory;
use Domains\CreateProjectForm\Sections\Metadata\PhpVersion;
use Domains\Laravel\RelatedPackages\Infrastructure\AwsSdk;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @covers Domains\Composer\NoInstallationCandidateFoundException
 * @covers Domains\Composer\PackageVersionToInstallResolver
 * @covers Domains\Composer\VersionSelectorFactory
 */
class VersionResolvingTest extends TestCase
{
    /** @test */
    public function it_throws_an_exception_for_unknown_packages(): void
    {
        $this->expectException(NoInstallationCandidateFoundException::class);

        $versionSelector = $this->mock(
            VersionSelector::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('findBestCandidate')->andReturn(false);
            },
        );

        $resolver = new PackageVersionToInstallResolver($versionSelector);
        $resolver->resolve(collect([
            new InlineComposerDependency(
                id: 'foo',
                name: 'bar',
                description: 'test',
                href: 'https://google.com',
            ),
        ]));
    }

    /** @test */
    public function it_can_resolve_versions_of_known_packages(): void
    {
        $factory = new VersionSelectorFactory();
        $versionSelector = $factory->build(PhpVersion::v8_2);
        $resolver = new PackageVersionToInstallResolver($versionSelector);

        $versions = $resolver->resolve(collect([new AwsSdk()]));
        $this->assertNotEmpty($versions);
    }
}
