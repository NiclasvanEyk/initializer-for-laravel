   <?php

use Domains\Support\FileSystem\Path;
use Tests\TestCase;

class PathTest extends TestCase
{
    /**
     * @test
     * @covers Domains\Support\FileSystem\Path::join
     */
    public function it_joins_multiple_path_segments()
    {
        $this->assertEquals(Path::join('foo', 'bar'), 'foo/bar');
    }
}
