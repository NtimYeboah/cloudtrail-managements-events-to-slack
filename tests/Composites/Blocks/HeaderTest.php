<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\Header;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase
{
    public function test_can_render_a_header()
    {
        $rendered = (new Header)->render();

        $blocks = [
            'type' => 'header',
            'text' => [],
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $rendered, ['type', 'text']);
    }
}
