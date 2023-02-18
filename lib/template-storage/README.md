# Project Template

The [laravel/laravel](https://github.com/laravel/laravel) repository is the 
starting point of all Laravel applications, which is why we also use it. To not 
need to download it on each request, we periodically check [if a new version was
published](../../domains/ProjectTemplate/Console/Commands/UpdateTemplateCommand.php). 

The downloaded archives are stored on disk. The current version is always stored 
in the `current/` directory and each other version is stored in a folder named 
after its version name on https://packagist.org.

This template archive then goes through a series of tranformations depending on 
the values from the [Project Form](../../domains/CreateProjectForm).
