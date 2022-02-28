<?php

namespace Domains\Statistics;

use Carbon\Carbon;
use DateInterval;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\CreateProjectForm\Sections\Cache\CacheOption;
use Domains\CreateProjectForm\Sections\Cashier\CashierDriverOption;
use Domains\CreateProjectForm\Sections\Queue\QueueDriverOption;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use Illuminate\Support\Facades\Cache;

class StatisticsService
{
    const TOTAL_PROJECTS_GENERATED_CACHE_KEY = 'total-number-of-projects-generated';
    const LAST_CHECKED_AT_CACHE_KEY = self::TOTAL_PROJECTS_GENERATED_CACHE_KEY.':last-checked-at';

    public function record(CreateProjectRequest $request): void
    {
        Statistics::create([
            'starter' => $request->get(P::STARTER),
            'database' => $request->get(P::DATABASE),
            'cache' => $request->get(P::CACHE_DRIVER) ?? CacheOption::default(),
            'queue' => $request->get(P::QUEUE_DRIVER) ?? QueueDriverOption::default(),
            'search' => $request->get(P::SCOUT_DRIVER) ?? ScoutDriver::default()->value,
            'cashier' => $request->get(P::CASHIER_DRIVER) ?? CashierDriverOption::default(),
        ]);
    }

    public function summary(): StatisticsSummary
    {
        return new StatisticsSummary(
            total: $this->totalNumberOfProjectsGenerated(),
            lastCheckedAt: $this->lastCheckedAt(),
        );
    }

    private function totalNumberOfProjectsGenerated(): string
    {
        $tomorrow = DateInterval::createFromDateString('tomorrow');

        return rescue(
            fn () => Cache::remember(
                key: self::TOTAL_PROJECTS_GENERATED_CACHE_KEY,
                ttl: $tomorrow,
                callback: function () {
                    $this->markStatisticsAsComputed();

                    return (string) Statistics::query()->count();
                },
            ),
            '100+',
        );
    }

    private function markStatisticsAsComputed(): void
    {
        Cache::set(self::LAST_CHECKED_AT_CACHE_KEY, now()->toString());
    }

    private function lastCheckedAt(): Carbon
    {
        return rescue(
            fn () => Carbon::parse(Cache::get(self::LAST_CHECKED_AT_CACHE_KEY)),
            now(),
        );
    }
}
