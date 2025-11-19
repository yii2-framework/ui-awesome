<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\element\InlineElement;
use yii\ui\exception\Message;
use yii\ui\tests\providers\content\InlineContentProvider;
use yii\ui\tests\support\TestSupport;

use function strtolower;

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
    public function testRenderInline(string|UnitEnum $tagName, string $expectedTagName): void
    {
        $content = '<mark>inline</mark>';
        $attributes = ['id' => 'inline-element'];

        self::equalsWithoutLE(
            "<{$expectedTagName} id=\"inline-element\">{$content}</{$expectedTagName}>",
            InlineElement::render($tagName, $content, $attributes),
            "Rendered inline '<{$expectedTagName}>' tag without encoding should match expected output.",
        );
        self::equalsWithoutLE(
            "<{$expectedTagName} id=\"inline-element\">&lt;mark&gt;inline&lt;/mark&gt;</{$expectedTagName}>",
            InlineElement::render($tagName, $content, $attributes, true),
            "Rendered inline '<{$expectedTagName}>' tag with encoding should match expected output.",
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
        $this->expectExceptionMessage(Message::INVALID_INLINE_ELEMENT->getMessage(strtolower($tagName)));

        InlineElement::render($tagName, 'content');
    }
}
