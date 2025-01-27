<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Block;

class Input extends Block
{
    protected string $type = 'input';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
