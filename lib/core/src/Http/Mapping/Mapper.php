<?php

namespace InitializerForLaravel\Core\Http\Mapping;

use Illuminate\Http\Request;

class Mapper
{
    /**
     * @template T
     * @param Request $request
     * @param class-string<T> $target
     * @return T
     */
    public function map(Request $request, string $target)
    {
        return Instantiator::build($target, new RequestResolver($request));
    }
}
