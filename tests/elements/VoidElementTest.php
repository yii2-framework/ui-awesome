<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\content\flow\VoidContent;
use yii\ui\element\VoidElement;
use yii\ui\exception\Message;
use yii\ui\tests\providers\content\VoidContentProvider;
use yii\ui\tests\support\TestSupport;

use function is_string;

/**
 * Test suite for {@see VoidElement} functionality and behavior.
 *
 * Validates the manipulation and rendering of global HTML void elements according to the HTML Living Standard
 * specification.
 *
 * Ensures correct handling, immutability, and validation of void element operations, supporting both `string` and
 * enum types for tag assignment and rendering.
 *
 * Test coverage:
 * - Accurate rendering of void tags with attribute assignment.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for invalid or empty tag names and non-void content.
 * - Immutability of the API when setting or overriding void tags.
 * - Proper assignment and overriding of void tag values.
 *
 * {@see VoidContentProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('elements')]
final class VoidElementTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(VoidContentProvider::class, 'voidContent')]
    public function testRenderVoid(string|VoidContent $tag): void
    {
        $attributes = [
            'class' => ['void-element'],
            'data' => ['role' => 'presentation'],
        ];

        $tagValue = is_string($tag) ? $tag : $tag->value;

        self::equalsWithoutLE(
            "<{$tagValue} class=\"void-element\" data-role=\"presentation\">",
            VoidElement::render($tag, $attributes),
            "Rendered void '<{$tagValue}>' tag should match expected output.",
        );
    }

    public function testThrowInvalidArgumentExceptionWithEmptyTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        VoidElement::render('');
    }

    #[DataProviderExternal(VoidContentProvider::class, 'nonVoidContent')]
    public function testThrowInvalidArgumentExceptionWithNonVoidTag(string $tagName): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_VOID_ELEMENT->getMessage($tagName));

        VoidElement::render($tagName);
    }
}
