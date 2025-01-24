<?php declare(strict_types=1);

namespace App;

use App\Blocks\Blocks;
use App\Blocks\BlocksBuilder;
use App\Payload\Payload;
use PhpParser\Node\Stmt\Block;

class BlockFormatter
{
    private function __construct(private Payload $payload)
    {}

    public static function format(Payload $payload): Blocks
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
     * @return Blocks
     */
    private function getBlock()
    {
        $builder = new BlocksBuilder();
        return $builder->header($this->header())
                    ->context($this->context())
                    ->section([
                        $this->field("*Event Time:*\n".$this->payload->event()->time()->format('l, F j, Y')),
                        $this->field("*Event Name:*\n".$this->payload->event()->name()),
                        $this->field("*Event Source:*\n".$this->payload->event()->source())
                    ])
                    ->section([
                        $this->field("*IAM user:*\n".$this->payload->user()->name()),
                        $this->field("*AWS Account:*\n".$this->payload->console()->recipientAccountId()),
                        $this->field("*AWS Region:*\n".$this->payload->console()->region()),
                        $this->field("*Source IP Address:*\n".$this->payload->session()->sourceIpAddress())
                    ])
                    ->divider()
                    ->section([], 'Congratulations')
                    ->build();
    }
}
