<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Blocks\Text;
use App\Composite\CompoundBlock;

class Context extends CompoundBlock
{
    private array $elements = [];

    private array $block = [
        'type' => 'context',
    ];

    protected function block(): array
    {
        return $this->block;
    }

    public function render(): array
    {
        if (count($this->elements) > 0) {
            $this->block['elements'] = $this->elements();
        }

        return $this->block();
    }

    public function text(string $text): self
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->elements[] = $text;

        return $this;
    }

    public function markdown()
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->markdown();
       
        return $this;
    }

    protected function elements(): array
    {
        $blocks = [];

        foreach ($this->elements as $element) {
            $blocks[] = $element->render();
        }

        return $blocks;
    }
}
