<?php

namespace Tests\Feature\Domains\Statistics;

use Domains\ProjectTemplateCustomization\ProjectTemplateCustomizer;
use Domains\Statistics\Statistics;
use Domains\Statistics\StatisticsService;
use Exception;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Mockery\MockInterface;
use PhpZip\ZipFile;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Domains\ProjectCreation\CreateProjectFormFixtures;
use Tests\TestCase;

class StatisticsTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $archiveMock = $this->mock(
            ZipFile::class,
            fn (MockInterface $mock) => $mock
                    ->shouldReceive('outputAsSymfonyResponse')
                    ->andReturn(new Response('Test'))
        );
        $this->mock(
            ProjectTemplateCustomizer::class,
            fn (MockInterface $mock) => $mock
                ->shouldReceive('build')
                ->andReturn($archiveMock)
        );
    }

    /** @test */
    public function it_tries_to_create_a_model()
    {
        $this->assertEquals(0, Statistics::query()->count());

        $this->post(
            '/create-project',
            CreateProjectFormFixtures::allParameters(),
        )->assertSuccessful();

        $this->assertEquals(1, Statistics::query()->count());
    }

    /** @test */
    public function it_does_not_crash_the_whole_endpoint()
    {
        $this->mock(StatisticsService::class, fn (MockInterface $mock) => $mock->shouldReceive('record')->andThrow(new Exception('Whoops!'))
        );

        $this->post(
            '/create-project',
            CreateProjectFormFixtures::allParameters(),
        )->assertSuccessful();
    }
}
