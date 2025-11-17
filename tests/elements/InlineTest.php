<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\element\Inline;
use yii\ui\exception\Message;
use yii\ui\tag\{BlockTag, InlineTag, VoidTag};
use yii\ui\tests\providers\elements\InlineProvider;
use yii\ui\tests\support\TestSupport;

use function is_string;

/**
 * Test suite for {@see Inline} element functionality and behavior.
 *
 * Validates the rendering and management of inline-level HTML tags according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of inline element operations, supporting accurate tag
 * generation, attribute assignment, encoding, and exception handling for invalid or empty tag names.
 *
 * Test coverage:
 * - Accurate rendering of inline and void HTML tags.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for empty, invalid, or misused tag names.
 * - Immutability of the API when invoking inline operations.
 *
 * {@see InlineProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('elements')]
final class InlineTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(InlineProvider::class, 'inlineTags')]
    public function testRenderInlineTagWithAndWithoutEncoding(string|InlineTag $tag): void
    {
        $content = '<mark>inline</mark>';
        $attributes = ['id' => 'inline-element'];

        $tagValue = is_string($tag) ? $tag : $tag->value;

        self::equalsWithoutLE(
            "<{$tagValue} id=\"inline-element\">{$content}</{$tagValue}>",
            Inline::tag($tag, $content, $attributes),
            "Rendered inline '<{$tagValue}>' tag without encoding should match expected output.",
        );
        self::equalsWithoutLE(
            "<{$tagValue} id=\"inline-element\">&lt;mark&gt;inline&lt;/mark&gt;</{$tagValue}>",
            Inline::tag($tag, $content, $attributes, true),
            "Rendered inline '<{$tagValue}>' tag with encoding should match expected output.",
        );
    }

    #[DataProviderExternal(InlineProvider::class, 'voidTags')]
    public function testRenderVoidTag(string|VoidTag $tag): void
    {
        $attributes = [
            'class' => ['void-element'],
            'data' => ['role' => 'presentation'],
        ];

        $tagValue = is_string($tag) ? $tag : $tag->value;

        self::equalsWithoutLE(
            "<{$tagValue} class=\"void-element\" data-role=\"presentation\">",
            Inline::void($tag, $attributes),
            "Rendered void '<{$tagValue}>' tag should match expected output.",
        );
    }

    public function testThrowInvalidArgumentExceptionRenderInlineTagWithEmptyTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        Inline::tag('', 'content');
    }

    public function testThrowInvalidArgumentExceptionRenderVoidTagWithEmptyTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        Inline::void('');
    }

    #[DataProviderExternal(InlineProvider::class, 'voidInlineTags')]
    public function testThrowInvalidArgumentExceptionWhenInlineTagIsVoid(string|InlineTag $tag): void
    {
        $tagValue = is_string($tag) ? $tag : $tag->value;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::VOID_ELEMENT_CANNOT_HAVE_CONTENT->getMessage($tagValue));

        Inline::tag($tag, 'content');
    }

    #[DataProviderExternal(InlineProvider::class, 'inlineTags')]
    public function testThrowInvalidArgumentExceptionWhenVoidTagIsNotVoid(string|InlineTag $tag): void
    {
        $tagValue = is_string($tag) ? $tag : $tag->value;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_VOID_ELEMENT->getMessage($tagValue));

        Inline::void($tag);
    }

    #[DataProviderExternal(InlineProvider::class, 'nonInlineTags')]
    public function testThrowInvalidArgumentExceptionWithNonInlineTag(string|BlockTag $tag): void
    {
        $tagValue = is_string($tag) ? $tag : $tag->value;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_INLINE_ELEMENT->getMessage($tagValue));

        Inline::tag($tag, 'content');
    }
}
