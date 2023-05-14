<?php

namespace Tests\Feature\Domains\ProjectTemplateCustomization\ArchiveManipulation;

use Domains\ConfigAdjustment\FlysystemAdjuster;
use Domains\CreateProjectForm\Sections\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FlysystemAdjusterTest extends TestCase
{
    #[Test]
    public function it_does_nothing_when_none_selected() : void
    {
        $storage = $this->storage(ftp: false, sftp: false);
        $adjusted = $this->manipulate($storage);

        $this->assertEqualsFixture("default.php", $adjusted);
    }

    #[Test]
    public function it_does_works_with_ftp() : void
    {
        $storage = $this->storage(ftp: true, sftp: false);
        $adjusted = $this->manipulate($storage);

        $this->assertEqualsFixture("ftp-only.php", $adjusted);
    }

    #[Test]
    public function it_does_works_with_sftp() : void
    {
        $storage = $this->storage(ftp: false, sftp: true);
        $adjusted = $this->manipulate($storage);

        $this->assertEqualsFixture("sftp-only.php", $adjusted);
    }

    #[Test]
    public function it_does_works_with_both() : void
    {
        $storage = $this->storage(ftp: true, sftp: true);
        $adjusted = $this->manipulate($storage);

        $this->assertEqualsFixture("both.php", $adjusted);
    }

    private function fixturePath(string $name) : string
    {
        return base_path("tests/resources/fixtures/config/filesystem/$name");
    }

    private function assertEqualsFixture(string $name, string $actual) : void
    {
        self::assertStringEqualsFile($this->fixturePath($name), $actual);
    }

    private function defaultConfigContents() : string
    {
        return file_get_contents($this->fixturePath('default.php'));
    }

    private function manipulate(Storage $storage) : string
    {
        return (new FlysystemAdjuster)->adjustContents(
            $this->defaultConfigContents(),
            $storage
        );
    }

    private function storage(bool $sftp, bool $ftp) : Storage
    {
        return new Storage(
            usesSftp: $sftp,
            usesFtp: $ftp,
            usesS3: false,
            usesMinIO: false,
            usesScoped: false,
            usesReadonly: false,
        );
    }
}