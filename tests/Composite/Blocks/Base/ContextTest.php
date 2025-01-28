<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\Context;
use PHPUnit\Framework\TestCase;

class ContextTest extends TestCase
{
    public function test_can_render_a_context()
    {
        $rendered = (new Context)->render();

        $blocks = [
            'type' => 'context',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_context_text()
    {
        $rendered = (new Context)
            ->text('This is a context text')
            ->render();

        $blocks = [
            'type' => 'context',
            'elements' => [
                [
                    'type' => 'plain_text',
                    'text' => 'This is a context text',
                ],
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_context_markdown()
    {
        $rendered = (new Context)
            ->text('This is a markdown text')
            ->markdown()
            ->render();

        $blocks = [
            'type' => 'context',
            'elements' => [
                [
                    'type' => 'mrkdwn',
                    'text' => 'This is a markdown text',
                ],
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
