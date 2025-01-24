<?php declare(strict_types=1);

namespace App\Payload;

use App\Event\DataTransferObjects\Console;
use App\Event\DataTransferObjects\User;
use App\Event\DataTransferObjects\Event;
use App\Event\DataTransferObjects\Session;
use App\Event\DataTransferObjects\Tls;

class Payload
{
    /** var Tls */
    public Tls $tls;

    /** var User */
    public User $user;

    /** var Event */
    public Event $event;

    /** @var Session */
    public Session $session;

    /** @var Console */
    public Console $console;

    protected function __construct(array $details)
    {
        $this->initializeUser($details);
        $this->initializeEvent($details);
        $this->initializeSession($details);
        $this->initializeConsole($details);
        $this->initializeTls($details);
    }

    /**
     * Capture event from AWS.
     *
     * @param array $details
     * @return static
     */
    public static function capture(array $details): static
    {
        return new Static($details);
    }

    /**
     * Get user representation in event.
     *
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Get console representation in event.
     *
     * @return Console
     */
    public function console()
    {
        return $this->console;
    }

    /**
     * Get TLS representation in event.
     *
     * @return Tls
     */
    public function tls()
    {
        return $this->tls;
    }

    /**
     * Get session representation in event.
     *
     * @return Session
     */
    public function session()
    {
        return $this->session;
    }

    /**
     * Get event represenation in event.
     *
     * @return Event
     */
    public function event()
    {
        return $this->event;
    }

    /**
     * Initialize user from the User DTO.
     *
     * @param array $details
     * @return void
     */
    private function initializeUser(array $details)
    {
        $this->user = User::fromArray([
            'type' => $details['userIdentity']['type'],
            'principalId' => $details['userIdentity']['principalId'],
            'arn' => $details['userIdentity']['arn'],
            'awsAccountId' => $details['userIdentity']['accountId'],
            'accessKeyId' => $details['userIdentity']['accessKeyId'],
            'userName' => $details['userIdentity']['userName'],
        ]);
    }

    /**
     * Initialize event from the Event DTO.
     *
     * @param array $details
     * @return void
     */
    private function initializeEvent(array $details)
    {
        $this->event = Event::fromArray([
            'eventVersion' => $details['eventVersion'],
            'eventTime' => $details['eventTime'],
            'eventSource' => $details['eventSource'],
            'eventName' => $details['eventName'],
            'eventID' => $details['eventID'],
            'eventType' => $details['eventType'],
            'managementEvent' => $details['managementEvent'],
            'eventCategory' => $details['eventCategory'],
        ]);
    }

    /**
     * Initialize session from the Session DTO.
     *
     * @param array $details
     * @return void
     */
    private function initializeSession(array $details)
    {
        $this->session = Session::fromArray([
            'creationDate' => $details['userIdentity']['sessionContext']['attributes']['creationDate'],
            'mfaAuthenticated' => $details['userIdentity']['sessionContext']['attributes']['mfaAuthenticated'],
            'sourceIpAddress' => $details['sourceIPAddress'],
            'userAgent' => $details['userAgent'],
            'sessionCredentialFromConsole' => $details['sessionCredentialFromConsole'],
        ]);
    }

    /**
     * Initialize tls from the Tls DTO.
     *
     * @param array $details
     * @return void
     */
    private function initializeTls(array $details)
    {
        $this->tls = Tls::fromArray([
            'tlsVersion' => $details['tlsVersion'],
            'cipherSuite' => $details['cipherSuite'],
            'clientProvidedHostHeader' => $details['clientProvidedHostHeader'],
        ]);
    }

    /**
     * Initialize console from the Console DTO. 
     *
     * @param array $details
     * @return void
     */
    private function initializeConsole(array $details)
    {
        $this->console = Console::fromArray([
            'awsRegion' => $details['awsRegion'],
            'requestID' => $details['requestID'],
            'readOnly' => $details['readOnly'],
            'recipientAccountId' => $details['recipientAccountId'],
        ]);
    }
}
