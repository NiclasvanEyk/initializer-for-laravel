# Initializer for X - Core

Building blocks for generating projects through a friendly and visual user interface.

## Features

- A dynamic configuration system that is easily linkable and includes matching UI components
- Rendering a useful `README.md` ()
- Generating a single script that can build & start the project
- Managing [project templates](./src/Storage/LocalTemplateStorage.php) and keeping them up-to-date
- HTTP controllers that generate a project based on the template, configuration and your own custom generators

## Implementation

To use this, you have to implement and bind the following interfaces into Laravels service container:

- [`TemplateRetriever`](./src/Contracts/TemplateRetriever.php) retrieves a ZIP file that contains the starting point for every application
- [`ProjectGenerator`](./src/Contracts/ProjectGenerator.php) the main class responsible for making adjustments to the project template based on the users choices
