<?php declare(strict_types=1);

namespace App\Composite;

abstract class Block
{
    private array $block;

    protected abstract function block(): array;

    public abstract function render(): array;
}
