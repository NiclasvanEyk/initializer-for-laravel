<?php

namespace Domains\CreateProjectForm\Validation\Rules;

use Domains\CreateProjectForm\Sections\Queue\QueueDriverOption;
use Illuminate\Validation\Rules\In;

class ValidQueueDriverOption extends In
{
    public function __construct()
    {
        parent::__construct(QueueDriverOption::values());
    }
}
