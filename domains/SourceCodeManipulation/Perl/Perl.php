<?php

namespace Domains\SourceCodeManipulation\Perl;

class Perl
{
    public static function replace(
        string $file,
        string $pattern,
        string $replacement,
        string $flags = 'g',
    ): string {
        return "perl -0777 -pi -e 's/$pattern/$replacement/$flags' $file";
    }
}
