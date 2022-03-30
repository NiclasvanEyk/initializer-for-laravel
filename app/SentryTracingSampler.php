<?php

namespace App;

use Illuminate\Support\Facades\Route;
use Sentry\Tracing\SamplingContext;

class SentryTracingSampler
{
    public static function sample(SamplingContext $context): float
    {
        if (Route::currentRouteNamed('schedule-run')) {
            // This runs regularly and would just eat up the transaction quota
            // over time, so always we drop those traces
            return 0.0;
        }

        // We always sample if the front-end indicates it was sampled to have
        // full traces front to back
        if ($context->getParentSampled()) {
            return 1.0;
        }

        // Default sample rate for all other transactions
        return config('sentry.traces_sample_rate', 0.0);
    }
}
