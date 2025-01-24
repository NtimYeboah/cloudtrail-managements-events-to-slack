<?php declare(strict_types=1);

namespace App\Event\DataTransferObjects;

use DateTimeImmutable;

final class Session
{
    public function __construct(
        public DateTimeImmutable $creationDate,
        public bool $mfaAuthenticated,
        public string $sourceIpAddress,
        public string $userAgent,
        public string $sessionCredentialsFromConsole,
    ) {}

    public static function fromArray(array $details): self
    {
        return static(
            $details['userIdentity']['sessionContext']['attributes']['creationDate'],
            $details['userIdentity']['sessionContext']['attributes']['mfaAuthenticated'],
            $details['sourceIPAddress'],
            $details['userAgent'],
            $details['sessionCredentialFromConsole'],
        );
    }

    
}
