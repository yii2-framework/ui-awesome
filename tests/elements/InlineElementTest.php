<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\element\InlineElement;
use yii\ui\element\tag\InlineTag;
use yii\ui\exception\Message;
use yii\ui\tests\providers\elements\InlineElementProvider;
use yii\ui\tests\support\TestSupport;

use function is_string;

/**
 * Test suite for {@see InlineElement} element functionality and behavior.
 *
 * Validates the rendering and management of inline-level HTML tags according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of inline element operations, supporting accurate opening and
 * closing tag generation, as well as exception handling for invalid or empty tag names.
 *
 * Test coverage:
 * - Accurate rendering of inline tags with and without encoding.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for empty or invalid tag names and block tag misuse.
 * - Immutability of the API when invoking inline operations.
 *
 * {@see InlineElementProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('elements')]
final class InlineElementTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(InlineElementProvider::class, 'inlineTags')]
    public function testRenderInlineTagWithAndWithoutEncoding(string|InlineTag $tag): void
    {
        $content = '<mark>inline</mark>';
        $attributes = ['id' => 'inline-element'];

        $tagValue = is_string($tag) ? $tag : $tag->value;

        self::equalsWithoutLE(
            "<{$tagValue} id=\"inline-element\">{$content}</{$tagValue}>",
            InlineElement::render($tag, $content, $attributes),
            "Rendered inline '<{$tagValue}>' tag without encoding should match expected output.",
        );
        self::equalsWithoutLE(
            "<{$tagValue} id=\"inline-element\">&lt;mark&gt;inline&lt;/mark&gt;</{$tagValue}>",
            InlineElement::render($tag, $content, $attributes, true),
            "Rendered inline '<{$tagValue}>' tag with encoding should match expected output.",
        );
    }

    public function testThrowInvalidArgumentExceptionRenderInlineTagWithEmptyTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        InlineElement::render('', 'content');
    }

    public function testThrowInvalidArgumentExceptionWithNonInlineTag(): void
    {
        $tagName = 'div';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_INLINE_ELEMENT->getMessage($tagName));

        InlineElement::render($tagName, 'content');
    }
}
