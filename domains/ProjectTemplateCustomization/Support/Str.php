<?php

namespace Domains\ProjectTemplateCustomization\Support;

class Str
{
    public static function indentLines(
        string $lines,
        int $level = 1,
        int $tabSize = 4,
        string $eol = PHP_EOL,
    ): string {
        $indent = str_repeat(' ', $level * $tabSize);

        return \Illuminate\Support\Str::of($lines)
            ->explode($eol)
            ->map(fn (string $line) => $indent . $line)
            ->join($eol);
    }
}
