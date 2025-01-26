<?php declare(strict_types=1);

namespace App\Composite;

abstract class Block
{
    protected string $type;

    public abstract function render(): array;

    public function type(): string
    {
        return $this->type;
    }
}
