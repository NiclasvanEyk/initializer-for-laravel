# InitializationScript

This is the place where the `initialize` script is generated. Note that this mainly represents the _static_ part of the initialization script. Everything that depends on inputs from the form, such as what packages to install, is computed in the [PostDownloadTaskGroupCreator](../PostDownload/PostDownloadTaskGroupCreator.php). 

The generation is done by utilizing [Laravels Blade Components](https://laravel.com/docs/blade#components). Those are divided into
- [**Shell**](./View/Components/Shell) – Generic shell components like banners, bold text, etc.
- [**Initialize**](./View/Components/Initialize) – Components that represent parts of the `initialize` script, what happens when an error occurs, how a [TaskGroup](../PostDownload/PostDownloadTaskGroup.php) should be displayed, or the [welcome banner](./View/Components/Initialize/WelcomeBanner.php)

The resulting template for the script is quite short and can be found under [`./resources/templates/initialize.blade.php`](./resources/templates/initialize.blade.php) 
