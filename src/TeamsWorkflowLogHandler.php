<?php

namespace Jolsen\MicrosoftTeamsWorkflowsLogging;

use Monolog\Handler\AbstractProcessingHandler;

class TeamsWorkflowLogHandler extends AbstractProcessingHandler
{
    /**
     * @var string
     */
    public string $url;

    public function __construct(string $url, $level)
    {
        parent::__construct($level);

        $this->url = $url;
    }

    /**
     * @param array $record
     * @return TeamsMessage
     */
    protected function setMessage(array $record): TeamsMessage
    {
        $data = [
            'text' => $record['level_name'] . ' | ' . $record['message'],
        ];

        return new TeamsMessage($data);
    }

    /**
     * @param array $record
     * @return void
     */
    protected function write(array $record): void
    {
        $json = json_encode($this->setMessage($record));

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ]);

        curl_exec($ch);
    }
}
