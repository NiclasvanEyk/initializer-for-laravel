<?php

namespace Domains\InitializationScript\View\Components\Shell;

use Domains\InitializationScript\View\Components\Initialize\WelcomeBanner;
use Illuminate\View\Component;

/**
 * Asks the user to press any key.
 *
 * This is mainly used, so that the user has enough time to read the contents of
 * the {@link WelcomeBanner}.
 *
 * In the future, this could be combined with the prompt for entering the super-
 * user password, to not interrupt execution twice.
 */
class ConfirmExecution extends Component
{
    public function render(): string
    {
        return <<<BLADE
        if [ -t 1 ];
        then
            echo '';
            read -n 1 -s -r -p "Press any key to continue";
            echo '';
        else
            echo '';
        fi
        BLADE;
    }
}
