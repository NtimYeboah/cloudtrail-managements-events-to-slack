<?php declare(strict_types=1);

namespace App\Composite\Blocks;

use App\Composite\Block;

class Markdown extends Block
{
    protected string $type = 'mrkdwn';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
