<?php declare(strict_types=1);

namespace NtimYeboah\Cloudtrail\Payload;

use NtimYeboah\Cloudtrail\Payload\DataTransferObjects\Console;
use NtimYeboah\Cloudtrail\Payload\DataTransferObjects\User;
use NtimYeboah\Cloudtrail\Payload\DataTransferObjects\Event;
use NtimYeboah\Cloudtrail\Payload\DataTransferObjects\Session;
use NtimYeboah\Cloudtrail\Payload\DataTransferObjects\Tls;

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
