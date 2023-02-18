<?php

namespace Tests\Feature\Domains\Composer;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use InitializerForLaravel\Composer\ComposerJsonFile;
use Tests\TestCase;

/** @covers \InitializerForLaravel\Composer\ComposerJsonFile */
class ComposerJsonFileTest extends TestCase
{
    private FilesystemAdapter $filesystem;

    protected function setUp(): void
    {
        parent::setUp();
        $this->filesystem = Storage::fake();
    }

    /** @test */
    public function it_can_read_and_return_file_contents(): void
    {
        $file = ComposerJsonFile::fromString('{
            "name": "niclasvaneyk/initializr-for-laravel",
            "type": "project"
        }');

        $this->assertEquals([
            'name' => 'niclasvaneyk/initializr-for-laravel',
            'type' => 'project',
        ], $file->contents());
    }

    /**
     * @test
     * @depends it_can_read_and_return_file_contents
     */
    public function it_can_change_the_name(): void
    {
        $file = ComposerJsonFile::fromString('{
            "name": "niclasvaneyk/initializr-for-laravel",
            "type": "project"
        }');

        $file->setFullProjectName('phpunit/phpunit');

        $this->assertEquals([
            'name' => 'phpunit/phpunit',
            'type' => 'project',
        ], $file->contents());
    }

    /**
     * @test
     * @depends it_can_read_and_return_file_contents
     */
    public function it_adds_dependencies_to_existing_require_array(): void
    {
        $file = ComposerJsonFile::fromString('{
            "name": "niclasvaneyk/initializr-for-laravel",
            "type": "project",
            "require": {
                "php": "^8.0"
            }
        }');

        $file->require('laravel/framework', '^8.0');

        $this->assertEquals([
            'name' => 'niclasvaneyk/initializr-for-laravel',
            'type' => 'project',
            'require' => [
                'php' => '^8.0',
                'laravel/framework' => '^8.0',
            ],
        ], $file->contents());
    }

    /**
     * @test
     * @depends it_can_read_and_return_file_contents
     */
    public function it_creates_the_require_array_when_none_exists(): void
    {
        $file = ComposerJsonFile::fromString('{
            "name": "niclasvaneyk/initializr-for-laravel"
        }');

        $file->require('laravel/framework', '^8.0');

        $this->assertEquals([
            'name' => 'niclasvaneyk/initializr-for-laravel',
            'require' => ['laravel/framework' => '^8.0'],
        ], $file->contents());
    }

    /**
     * @test
     * @depends it_can_read_and_return_file_contents
     */
    public function it_adds_dependencies_to_existing_require_dev_array(): void
    {
        $file = ComposerJsonFile::fromString('{
            "name": "niclasvaneyk/initializr-for-laravel",
            "require-dev": {
                "phpunit/phpunit": "^8.0"
            }
        }');

        $file->requireDev('pestphp/pestphp', '^8.0');

        $this->assertEquals([
            'name' => 'niclasvaneyk/initializr-for-laravel',
            'require-dev' => [
                'phpunit/phpunit' => '^8.0',
                'pestphp/pestphp' => '^8.0',
            ],
        ], $file->contents());
    }

    /**
     * @test
     * @depends it_can_read_and_return_file_contents
     */
    public function it_creates_the_require_dev_array_when_none_exists(): void
    {
        $file = ComposerJsonFile::fromString('{
            "name": "niclasvaneyk/initializr-for-laravel",
            "type": "project"
        }');

        $file->requireDev('phpunit/phpunit', '^8.0');

        $this->assertEquals([
            'name' => 'niclasvaneyk/initializr-for-laravel',
            'type' => 'project',
            'require-dev' => [
                'phpunit/phpunit' => '^8.0',
            ],
        ], $file->contents());
    }
}
