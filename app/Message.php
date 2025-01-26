<?php declare(strict_types=1);

namespace App;

use App\Payload\Payload;

class Message
{
    protected function __construct(
        public Payload $payload
    ) {}

    public static function format(Payload $payload)
    {
        $static = new static($payload);

        return (new Notification($static->payload))->toBlocks();
    }
}