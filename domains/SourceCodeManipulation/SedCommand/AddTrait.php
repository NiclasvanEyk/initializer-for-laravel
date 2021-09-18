<?php

namespace Domains\SourceCodeManipulation\SedCommand;

class AddTrait
{
    /**
     * Returns a sed command that adds a trait using the fully qualified name to
     * User.php.
     */
    public static function toUserModel(string $fqn): string
    {
        // Notifiable is the last trait that is added to User.php by default
        return self::to('app/Models/User.php', ', Notifiable;', $fqn);
    }

    private static function to(string $file, string $before, string $trait): string
    {
        $trait = escapeshellcmd(escapeshellarg($trait));

        $sedCommand = "sed \"s/$before/$trait, $before/g\" $file";
        $teeCommand = "tee $file > /dev/null";

        return "$sedCommand | $teeCommand";
    }
}
