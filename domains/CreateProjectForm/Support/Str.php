<?php

namespace Domains\CreateProjectForm\Support;

class Str
{
    public static function namespace(string $fqn): string
    {
        $dirname = dirname(str_replace('\\', '/', $fqn));

        return str_replace('/', '\\', $dirname);
    }
}
