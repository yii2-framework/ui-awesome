<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\element\Element;
use yii\ui\exception\Message;
use yii\ui\helpers\Enum;
use yii\ui\tests\providers\tag\{BlockProvider, InlineProvider, VoidProvider};
use yii\ui\tests\support\TestSupport;

use function strtolower;

/**
 * Test suite for {@see Element} rendering logic and tag validation.
 *
 * Validates the correct handling and output of HTML element tags according to the HTML Living Standard specification.
 *
 * Ensures proper rendering, immutability, and validation of block, inline, and void elements, supporting both `string`
 * and `UnitEnum` tag names.
 *
 * Test coverage:
 * - Accurate rendering of block, inline, and void HTML tags.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for invalid tag names and element types.
 * - Immutability of the API when rendering or validating tags.
 * - Proper assignment and normalization of tag names.
 *
 * {@see BlockProvider}, {@see InlineProvider}, {@see VoidProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('elements')]
final class ElementTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(BlockProvider::class, 'blockTags')]
    public function testRenderBegin(string|UnitEnum $tagName, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "<{$expectedTagName}>",
            Element::begin($tagName),
            "Element begin '<{$expectedTagName}>' block tag should match expected output.",
        );
    }

    #[DataProviderExternal(BlockProvider::class, 'blockTags')]
    public function testRenderEnd(string|UnitEnum $tagName, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "</{$expectedTagName}>",
            Element::end($tagName),
            "Element end '</{$expectedTagName}>' block tag should match expected output.",
        );
    }

    #[DataProviderExternal(InlineProvider::class, 'inlineTags')]
    public function testRenderInline(string|UnitEnum $tagName, string $expectedTagName): void
    {
        $content = '<mark>inline</mark>';
        $attributes = ['id' => 'inline-element'];

        self::equalsWithoutLE(
            "<{$expectedTagName} id=\"inline-element\">{$content}</{$expectedTagName}>",
            Element::inline($tagName, $content, $attributes),
            "Element inline '<{$expectedTagName}>' tag without encoding should match expected output.",
        );
        self::equalsWithoutLE(
            "<{$expectedTagName} id=\"inline-element\">&lt;mark&gt;inline&lt;/mark&gt;</{$expectedTagName}>",
            Element::inline($tagName, $content, $attributes, true),
            "Element inline '<{$expectedTagName}>' tag with encoding should match expected output.",
        );
    }

    #[DataProviderExternal(VoidProvider::class, 'voidTags')]
    public function testRenderVoid(string|UnitEnum $tagName, string $expectedTagName): void
    {
        $attributes = [
            'class' => ['void-element'],
            'data' => ['role' => 'presentation'],
        ];

        self::equalsWithoutLE(
            "<{$expectedTagName} class=\"void-element\" data-role=\"presentation\">",
            Element::void($tagName, $attributes),
            "Element void '<{$expectedTagName}>' tag should match expected output.",
        );
    }

    /**
     * @phpstan-param 'begin'|'end' $operation BlockElement helper operation to invoke.
     */
    #[DataProviderExternal(BlockProvider::class, 'nonBlockTags')]
    public function testThrowInvalidArgumentExceptionNonBlockTag(string|UnitEnum $tagName, string $operation): void
    {
        $tagName = (string) Enum::normalizeValue($tagName);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_BLOCK_ELEMENT->getMessage(strtolower($tagName)));

        match ($operation) {
            'begin' => Element::begin($tagName),
            default => Element::end($tagName),
        };
    }

    /**
     * @phpstan-param 'begin'|'end' $operation BlockElement helper operation to invoke.
     */
    #[DataProviderExternal(BlockProvider::class, 'emptyTags')]
    public function testThrowInvalidArgumentExceptionRenderBeginEndWithEmptyTagName(string $operation): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        match ($operation) {
            'begin' => Element::begin(''),
            default => Element::end(''),
        };
    }

    public function testThrowInvalidArgumentExceptionRenderInlineWithEmptyTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        Element::inline('', 'content');
    }

    public function testThrowInvalidArgumentExceptionRenderVoidWithEmptyTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        Element::void('');
    }

    #[DataProviderExternal(InlineProvider::class, 'nonInlineTags')]
    public function testThrowInvalidArgumentExceptionWithNonInlineTag(string|UnitEnum $tagName): void
    {
        $tagName = (string) Enum::normalizeValue($tagName);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_INLINE_ELEMENT->getMessage(strtolower($tagName)));

        Element::inline($tagName, 'content');
    }

    #[DataProviderExternal(VoidProvider::class, 'nonVoidTags')]
    public function testThrowInvalidArgumentExceptionWithNonVoidTag(string|UnitEnum $tagName): void
    {
        $tagName = (string) Enum::normalizeValue($tagName);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_VOID_ELEMENT->getMessage(strtolower($tagName)));

        Element::void($tagName);
    }
}
