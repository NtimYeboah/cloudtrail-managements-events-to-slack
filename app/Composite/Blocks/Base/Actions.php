<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\CompoundBlock;

class Actions extends CompoundBlock
{
    protected string $type = 'actions';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
