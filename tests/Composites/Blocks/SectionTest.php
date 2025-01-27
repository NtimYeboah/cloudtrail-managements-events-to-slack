<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\Section;
use PHPUnit\Framework\TestCase;

class SectionTest extends TestCase
{
    public function test_can_render_a_section()
    {
        $rendered = (new Section)->render();

        $blocks = [
            'type' => 'section',
            'text' => [],
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $rendered, ['type']);
    }
}
