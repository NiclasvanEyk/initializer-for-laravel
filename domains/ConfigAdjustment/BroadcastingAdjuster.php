<?php

namespace Domains\ConfigAdjustment;

use Domains\ConfigAdjustment\Concerns\MakesArchiveAdjustments;
use Domains\CreateProjectForm\Sections\Broadcasting;
use PhpZip\ZipFile;

class BroadcastingAdjuster
{
    use MakesArchiveAdjustments;

    public function adjustDefaults(
        ZipFile $archive,
        Broadcasting $broadcasting,
    ): void {
        $defaultBroadcastEntry = 'BROADCAST_DRIVER=log';

        switch ($broadcasting->channel) {
            case Broadcasting\BroadcastingChannelOption::NONE:
            default:
                break;

            case Broadcasting\BroadcastingChannelOption::LARAVEL_WEBSOCKETS:
            case Broadcasting\BroadcastingChannelOption::SOKETI:
            // See https://beyondco.de/docs/laravel-websockets/basic-usage/pusher#pusher-configuration
            // See https://docs.soketi.app/getting-started/backend-configuration/laravel-broadcasting
                $this->replaceEnvExample($archive, [
                    "                'cluster' => env('PUSHER_APP_CLUSTER')," => "                'cluster' => env('PUSHER_APP_CLUSTER'),"."\n".
                    "                'port' => 6001,"."\n",
                    $defaultBroadcastEntry => 'BROADCAST_DRIVER=pusher',
                ]);
                break;

            case Broadcasting\BroadcastingChannelOption::PUSHER:
                $this->replaceEnvExample($archive, [
                    $defaultBroadcastEntry => 'BROADCAST_DRIVER=pusher',
                ]);
                break;

            case Broadcasting\BroadcastingChannelOption::ABLY:
                $this->replaceEnvExample($archive, [
                    'PUSHER_APP_ID=' => 'ABLY_KEY=\n\nPUSHER_APP_ID=',
                    $defaultBroadcastEntry => 'BROADCAST_DRIVER=ably',
                ]);
                break;
        }
    }
}
