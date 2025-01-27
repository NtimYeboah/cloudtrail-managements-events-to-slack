<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function test_can_render_an_image()
    {
        $rendered = (new Image)->render();

        $blocks = [
            'type' => 'image',
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
