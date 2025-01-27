<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\CompoundBlock;

class Header extends CompoundBlock
{
    protected string $type = 'header';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
