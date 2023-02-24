<?php

namespace InitializerForLaravel\Core\Http;

use Domains\CreateProjectForm\CreateProjectForm;
use Illuminate\Http\Request;

/**
 * @template T
 */
class OptionsResolver
{
    /**
     * @param  Request  $request
     * @return T
     */
    public function resolve(Request $request): mixed
    {
    }
}
