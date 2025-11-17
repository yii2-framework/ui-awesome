<?php

declare(strict_types=1);

namespace yii\ui\tests\elements;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\element\tag\VoidTag;
use yii\ui\element\VoidElement;
use yii\ui\exception\Message;
use yii\ui\tests\providers\elements\VoidElementProvider;
use yii\ui\tests\support\TestSupport;

use function is_string;

/**
 * Test suite for {@see VoidElement} element functionality and behavior.
 *
 * Validates the rendering and management of void-level HTML tags according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of void element operations, supporting accurate tag
 * generation, as well as exception handling for invalid or empty tag names.
 *
 * Test coverage:
 * - Accurate rendering of void tags with attributes.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for empty or invalid tag names and non-void tag misuse.
 * - Immutability of the API when invoking void operations.
 *
 * {@see VoidElementProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('elements')]
final class VoidElementTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(VoidElementProvider::class, 'voidTags')]
    public function testRenderVoidTag(string|VoidTag $tag): void
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

    public function testThrowInvalidArgumentExceptionRenderVoidTagWithEmptyTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::EMPTY_TAG_NAME->getMessage());

        VoidElement::render('');
    }

    public function testThrowInvalidArgumentExceptionWithNonVoidTag(): void
    {
        $tagName = 'span';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Message::INVALID_VOID_ELEMENT->getMessage($tagName));

        VoidElement::render($tagName);
    }
}
