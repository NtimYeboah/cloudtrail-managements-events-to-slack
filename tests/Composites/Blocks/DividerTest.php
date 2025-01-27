<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\Divider;
use PHPUnit\Framework\TestCase;

class DividerTest extends TestCase
{
    public function test_can_render_a_divider()
    {
        $rendered = (new Divider)->render();

        $blocks = [
            'type' => 'divider',
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $rendered, ['type']);
    }
}
