<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use Bref\Context\Context;
use Bref\Event\EventBridge\EventBridgeEvent;
use Bref\Event\EventBridge\EventBridgeHandler;

class EventHandler extends EventBridgeHandler
{
    public function handleEventBridge(EventBridgeEvent $event, Context $context): void
    {
        $message = $event->getDetail();

        $eventDetails = [
            'EventTime' => $message['eventTime'],
            'UserName' => $message['userIdentity']['userName'],
            'EventName' => $message['eventName'],
            'EventSource' => $message['eventSource'],
            'AWSAccount' => $message['recipientAccountId'],
            'SourceIpAddress' => $message['sourceIPAddress'],
            'AWSRegion' => $message['awsRegion'],
        ];

        $blocks = [
            [
                "type" => "header",
                "text" => [
                    "type" => "plain_text",
                    "text" => "New event happened in this AWS Account:" . $eventDetails['AWSAccount']
                ]
            ],
            [
                "type" => "context",
                "elements" => [
                    [
                        "type" => "plain_text",
                        "text" => "Customer #1234"
                    ]
                ]
            ],
            [
                "type" => "section",
                "text" => [
                    "type" => "plain_text",
                    "text" => "An invoice has been paid."
                ],
                "fields" => [
                    [
                        "type" => "mrkdwn",
                        "text" => "*Event Time:*\n". $eventDetails['EventTime']
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*Event Name:*\n".$eventDetails['EventName']
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*Event Source:*\n".$eventDetails['EventSource']
                    ]
                ]
            ],
            [
                "type" => "section",
                "fields" => [
                    [
                        "type" => "mrkdwn",
                        "text" => "*User name:*\n".$eventDetails['UserName']
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*AWS Account:*\n".$eventDetails['AWSAccount']
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*Source IP Address:*\n".$eventDetails['SourceIpAddress']
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*AWS Region:*\n".$eventDetails['AWSRegion']
                    ]
                ]
            ],
            [
                "type" => "divider"
            ],
            [
                "type" => "section",
                "text" => [
                    "type" => "plain_text",
                    "text" => "Congratulations!"
                ]
            ]
        ];

        $payload = [
            'channel' => getenv('SLACK_CHANNEL'),
            'blocks' => json_encode($blocks),
        ];

        $client = new Client();
        $response = $client->post('https://slack.com/api/chat.postMessage',[
            'json' => $payload,
            'headers' => [
                'Authorization' => 'Bearer '.getenv('SLACK_BOT_USER_TOKEN'),
                'Content-type' => 'application/json'
            ]
        ]);

        $responseBody = $response->getBody();
        $responseContents = json_decode($responseBody->getContents());

        // If response is 200 but ok:false, throw an exception
        if ($response->getStatusCode() === 200 && $responseContents->ok === false) {
            throw new RuntimeException('Slack API call failed with error ['.$responseContents->error.'].');
        }
    }
}

return new EventHandler();
