<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
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
 * - Boolean attribute rendering and omission of `false`/`null` values.
 * - Data attribute expansion and nested array sanitization.
 * - Enum attribute support for PHP 8.1 enum values.
 * - Malicious value handling and XSS prevention.
 * - Special character encoding for HTML safety.
 * - Style attribute formatting and normalization.
 *
 * {@see AttributesProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
final class AttributesTest extends TestCase
{
    /**
     * @param array<string, mixed> $attributes
     */
    #[DataProviderExternal(AttributesProvider::class, 'attributeOrdering')]
    public function testRenderAttributeOrdering(string $expected, array $attributes): void
    {
        self::assertSame(
            $expected,
            Attributes::render($attributes),
            'Should render attributes in the expected order.',
        );
    }

    /**
     * @param array<string, mixed> $attributes
     */
    #[DataProviderExternal(AttributesProvider::class, 'emptyAndNullValues')]
    public function testRenderEmptyAndNullValues(string $expected, array $attributes): void
    {
        self::assertSame(
            $expected,
            Attributes::render($attributes),
            'Should handle empty and null values as expected for each data set.',
        );
    }

    /**
     * @param array<string, mixed> $attributes
     */
    #[DataProviderExternal(AttributesProvider::class, 'enumAttribute')]
    public function testRenderEnumAttributes(string $expected, array $attributes): void
    {
        self::assertSame(
            $expected,
            Attributes::render($attributes),
            'Should render enum attributes as expected for each data set.',
        );
    }

    /**
     * @param array<string, mixed> $attributes
     */
    #[DataProviderExternal(AttributesProvider::class, 'maliciousValues')]
    public function testRenderMaliciousValues(string $expected, array $attributes): void
    {
        self::assertSame(
            $expected,
            Attributes::render($attributes),
            'Should sanitize malicious values to prevent XSS and security vulnerabilities.',
        );
    }

    /**
     * @param array<string, mixed> $attributes
     */
    #[DataProviderExternal(AttributesProvider::class, 'styleAttributes')]
    public function testRenderStyleAttributes(string $expected, array $attributes): void
    {
        self::assertSame(
            $expected,
            Attributes::render($attributes),
            'Should render style attributes as expected for each data set.',
        );
    }

    /**
     * @param array<string, mixed> $attributes
     */
    #[DataProviderExternal(AttributesProvider::class, 'renderTagAttributes')]
    public function testRenderTagAttributes(string $expected, array $attributes): void
    {
        self::assertSame(
            $expected,
            Attributes::render($attributes),
            'Should render attributes as expected for each data set.',
        );
    }
}
