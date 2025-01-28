<?php declare(strict_types=1);

namespace App\Composite\Blocks;

use App\Composite\Block;

class Placeholder extends Block
{
    protected string $type = 'plain_text';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
