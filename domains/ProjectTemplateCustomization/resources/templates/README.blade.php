@php /** @var \Domains\Markdown\Renderer $markdown */ @endphp
{{ $markdown->h1($title) }}

@if(!empty($description))
{{$description}}

@endif
{{ $markdown->h2('TODO') }}

This project was generated using
({{ $markdown->link('Initializer for Laravel', $initializerUrl) }}). To finish
the project setup run the following in your terminal:

{{ $markdown->codeBlock("./$initializationScript", 'shell') }}

<details>
    <summary>Detailed steps that will be executed</summary>

{{ $markdown->h3('Installation steps') }}

{!! $todos !!}

</details>

{{ $markdown->h2('Local Development') }}

This project uses
{{ $markdown->link('Laravel Sail', 'https://laravel.com/docs/sail') }} to manage
its local development stack. For more detailed usage instructions take a look at
the
{{ $markdown->link('official documentation','https://laravel.com/docs/sail') }}.

{{ $markdown->h3('Start the development server') }}

{{ $markdown->codeBlock('./vendor/bin/sail up', 'shell') }}

You can also use the {{ $markdown->code('-d') }} option, to start the server in
the background if you do not care about the logs or still want to use your
terminal for other things.

{{ $markdown->h3('Build frontend assets') }}

{{ $markdown->codeBlock('./vendor/bin/sail npm watch', 'shell') }}

{{ $markdown->h3('Running Tests') }}

{{ $markdown->codeBlock('./vendor/bin/sail test', 'shell') }}
