<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\Context;
use PHPUnit\Framework\TestCase;

class ContextTest extends TestCase
{
    public function test_can_render_a_context()
    {
        $rendered = (new Context)->render();

        $blocks = [
            'type' => 'context',
            'elements' => [],
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $rendered, ['type', 'elements']);
    }
}
