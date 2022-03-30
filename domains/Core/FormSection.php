<?php

namespace Domains\Core;

use Domains\Core\View\FormSectionView;

abstract class FormSection
{
    /**
     * Builds the actual HTML for the form.
     */
    abstract public function view(): FormSectionView;
}
