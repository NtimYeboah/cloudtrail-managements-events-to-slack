<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Block;

class Divider extends Block
{
    protected string $type = 'divider';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
