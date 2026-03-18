<?php

namespace Jolsen\MicrosoftTeamsWorkflowsLogging;

use Monolog\Logger;
use Psr\Log\LoggerInterface;

class TeamsLogChannel
{
    public function __invoke(array $config): LoggerInterface
    {
        return new TeamsWorkflowLogger($config['url'], $config['level'] ?? LOGGER::DEBUG);
    }
}
