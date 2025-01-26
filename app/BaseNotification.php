<?php declare(strict_types=1);

namespace App;

use App\Blocks\BlocksBuilder;
use App\Composite\Blocks\Context;
use App\Composite\Blocks\Header;
use App\Composite\Blocks\Markdown;
use App\Composite\Blocks\PlainText;
use App\Composite\Blocks\Section;
use App\Payload\Payload;

class BaseNotification
{
    public function __construct(
        public Payload $payload
    ) {}

    public function toBlocks()
    {
        return (new BlocksBuilder)
        ->header(function (Header $header) {
            return $header->addField(new PlainText([
                'text' => "New event happened in your AWS Account: {$this->payload->user()->awsAccountId()}"
            ]));
        })
        ->context(function (Context $context) {
            return $context->addField(new PlainText([
                'text' => "Action performed by: {$this->payload->user()->name()}"
            ]));
        })
        ->section(function (Section $section) {
            return $section->addField(new Markdown())
                ->addField(new Markdown([
                    'text' => "*Event Time:*\n".$this->payload->event()->time()->format('l, F j, Y'),
                ]))
                ->addField(new Markdown([
                    'text' => "*Event Name:*\n".$this->payload->event()->name(),
                ]))
                ->addField(new Markdown([
                    'text' => "*Event Source:*\n".$this->payload->event()->source(),
                ]));
        })
        ->section(function (Section $section) {
            return $section->addField(new Markdown())
                ->addField(new Markdown([
                    'text' => "*IAM user:*\n".$this->payload->user()->name(),
                ]))
                ->addField(new Markdown([
                    'text' => "*AWS Region:*\n".$this->payload->console()->region(),
                ]))
                ->addField(new Markdown([
                    'text' => "*AWS Region:*\n".$this->payload->console()->region(),
                ]))
                ->addField(new Markdown([
                    'text' => "*Source IP Address:*\n".$this->payload->session()->sourceIpAddress(),
                ]));
        })
        ->divider()
        ->section(function (Section $section) {
            return $section->addField(new PlainText([
                'text' => "Made with Love Ntim."
            ]));
        })
        ->divider()
        ->build();
    }
}
