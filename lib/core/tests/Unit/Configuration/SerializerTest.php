<?php

namespace InitializerForLaravel\Core\Tests\Unit\Configuration;

use InitializerForLaravel\Core\Configuration\Configuration;
use InitializerForLaravel\Core\Configuration\Serializer;
use InitializerForLaravel\Core\Tests\Support\Database;
use InitializerForLaravel\Core\Tests\Support\StarterKit;
use PHPUnit\Framework\TestCase;

use function urldecode;

final class SerializerTest extends TestCase
{
    public function testItBuildsQueryStrings(): void
    {
        $configuration = new Configuration([
            'starter' => StarterKit::Breeze,
            'database' => Database::Postgres,
        ], ['pest', 'pennant', 'ably']);

        self::assertQueryStringEquals(
            'database=postgres&starter=breeze&include=ably,pennant,pest',
            $this->queryString($configuration)
        );
    }

    private static function assertQueryStringEquals(string $expected, string $actual): void
    {
        self::assertEquals($expected, urldecode($actual));
    }

    private function queryString(Configuration $configuration): string
    {
        return (new Serializer())->queryString($configuration);
    }
}
