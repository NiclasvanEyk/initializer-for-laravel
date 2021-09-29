<?php

namespace Tests\Feature\Domains\ProjectTemplateCustomization\ArchiveManipulation;

use Domains\ArchiveManipulation\ArchiveManipulator;
use Domains\ArchiveManipulation\ArchiveManipulatorResolver;
use Tests\TestCase;

/**
 * @covers \Domains\ArchiveManipulation\ArchiveManipulatorResolver
 */
class AllArchiveManipulatorsCanBeResolvedTest extends TestCase
{
    /** @test */
    public function it_can_resolve_all_default_archive_manipulators(): void
    {
        $manipulators = $this->resolver()->resolve();

        $manipulators->each(function ($manipulator) {
            $this->assertInstanceOf(ArchiveManipulator::class, $manipulator);
        });
        $this->assertCount(4, $manipulators);
    }

    private function resolver(): ArchiveManipulatorResolver
    {
        return $this->app->make(ArchiveManipulatorResolver::class);
    }
}
