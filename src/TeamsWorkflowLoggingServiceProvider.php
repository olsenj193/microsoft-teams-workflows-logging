<?php

namespace Jolsen\MicrosoftTeamsWorkflowsLogging;

use Illuminate\Support\ServiceProvider;

class TeamsWorkflowLoggingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register()
    {
        $this->app->singlton(TeamsLogChannel::class, function($app) {
            return new TeamsLogChannel();
        });
    }
}
