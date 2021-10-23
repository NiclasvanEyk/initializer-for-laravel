<?php

namespace Domains\SourceCodeManipulation\Perl;

class AddTrait
{
    /**
     * Returns a sed command that adds a trait using the fully qualified name to
     * User.php.
     */
    public static function toUserModel(string $fqn): string
    {
        // Notifiable is the last trait that is added to User.php by default
        return self::to('app/Models/User.php', $fqn);
    }

    private static function to(string $file, string $trait): string
    {
        $trait = escapeshellcmd($trait);
        $class = pathinfo($file, PATHINFO_FILENAME);

        return "perl -0777 -pi -e 's/(class $class.*{)/$1\\n    use $trait;/gms' $file";
    }
}
