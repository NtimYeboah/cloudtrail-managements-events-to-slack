<?php declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class SlackNotification
{
    public function __construct(
        private array $payload
    ) {}

    /**
     * Send request to Slack.
     *
     * @param array $payload
     * @return ResponseInterface
     */
    public static function send(array $payload): ResponseInterface
    {
        $self = new static($payload);

        return $self->request();
    }

    /**
     * Make request to Slack.
     *
     * @return ResponseInterface
     */
    private function request(): ResponseInterface
    {
        $client = new Client();

        return $client->post('https://slack.com/api/chat.postMessage',[
            'json' => $this->payload,
            'headers' => [
                'Authorization' => 'Bearer '.getenv('SLACK_BOT_USER_TOKEN'),
                'Content-type' => 'application/json'
            ]
        ]);
    }
}
