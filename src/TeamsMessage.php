<?php

namespace App\Logging\WorkflowsMicrosoftTeams;

use JsonSerializable;

class TeamsMessage implements JsonSerializable
{
    /**
     * @var array
     */
    protected array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'message',
            'attachments' => [
                [
                    'contentType' => 'application/vnd.microsoft.card.adaptive',
                    'contentUrl' => null,
                    'content' => [
                        '$schema' => 'http://adaptivecards.io/schemas/adaptive-card.json',
                        'type' => 'AdaptiveCard',
                        'version' => '1.2',
                        'body' => [
                            [
                                'type' => 'TextBlock',
                                'text' => $this->data['text'],
                            ],
                        ]
                    ]
                ]
            ]
        ];
    }
}
