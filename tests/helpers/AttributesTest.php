<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use yii\ui\helpers\Attributes;
use yii\ui\tests\providers\AttributesProvider;

/**
 * Test suite for {@see Attributes} class functionality and behavior.
 *
 * Verifies HTML attribute rendering capabilities including array, boolean, enum, and data attribute handling, as well
 * as special character escaping and attribute ordering.
 *
 * These tests ensure that attribute rendering features work correctly under various scenarios and maintain consistent
 * behavior after code changes.
 *
 * The tests validate scenarios such as array-to-string conversion, boolean attribute handling, data attribute
 * expansion, enum attribute support, and special character encoding, which are essential for generating valid and
 * secure HTML output in the framework.
 *
 * Test coverage.
 * - Array to string conversion for class, style, and data attributes.
 * - Attribute ordering and skipping of invalid attribute names.
 * - Boolean attribute rendering and omission of false/null values.
 * - Data attribute expansion and nested array sanitization.
 * - Enum attribute support for PHP 8.1 enum values.
 * - Special character encoding for HTML safety.
 * - Style attribute formatting and normalization.
 *
 * {@see AttributesProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2024 PHPPress.
 * @license https://opensource.org/license/gpl-3.0 GNU General Public License version 3 or later.
 */
#[Group('html')]
final class AttributesTest extends \PHPUnit\Framework\TestCase
{
    public function testRenderClassWithMaliciousValue(): void
    {
        self::assertSame(
            ' class="safe &lt;svg/onload=alert()&gt;"',
            Attributes::render(['class' => ['safe', '<svg/onload=alert()>']]),
            'Should encode malicious class values to prevent XSS.',
        );
    }

    public function testRenderEmptyAttributeReturnsEmptyString(): void
    {
        self::assertEmpty(
            Attributes::render(['empty' => '']),
            'Should return an empty string when attribute value is empty.',
        );
    }

    /**
     * @param array<string, mixed> $attributes
     */
    #[DataProviderExternal(AttributesProvider::class, 'enumAttribute')]
    public function testRenderEnumAttributesFromProvider(string $expected, array $attributes): void
    {
        self::assertSame(
            $expected,
            Attributes::render($attributes),
            'Should render enum attributes as expected for each data set.',
        );
    }

    public function testRenderMultipleAttributesInOrder(): void
    {
        self::assertSame(
            ' class="class" id="id" name="name" height="height" data-tests="data-tests"',
            Attributes::render(
                [
                    'id' => 'id',
                    'class' => 'class',
                    'data-tests' => 'data-tests',
                    'name' => 'name',
                    'height' => 'height',
                ],
            ),
            'Should render attributes in the expected order.',
        );
    }

    public function testRenderNullAttributeReturnsEmptyString(): void
    {
        self::assertSame(
            '',
            Attributes::render(['null' => null]),
            'Should return an empty string when attribute value is null.',
        );
    }

    public function testRenderStyleWithArrayValue(): void
    {
        self::assertSame(
            ' style="complex-property: ["value1","value2"];"',
            Attributes::render(['style' => ['complex-property' => ['value1', 'value2']]]),
            'Should JSON-encode array values in style attributes when not scalar types.',
        );
    }

    public function testRenderStyleWithBooleanValue(): void
    {
        self::assertSame(
            ' style="flag: true;"',
            Attributes::render(['style' => ['flag' => true]]),
            'Should JSON-encode boolean values in style attributes.',
        );
    }

    public function testRenderStyleWithNestedArrayValue(): void
    {
        self::assertSame(
            ' style="config: {"nested":{"key":"value"}};"',
            Attributes::render(['style' => ['config' => ['nested' => ['key' => 'value']]]]),
            'Should JSON-encode nested array structures in style attributes with proper encoding.',
        );
    }

    public function testRenderStyleWithNullValue(): void
    {
        self::assertEmpty(
            Attributes::render(['style' => ['nullable' => null]]),
            'Should omit null values in style attributes.',
        );
    }

    public function testRenderStyleWithSpecialCharacters(): void
    {
        self::assertSame(
            ' style="font-family: Times &amp; Serif;"',
            Attributes::render(['style' => ['font-family' => 'Times & Serif']]),
            'Should render style attribute with special characters correctly, without double-encoding.',
        );
    }

    /**
     * @param array<string, mixed> $attributes
     */
    #[DataProviderExternal(AttributesProvider::class, 'renderTagAttributes')]
    public function testRenderVariousAttributesFromProvider(string $expected, array $attributes): void
    {
        self::assertSame(
            $expected,
            Attributes::render($attributes),
            'Should render attributes as expected for each data set.',
        );
    }

    public function testSanitizeNestedArrayInDataAttribute(): void
    {
        self::assertSame(
            ' data-key=\'{"sub":"\u0026lt;script\u0026gt;"}\'',
            Attributes::render(['data' => ['key' => ['sub' => '<script>']]]),
            'Should sanitize nested arrays in data attributes and encode special characters.',
        );
    }

    public function testSkipInvalidAttributeNames(): void
    {
        self::assertSame(
            ' valid="ok"',
            Attributes::render(['valid' => 'ok', '123-invalid' => 'bad']),
            'Should skip attributes with invalid names and render only valid ones.',
        );
    }
}
