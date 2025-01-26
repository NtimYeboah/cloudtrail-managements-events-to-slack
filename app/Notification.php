<?php declare(strict_types=1);

namespace App;

use App\Payload\Payload;

class Notification extends BaseNotification
{
    public function __construct(Payload $payload)
    {
        parent::__construct($payload);
    }
}
