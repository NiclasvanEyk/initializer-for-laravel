<?php

namespace Domains\ArchiveManipulation;

use RuntimeException;

class MissingArchiveManipulatorInterfaceException extends RuntimeException
{
    public function __construct(mixed $instance)
    {
        $instanceClass = get_class($instance);
        $manipulatorInterface = ArchiveManipulator::class;

        parent::__construct(
            "An instance of '$instanceClass' was provided as an"
            . ' ArchiveManipulator, but it does not implement'
            . " '$manipulatorInterface'! It won't be used to"
            . ' generate the final project archive, as this is most'
            . 'likely an error.');
    }
}
