<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\CompoundBlock;

class Image extends CompoundBlock
{
    protected string $type = 'image';

    public function render(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
