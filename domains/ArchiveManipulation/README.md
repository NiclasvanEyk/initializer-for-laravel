# Archive Manipulation

This package provides the platform for "plugins" that each transform the 
contents of the [ProjectTemplate](../ProjectTemplate) based on the values from 
the [ProjectForm](../CreateProjectForm).

## Available `ArchiveManipulator`s

- [ConfigAdjustment](../ConfigAdjustment) - adjusts configuration fileS like 
 `.env.example` or `config/database.php` to e.g. use Postgres by default
- [ComposerJson](../Composer/ProjectTemplateCustomization) - sets the values of
  the `composer.json` file
- [InitializationScript](../InitializationScript) - generates the `initialize`
  script
- [Readme](../Readme) - generates the `README.md` file
