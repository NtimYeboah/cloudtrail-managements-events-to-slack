<?php declare(strict_types=1);

namespace App\Composite\Blocks;

use App\Composite\Block;

class Image extends Block
{
    protected string $type = 'image';

    public function render(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}

