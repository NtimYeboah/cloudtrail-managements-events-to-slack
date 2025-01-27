<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Block;

class RichText extends Block
{
    protected string $type = 'rich_text';

    public function render(): array
    {
        return [
            'type' => $this->type(),
        ];
    }
}
