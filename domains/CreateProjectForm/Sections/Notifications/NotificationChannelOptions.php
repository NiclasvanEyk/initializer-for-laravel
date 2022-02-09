<?php

namespace Domains\CreateProjectForm\Sections\Notifications;

enum NotificationChannelOptions: string
{
    case VONAGE = 'vonage';
    case SLACK = 'slack';
}
