#!/usr/bin/env bash
@php
    /** @var \Domains\PostDownload\PostDownloadTaskGroup[] $groups */
    /** @var \Domains\PostDownload\PostInitializationLink[] $links */
    /** @var string $githubIssueLink */
    /** @var \Domains\PostDownload\PostDownloadTaskRenderer $taskRenderer */
    /** @var string $initializationScript */
@endphp
set -e;

function onError()
{
    echo '';
    echo -e '💥 <x-shell::bold>It looks like something went wrong</x-shell::bold> 💥';
    echo '';
    echo 'Feel free to open an issue on GitHub by clicking on the link below.';
    echo 'Make sure to include helpful information such as:';
    echo '- the error output above';
    echo '- the configuration chosen before downloading the archive';
    echo '- your local environment (operating system, etc.)';
    echo '- other information that seems relevant to you';
    echo '';
    echo -e '<x-shell::bold>{{ $githubIssueLink }}</x-shell::bold>';
    echo '';
}
trap onError EXIT;

if ! docker info > /dev/null 2>&1; then
    echo -e "Docker is not running." >&2;
    exit 1;
fi

echo '';
<x-shell::banner title="Initializer for Laravel">
<x-shell::banner-line />
<x-shell::banner-line>This script will complete the rest of the setup needed to install the</x-shell::banner-line>
<x-shell::banner-line>chosen components into your fresh application. This might require</x-shell::banner-line>
<x-shell::banner-line>downloading Docker containers or requiring packages via composer</x-shell::banner-line>
<x-shell::banner-line>multiple times, so it can take a while to complete.</x-shell::banner-line>
</x-shell::banner>

if [ -t 1 ];
then
    echo '';
    read -n 1 -s -r -p "Press any key to continue";
    echo '';
else
    echo '';
fi

@foreach($groups as $group)
echo '';
<x-shell::banner :title="$group->title()" />
echo '';
@foreach($group->tasks() as $task)
{!! $taskRenderer->announce($task) !!}
{!! $taskRenderer->execute($task) !!}
@endforeach

@endforeach
echo "Finished setup, removing {{ $initializationScript }} and TODOs in README.md!";
rm "./{{ $initializationScript }}";

# Remove TODO in readme
perl -0777 -pi -e 's/<!-- Initializer for Laravel Todos START  -->.*<!-- Initializer for Laravel Todos END  -->//gs' README.md

echo '';
<x-shell::banner title="Done!">
<x-shell::banner-line />
<x-shell::banner-line>You can now have a look at README.md, for further instructions, guides</x-shell::banner-line>
<x-shell::banner-line>and links to the installed components.</x-shell::banner-line>
<x-shell::banner-line />
<x-shell::banner-line>Some helpful links:</x-shell::banner-line>
@foreach($links as $link)
<x-shell::banner-line>- {{$link->title}} {{ $link->href }}</x-shell::banner-line>
@endforeach
</x-shell::banner>
echo '';