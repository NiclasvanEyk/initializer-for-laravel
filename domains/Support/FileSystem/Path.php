<?php

namespace Domains\Support\FileSystem;

class Path
{
    /**
     * Joins strings to a normalized path.
     *
     * Similar to Pythons `os.path.join`, but with an additional normalization.
     */
    public static function join(string ...$parts): string
    {
        return join(DIRECTORY_SEPARATOR, $parts);
    }
}
