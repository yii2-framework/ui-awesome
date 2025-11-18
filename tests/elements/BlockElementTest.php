<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\content\flow\BlockContent;
use yii\ui\element\BlockElement;
use yii\ui\exception\Message;
use yii\ui\tests\providers\content\BlockContentProvider;
use yii\ui\tests\support\TestSupport;

use function strtolower;

/**
 * Test suite for {@see BlockElement} helper functionality and behavior.
 *
 * Validates the manipulation and validation of global HTML block elements according to the HTML Living Standard
 * specification.
 *
 * Ensures correct handling, immutability, and validation of block element operations, supporting both `string` and
 * enum types for tag assignment and rendering.
 *
 * Test coverage:
 * - Accurate rendering of opening and closing block tags.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for invalid or empty tag names and non-block content.
 * - Immutability of the API when setting or overriding block tags.
 * - Proper assignment and overriding of block tag values.
 *
 * {@see BlockContentProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */

#[Group('elements')]
final class BlockElementTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(BlockContentProvider::class, 'blockContent')]
    public function testRenderBegin(string|BlockContent $tagName, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "<{$expectedTagName}>",
            BlockElement::begin($tagName),
            "Rendered opening '<{$expectedTagName}>' block tag should match expected output.",
        );
    }

    #[DataProviderExternal(BlockContentProvider::class, 'blockContent')]
    public function testRenderEnd(string|BlockContent $tagName, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "</{$expectedTagName}>",
            BlockElement::end($tagName),
            "Rendered closing '</{$expectedTagName}>' block tag should match expected output.",
        );
    }

    /**
     * @phpstan-param 'begin'|'end' $operation BlockElement helper operation to invoke.
     */
    #[DataProviderExternal(BlockContentProvider::class, 'nonBlockContent')]
    public function testThrowInvalidArgumentExceptionNonBlockContent(string $tagName, string $operation): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_BLOCK_ELEMENT->getMessage(strtolower($tagName)));

        match ($operation) {
            'begin' => BlockElement::begin($tagName),
            default => BlockElement::end($tagName),
        };
    }

    /**
     * @phpstan-param 'begin'|'end' $operation BlockElement helper operation to invoke.
     */
    #[DataProviderExternal(BlockContentProvider::class, 'emptyContent')]
    public function testThrowInvalidArgumentExceptionWithEmptyTagName(string $operation): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        match ($operation) {
            'begin' => BlockElement::begin(''),
            default => BlockElement::end(''),
        };
    }
}
