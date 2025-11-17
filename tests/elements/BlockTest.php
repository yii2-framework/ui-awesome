<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\element\Block;
use yii\ui\exception\Message;
use yii\ui\tag\BlockTag;
use yii\ui\tests\providers\elements\BlockProvider;
use yii\ui\tests\support\TestSupport;

/**
 * Test suite for {@see Block} element functionality and behavior.
 *
 * Validates the rendering and management of block-level HTML tags according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of block element operations, supporting accurate opening and
 * closing tag generation, as well as exception handling for invalid or empty tag names.
 *
 * Test coverage:
 * - Accurate rendering of opening and closing block-level tags.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for empty or invalid tag names and inline tag misuse.
 * - Immutability of the API when invoking block operations.
 *
 * {@see BlockProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('elements')]
final class BlockTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(BlockProvider::class, 'blockTags')]
    public function testRendersBeginWithOpeningBlockTag(string|BlockTag $tag): void
    {
        if ($tag instanceof BlockTag) {
            $tag = $tag->value;
        }

        self::equalsWithoutLE(
            "<{$tag}>",
            Block::begin($tag),
            "Rendered opening '<{$tag}>' block tag should match expected output.",
        );
    }

    #[DataProviderExternal(BlockProvider::class, 'blockTags')]
    public function testRendersEndWithClosingBlockTag(string|BlockTag $tag): void
    {
        if ($tag instanceof BlockTag) {
            $tag = $tag->value;
        }

        self::equalsWithoutLE(
            "</{$tag}>",
            Block::end($tag),
            "Rendered closing '</{$tag}>' block tag should match expected output.",
        );
    }

    /**
     * @phpstan-param 'begin'|'end' $operation Block helper operation to invoke.
     */
    #[DataProviderExternal(BlockProvider::class, 'emptyTagOperations')]
    public function testThrowInvalidArgumentExceptionWithEmptyTagName(string $operation): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        match ($operation) {
            'begin' => Block::begin(''),
            default => Block::end(''),
        };
    }

    /**
     * @phpstan-param 'begin'|'end' $operation Block helper operation to invoke.
     */
    #[DataProviderExternal(BlockProvider::class, 'inlineTagOperations')]
    public function testThrowInvalidArgumentExceptionWithInlineTag(string $tag, string $operation): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_BLOCK_ELEMENT->getMessage($tag));

        match ($operation) {
            'begin' => Block::begin($tag),
            default => Block::end($tag),
        };
    }
}
