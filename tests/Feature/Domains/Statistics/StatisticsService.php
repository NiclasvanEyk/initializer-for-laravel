<?php

namespace Tests\Feature\Domains\Statistics;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest;
use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
use Domains\CreateProjectForm\Sections\Cache\CacheOption;
use Domains\CreateProjectForm\Sections\Cashier\CashierDriverOption;
use Domains\CreateProjectForm\Sections\Queue\QueueDriverOption;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriverOption;
use Domains\Statistics\Statistics;

class StatisticsService
{
    public function record(CreateProjectRequest $request): void
    {
        Statistics::create([
            'starter' => $request->get(P::STARTER),
            'database' => $request->get(P::DATABASE),
            'cache' => $request->get(P::CACHE_DRIVER) ?? CacheOption::default(),
            'queue' => $request->get(P::QUEUE_DRIVER) ?? QueueDriverOption::default(),
            'search' => $request->get(P::SCOUT_DRIVER) ?? ScoutDriverOption::default(),
            'cashier' => $request->get(P::CASHIER_DRIVER) ?? CashierDriverOption::default(),
        ]);
    }
}
