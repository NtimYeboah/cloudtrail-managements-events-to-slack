<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\PlainText;
use PHPUnit\Framework\TestCase;

class PlainTextTest extends TestCase
{
    public function test_can_render_a_plain_text()
    {
        $rendered = (new PlainText)->render();

        $blocks = [
            'type' => 'plain_text',
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $rendered, ['type']);
    }
}
