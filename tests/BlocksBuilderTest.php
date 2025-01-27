<?php

namespace Tests;

use App\Blocks\Blocks;
use App\Blocks\BlocksBuilder;
use App\Composite\Blocks\Context;
use App\Composite\Blocks\Header;
use App\Composite\Blocks\PlainText;
use App\Composite\Blocks\Section;
use PHPUnit\Framework\TestCase;

class BlocksBuilderTest extends TestCase
{
    public function test_can_build_a_section()
    {
        $sectionBlocks = (new BlocksBuilder)
            ->section(function (Section $section) {
                return $section->addField(new PlainText([
                    'text' => 'This is a section with a plain text'
                ]));
            })
            ->build();

        $this->assertInstanceOf(Blocks::class, $sectionBlocks);
        
        $blocks = [
            [
                'type' => 'section',
                'text' => [
                    [
                        'type' => 'plain_text',
                    ]
                ]
            ]
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $sectionBlocks->toArray(), ['type', 'text']);
    }

    public function test_can_build_divider()
    {
        $dividerBlocks = (new BlocksBuilder)
            ->divider()
            ->build();

        $this->assertInstanceOf(Blocks::class, $dividerBlocks);

        $blocks = [
            [
                'type' => 'divider',
            ]
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $dividerBlocks->toArray(), ['type']);
    }

    public function test_can_build_a_context()
    {
        $contextBlocks = (new BlocksBuilder)
            ->context(function (Context $section) {
                return $section->addField(new PlainText([
                    'text' => 'This is a context with a plain text'
                ]));
            })
            ->build();

        $this->assertInstanceOf(Blocks::class, $contextBlocks);
        
        $blocks = [
            [
                'type' => 'context',
                'elements' => [
                    [
                        'type' => 'plain_text',
                    ]
                ]
            ]
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $contextBlocks->toArray(), ['type', 'elements']);
    }

    public function test_can_build_a_header()
    {
        $headerBlocks = (new BlocksBuilder)
            ->header(function (Header $section) {
                return $section->addField(new PlainText([
                    'text' => 'This is a header with a plain text'
                ]));
            })
            ->build();

        $this->assertInstanceOf(Blocks::class, $headerBlocks);

        $blocks = [
            [
                'type' => 'header',
                'text' => [
                    [
                        'type' => 'plain_text',
                    ]
                ]
            ]
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $headerBlocks->toArray(), ['type', 'text']);
    }
}
