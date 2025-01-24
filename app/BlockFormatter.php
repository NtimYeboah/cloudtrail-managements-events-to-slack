<?php declare(strict_types=1);

namespace App;

use App\Blocks\BlocksBuilder;
use App\Payload\Payload;

class BlockFormatter
{
    private function __construct(private Payload $payload)
    {}

    public static function format(Payload $payload): string
    {
        $self = new static($payload);

        return $self->getBlock();
    }

    public function header()
    {
        return "New event happened in your AWS Account: {$this->payload->user()->awsAccountId()}";
    }

    public function context()
    {
        return "IAM user performed action: {$this->payload->user()->name()}";
    }

    public function field($text)
    {
        return $text;
    }

    /**
     * Get stringified block message.
     *
     * @return string|false
     */
    private function getBlock()
    {
        $builder = new BlocksBuilder();
        $blocks = $builder->header($this->header())
                    ->context($this->context())
                    ->section([
                        $this->field("*Event Time:*\n".$this->payload->event()->time()),
                        $this->field("*Event Name:*\n".$this->payload->event()->name()),
                        $this->field("*Event Source:*\n".$this->payload->event()->source())
                    ])
                    ->section([
                        $this->field("*IAM user:*\n".$this->payload->event()->time()),
                        $this->field("*AWS Account:*\n".$this->payload->event()->name()),
                        $this->field("*AWS Region:*\n".$this->payload->event()->source()),
                        $this->field("*Source IP Address:*\n".$this->payload->event()->source())
                    ])
                    ->divider()
                    ->section([], 'Congratulations')
                    ->build();

        return $blocks->toString();
    }
}
