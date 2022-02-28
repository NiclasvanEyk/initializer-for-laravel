<?php

namespace Domains\Statistics;

use Carbon\Carbon;

class StatisticsSummary
{
    public function __construct(
        public readonly int $total,
        public readonly Carbon $lastCheckedAt,
    ) { }
}
