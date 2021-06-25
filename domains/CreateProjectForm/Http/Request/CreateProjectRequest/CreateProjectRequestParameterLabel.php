<?php

namespace Domains\CreateProjectForm\Http\Request\CreateProjectRequest;

use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as Parameter;
use Domains\Support\Enum\EmulatesEnum;

class CreateProjectRequestParameterLabel
{
    use EmulatesEnum;

    const VENDOR = 'Vendor Name';
    const PROJECT = 'Project Name';
    const DESCRIPTION = 'Description';

    /**
     * @var array<Parameter::*, CreateProjectParameterLabel::*>
     */
    public static array $map = [
        Parameter::VENDOR => self::VENDOR,
        Parameter::PROJECT => self::PROJECT,
        Parameter::DESCRIPTION => self::DESCRIPTION,
    ];
}
