#!/usr/bin/env bash
@php
    /** @var \Domains\PostDownload\PostDownloadTaskGroup[] $groups */
    /** @var \Domains\PostDownload\PostInitializationLink[] $links */
    /** @var string $githubIssueLink */
    /** @var \Domains\PostDownload\PostDownloadTaskRenderer $taskRenderer */
    /** @var string $initializationScript */
@endphp
set -e;

{{-- Exit the script, when docker is not running. --}}
<x-initialize::ensure-docker-is-running />

{{--
    Prompt nice error information, when an error happens.
    This needs to be rendered _after_ ensuring docker is running, as otherwise
    we prompt users to open a GitHub issue if docker is not running.
--}}
<x-initialize::error-handler :githubIssueLink="$githubIssueLink" />

<x-initialize::welcome-banner />
<x-shell::confirm-execution />

{{--
    This is the part where we actually execute all the steps like setting up
    sail, installing Composer/NPM dependencies and executing all the
    `php artisan foo:install` commands.

    These need to be dynamically computed, since they depend on values from the
    form. If you want to know how these get computed, have a look at the
    PostDownloadTaskGroupCreator from the PostDownload domain.
--}}
@foreach($groups as $group)
echo '';
<x-initialize::task-group :renderer="$taskRenderer" :group="$group" />
@endforeach

<x-initialize::cleanup :initializationScript="$initializationScript" />

<x-initialize::done-banner :links="$links" />