<?php

namespace Jolsen\MicrosoftTeamsWorkflowsLogging;

use Monolog\Logger;

class TeamsWorkflowLogger extends Logger
{
    public function __construct(string $url, $level)
    {
        parent::__construct('teams');

        $this->pushHandler(new TeamsWorkflowLogHandler($url, $level));
    }
}
