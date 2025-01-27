<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\CompoundBlock;

class Section extends CompoundBlock
{
    protected string $type = 'section';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
