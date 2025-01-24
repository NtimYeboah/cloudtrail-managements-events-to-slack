<?php declare(strict_types=1);

namespace App\Blocks;

class BlocksBuilder
{
    /** @var array */
    private array $blocks;

    /**
     * Slack block section.
     *
     * @param array|null $fieldsText
     * @param string|null $text
     * @return static
     */
    public function section(?array $fieldsText = [], ?string $text = ''): static
    {
        $sectionBlock = [
            "type" => "section",
        ];

        if ($text) {
            $sectionBlock['text'] = [
                "type" => "plain_text",
                "text" => $text
            ];
        }

        if (!empty($fieldsText)) {
            foreach ($fieldsText as $text) {
                $sectionBlock['fields'][] = [
                    "type" => "mrkdwn",
                    "text" => $text,
                ];
            }
        }

        $this->blocks[] = $sectionBlock;

        return $this;
    }

    /**
     * Slack block header.
     *
     * @param string $text
     * @return static
     */
    public function header(string $text): static
    {
        $headerBlock = [
            "type" => "header",
            "text" => [
                "type" => "plain_text",
                "text" => $text
            ]
        ];

        $this->blocks[] = $headerBlock;

        return $this;
    }

    /**
     * Slack block context.
     *
     * @param string $text
     * @return static
     */
    public function context(string $text): static
    {
        $contextBlock = [
            "type" => "context",
            "elements" => [
                [
                    "type" => "plain_text",
                    "text" => $text
                ]
            ]
        ];

        $this->blocks[] = $contextBlock;

        return $this;
    }

    /**
     * Slack block divider.
     *
     * @return static
     */
    public function divider(): static
    {
        $dividerBlock = [
            "type" => "divider"
        ];

        $this->blocks[] = $dividerBlock;

        return $this;
    }

    /**
     * Build block.
     *
     * @return Blocks
     */
    public function build()
    {
        return new Blocks($this->blocks);
    }
}
