<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Block;

class Actions extends Block
{
    protected string $type = 'actions';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
