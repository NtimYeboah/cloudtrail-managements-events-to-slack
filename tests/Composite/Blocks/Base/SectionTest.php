<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\Section;
use PHPUnit\Framework\TestCase;

class SectionTest extends TestCase
{
    public function test_can_render_a_section()
    {
        $rendered = (new Section)->render();

        $blocks = [
            'type' => 'section',
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
