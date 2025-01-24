<?php declare(strict_types=1);

namespace App\Payload\DataTransferObjects;

use DateTimeImmutable;

final class Session
{
    public function __construct(
        public string $creationDate,
        public bool $mfaAuthenticated,
        public string $sourceIpAddress,
        public string $userAgent,
        public bool $sessionCredentialsFromConsole,
    ) {}

    public static function fromArray(array $details): self
    {
        return new static(
            $details['creationDate'],
            $details['mfaAuthenticated'],
            $details['sourceIpAddress'],
            $details['userAgent'],
            $details['sessionCredentialFromConsole'],
        );
    }

    /**
     * Get the time the event was triggered.
     *
     * @return DateTimeImmutable
     */
    public function creationDate(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat('U', (string) strtotime($this->creationDate));
    }

    /**
     * Determine whether login session was authenticated with MFA.
     *
     * @return boolean
     */
    public function mfaAuthenticated(): bool
    {
        return $this->mfaAuthenticated;
    }

    /**
     * The IP of the session client.
     *
     * @return string
     */
    public function sourceIpAddress(): string
    {
        return $this->sourceIpAddress;
    }

    /**
     * The user agent of the client.
     *
     * @return string
     */
    public function userAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Determine whether session credentials are from console.
     *
     * @return bool
     */
    public function sessionCredentialsFromConsole(): bool
    {
        return $this->sessionCredentialsFromConsole;
    }
}
