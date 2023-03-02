<?php

namespace InitializerForLaravel\Core\Tests\Unit\Configuration;

use Illuminate\Http\Request;
use InitializerForLaravel\Core\Configuration\ChoiceDefinition;
use InitializerForLaravel\Core\Configuration\Configurator;
use InitializerForLaravel\Core\Configuration\Definition;
use InitializerForLaravel\Core\Configuration\OptionDefinition;
use InitializerForLaravel\Core\Exception\UnknownChoice;
use InitializerForLaravel\Core\Tests\Support\Database;
use InitializerForLaravel\Core\Tests\Support\StarterKit;
use PHPUnit\Framework\TestCase;

final class ConfiguratorTest extends TestCase
{
    public function testItFiltersOutUnknownValuesAndIncludesDefaultOnes(): void
    {
        $definition = new Definition(
            options: [
                new OptionDefinition('livewire'),
                new OptionDefinition('passport'),
                new OptionDefinition('pint', includedByDefault: true)
            ],
            choices: [
                new ChoiceDefinition('starter', StarterKit::class, StarterKit::Laravel),
                new ChoiceDefinition('db', Database::class, Database::MySql),
            ],
        );
        $configurator = new Configurator($definition);

        $request = Request::create('/', parameters: [
            'options' => ['livewire', 'non-existing-option'],
            'choices' => ['starter' => 'breeze', 'non-existing-choice'],
        ]);

        $configuration = $configurator->buildFrom($request);

        // This was chosen by the user
        self::assertTrue($configuration->has('livewire'));
        // This is unknown, so it should be excluded even if its included
        self::assertFalse($configuration->has('non-existing-option'));
        // This should be included by default
        self::assertTrue($configuration->has('pint'));

        // This was chosen by the user
        self::assertEquals(StarterKit::Breeze, $configuration->choice('starter'));
        // This is the default
        self::assertEquals(Database::MySql, $configuration->choice('db'));
        // This is unknown, so it should be excluded even if its included
        $this->expectException(UnknownChoice::class);
        self::assertNull($configuration->choice('non-existing-choice'));
    }
}
