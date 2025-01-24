<?php

namespace Tests;

use App\BlockFormatter;
use App\Payload\Payload;
use PHPUnit\Framework\TestCase;

class BlocksTest extends TestCase
{
    public function test_can_blocks()
    {
        $eventDetails = [
            "eventVersion" => "1.10", 
            "userIdentity" => [
                "type" => "IAMUser", 
                "principalId" => "AIDAZPPF76S62AY7LB2ZF", 
                "arn" => "arn:aws:iam::651706758333:user/iamadmin-gen", 
                "accountId" => "651706758333", 
                "accessKeyId" => "ASIAZPPF76S6SFEQ5MF3", 
                "userName" => "iamadmin-gen", 
                "sessionContext" => [
                    "attributes" => [
                        "creationDate" => "2025-01-24T08:25:27Z", 
                        "mfaAuthenticated" => true 
                    ] 
                ]
            ], 
            "eventTime" => "2025-01-24T16:42:39Z", 
            "eventSource" => "ec2.amazonaws.com", 
            "eventName" => "StopInstances", 
            "awsRegion" => "us-east-1", 
            "sourceIPAddress" => "154.161.142.13", 
            "userAgent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Safari/605.1.15", 
            "requestParameters" => [
                "instancesSet" => [
                    "items" => [
                        [
                            "instanceId" => "i-09e787c682ae91a7b" 
                        ] 
                    ] 
                ], 
                "force" => false 
            ], 
            "responseElements" => [
                "requestId" => "474dd808-0094-4f0d-95d0-1450520a94b6", 
                "instancesSet" => [
                    "items" => [
                        [
                            "instanceId" => "i-09e787c682ae91a7b", 
                            "currentState" => [
                                "code" => 64, 
                                "name" => "stopping" 
                            ], 
                            "previousState" => [
                                "code" => 16, 
                                "name" => "running" 
                            ] 
                        ] 
                    ] 
                ] 
            ], 
            "requestID" => "474dd808-0094-4f0d-95d0-1450520a94b6", 
            "eventID" => "17adc79b-76a5-457f-b3fc-be81f08bb26a", 
            "readOnly" => false, 
            "eventType" => "AwsApiCall", 
            "managementEvent" => true, 
            "recipientAccountId" => "651706758333", 
            "eventCategory" => "Management", 
            "tlsDetails" => [
                "tlsVersion" => "TLSv1.3", 
                "cipherSuite" => "TLS_AES_128_GCM_SHA256", 
                "clientProvidedHostHeader" => "ec2.us-east-1.amazonaws.com" 
            ], 
            "sessionCredentialFromConsole" => true
        ]; 

        $payload = Payload::capture($eventDetails);

        $blocks = BlockFormatter::format($payload);

        $this->assertCount(6, $blocks->get());
    }
}
