<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\RichText;
use PHPUnit\Framework\TestCase;

class RichTextTest extends TestCase
{
    public function test_can_render_a_rich_text()
    {
        $rendered = (new RichText)->render();

        $blocks = [
            'type' => 'rich_text',
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
