<?php declare(strict_types=1);

namespace App\Blocks;

use App\Composite\Blocks\Context;
use App\Composite\Blocks\Divider;
use App\Composite\Blocks\Header;
use App\Composite\Blocks\Section;
use Closure;

class BlocksBuilder
{
    protected array $blocks = [];

    public function section(Closure $callable)
    {
        $section = $callable(new Section);

        $this->blocks[] = $section->render();

        return $this;
    }

    /* public function action(Closure $closure)
    {

    } */

    public function divider()
    {
        $this->blocks[] = (new Divider)->render();

        return $this;
    }

    /* public function image(Closure $closure)
    {

    } */

    public function context(Closure $callable)
    {
        $context = $callable(new Context);

        $this->blocks[] = $context->render();

        return $this;
    }

    public function input(Closure $closure)
    {

    }

    public function header(Closure $callable)
    {
        $header = $callable(new Header);

        $this->blocks[] = $header->render();

        return $this;
    }

    public function richText(Closure $closure)
    {

    }

    public function build()
    {
        return new Blocks($this->blocks);
    }
}
