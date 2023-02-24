<?php

namespace InitializerForLaravel\Core\View;

use Illuminate\Contracts\View\Engine;
use InitializerForLaravel\Core\View\Model\Section;

class FormBuilder
{
    public function __construct(private readonly Engine $blade)
    {
    }

    /**
     * @param  Section[]  $sections
     */
    public function build(array $sections): string
    {
        $html = '';
        foreach ($sections as $section) {
            $this->blade->get('', []);
        }
    }
}
