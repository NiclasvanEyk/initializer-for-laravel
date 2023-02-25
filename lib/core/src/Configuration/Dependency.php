<?php

namespace InitializerForLaravel\Core\Configuration;

readonly final class Dependency
{
    const COMPOSER = 'composer';
    const NPM = 'npm';

    public function __construct(
        public string $packageManager,
        public string $id,
        public array $options = [],
    ) {
    }

    public static function composer(string $id, array $options = [])
    {
        return new self(
            packageManager: self::COMPOSER,
            id: $id,
            options: $options,
        );
    }

    public static function npm(string $id, array $options = [])
    {
        return new self(
            packageManager: self::NPM,
            id: $id,
            options: $options,
        );
    }
}
