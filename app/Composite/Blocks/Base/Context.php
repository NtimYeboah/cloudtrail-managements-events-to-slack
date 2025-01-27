<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\CompoundBlock;

class Context extends CompoundBlock
{
    protected string $type = 'context';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
