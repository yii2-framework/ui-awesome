<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\content\flow\InlineContent;
use yii\ui\element\InlineElement;
use yii\ui\exception\Message;
use yii\ui\tests\providers\content\InlineContentProvider;
use yii\ui\tests\support\TestSupport;

use function is_string;

/**
 * Test suite for {@see InlineElement} functionality and behavior.
 *
 * Validates the manipulation and rendering of global HTML inline elements according to the HTML Living Standard
 * specification.
 *
 * Ensures correct handling, immutability, and validation of inline element operations, supporting both `string` and
 * enum types for tag assignment and rendering.
 *
 * Test coverage:
 * - Accurate rendering of inline tags with and without encoding.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for invalid or empty tag names and non-inline content.
 * - Immutability of the API when setting or overriding inline tags.
 * - Proper assignment and overriding of inline tag values.
 *
 * {@see InlineContentProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('elements')]
final class InlineElementTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(InlineContentProvider::class, 'inlineContent')]
    public function testRenderInline(string|InlineContent $tag): void
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

    public function testThrowInvalidArgumentExceptionWithEmptyTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        InlineElement::render('', 'content');
    }

    #[DataProviderExternal(InlineContentProvider::class, 'nonInlineContent')]
    public function testThrowInvalidArgumentExceptionWithNonInlineContent(string $tagName): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_INLINE_ELEMENT->getMessage($tagName));

        InlineElement::render($tagName, 'content');
    }
}
