<?php

namespace Domains\ArchiveManipulation;

use Domains\CreateProjectForm\CreateProjectForm;
use PhpZip\ZipFile;

/**
 * Component that somehow adds / removes / modifies the contents of the
 * project archive based on the values from the {@link CreateProjectForm}.
 *
 * To enable activations of this interface, use the
 * {@link RegistersArchiveManipulators} trait:
 *
 * ```php
 * class MyCustomServiceProvider extends \Illuminate\Support\ServiceProvider
 * {
 *     use Domains\ProjectTemplateCustomization\ArchiveManipulation\RegistersArchiveManipulators;
 *
 *     public function register()
 *     {
 *         $this->app->bind(MyCustomArchiveManipulator::class, function () {
 *             // Bind an instance to the service container (totally optional,
 *             // if all dependencies for your manipulator can already be
 *             // resolved out of the container, this is not necessary!)
 *         });
 *
 *         // This is required in order for your component to be found!
 *         $this->registerArchiveManipulator(MyCustomArchiveManipulator::class);
 *     }
 * }
 * ```
 */
interface ArchiveManipulator
{
    /**
     * Mutate the contents of {@link archive} by utilizing
     * <pre>$archive->addFromString</pre> and similar methods.
     *
     * @param ZipFile $archive
     * @param CreateProjectForm $form
     */
    public function manipulate(ZipFile $archive, CreateProjectForm $form): void;
}
