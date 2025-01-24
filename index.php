<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\BlockFormatter;
use App\Payload\Payload;
use App\SlackNotification;
use Bref\Context\Context;
use Bref\Event\EventBridge\EventBridgeEvent;
use Bref\Event\EventBridge\EventBridgeHandler;

class EventHandler extends EventBridgeHandler
{
    public function handleEventBridge(EventBridgeEvent $event, Context $context): void
    {
        $payload = Payload::capture($event->getDetail());

        $blocks = BlockFormatter::format($payload);

        $response = SlackNotification::send([
            'channel' => getenv('SLACK_CHANNEL'),
            'blocks' => $blocks,
        ]);

        $responseBody = $response->getBody();
        $responseContents = json_decode($responseBody->getContents());

        if ($response->getStatusCode() === 200 && $responseContents->ok === false) {
            throw new RuntimeException('Slack API call failed with error ['.$responseContents->error.'].');
        }
    }
}

return new EventHandler();
