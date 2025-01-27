<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\Markdown;
use PHPUnit\Framework\TestCase;

class MarkdownTest extends TestCase
{
    public function test_can_render_a_markdown()
    {
        $rendered = (new Markdown)->render();

        $blocks = [
            'type' => 'mrkdwn',
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $rendered, ['type']);
    }
}
