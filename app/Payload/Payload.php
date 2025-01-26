<?php declare(strict_types=1);

namespace App\Payload;

use App\Payload\DataTransferObjects\Console;
use App\Payload\DataTransferObjects\User;
use App\Payload\DataTransferObjects\Event;
use App\Payload\DataTransferObjects\Session;
use App\Payload\DataTransferObjects\Tls;

abstract class Payload
{
    /**
     * Get user representation in event.
     *
     * @return User
     */
    public abstract function user(): User;

    /**
     * Get console representation in event.
     *
     * @return Console
     */
    public abstract function console(): Console;

    /**
     * Get TLS representation in event.
     *
     * @return Tls
     */
    public abstract function tls(): Tls;

    /**
     * Get session representation in event.
     *
     * @return Session
     */
    public abstract function session(): Session;

    /**
     * Get event represenation in event.
     *
     * @return Event
     */
    public abstract function event(): Event;
}
