# Project Template Customization

After downloading the [ProjectTemplate](../ProjectTemplate), we need to adjust 
it based on the values from the [Project Form](../CreateProjectForm).

This is primarily done by independent components, the 
[`ArchiveManipulator`s](../ArchiveManipulation). The 
[`ProjectTemplateCustomizer`](./ProjectTemplateCustomizer.php) from this package
is responsible for passing the template to all 
[`ArchiveManipulator`s](../ArchiveManipulation/ArchiveManipulator.php) 
registered in the container.
