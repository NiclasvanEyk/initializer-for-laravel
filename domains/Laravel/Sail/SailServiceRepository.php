<?php

namespace Domains\Laravel\Sail;

class SailServiceRepository
{
    /**
     * @var array<string, class-string<SailConfigurationOption>>
     */
    public static array $serviceMap = [
        Mailhog::REPOSITORY_KEY => Mailhog::class,
        MariaDatabase::REPOSITORY_KEY => MariaDatabase::class,
        MeiliSearch::REPOSITORY_KEY => MeiliSearch::class,
        Memcached::REPOSITORY_KEY => Memcached::class,
        MinIO::REPOSITORY_KEY => MinIO::class,
        MySQLDatabase::REPOSITORY_KEY => MySQLDatabase::class,
        PostgresDatabase::REPOSITORY_KEY => PostgresDatabase::class,
        Redis::REPOSITORY_KEY => Redis::class,
        Selenium::REPOSITORY_KEY => Selenium::class,
    ];

    /**
     * @param string $id
     * @param class-string<SailConfigurationOption>|null $default
     */
    public function resolve(string $id, ?string $default = null): ?SailConfigurationOption
    {
        $fqn = self::$serviceMap[$id] ?? $default;

        if ($fqn === null) {
            return null;
        }

        return new $fqn();
    }

    /**
     * @param  string  ...$ids
     * @return list<SailConfigurationOption>
     */
    public function resolveAll(string ...$ids): array
    {
        return collect($ids)
        ->map(fn ($id) => $this->resolve($id))
        ->values()
        ->all();
    }
}
