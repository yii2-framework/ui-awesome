<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\ui\helpers\Encode;
use yii\ui\tests\providers\EncodeProvider;

/**
 * Test suite for {@see Encode} class functionality and behavior.
 *
 * Verifies HTML encoding capabilities including double encoding, entity handling, special character encoding, and
 * Unicode sequence processing to ensure correct and secure HTML output generation.
 *
 * These tests ensure that encoding features work correctly under various scenarios and maintain consistent behavior
 * after code changes.
 *
 * The tests validate scenarios such as basic HTML entity encoding, double encoding, mixed content, Unicode handling,
 * and error cases, which are essential for generating valid and secure HTML output in the framework.
 *
 * Test coverage.
 * - Basic HTML entities encoding (`<`, `>`, `&`, `\"`, `\'`).
 * - Entity double encoding and prevention.
 * - Error and edge cases for invalid input.
 * - Mixed content and special character handling.
 * - Unicode sequence encoding and preservation.
 *
 * {@see EncodeProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('helpers')]
final class EncodeTest extends TestCase
{
    #[DataProviderExternal(EncodeProvider::class, 'content')]
    public function testEncodeContentHandlesEntitiesAndDoubleEncoding(
        string $value,
        string $expected,
        bool $doubleEncode,
    ): void {
        self::assertSame(
            $expected,
            Encode::content($value),
            "Should encode ({$value}) as ({$expected}) (doubleEncode: 'true').",
        );

        $doubleEncodeValue = $doubleEncode ? 'true' : 'false';

        self::assertSame(
            $expected,
            Encode::content($value, $doubleEncode),
            "Should encode ({$value}) as ({$expected}) with doubleEncode='{$doubleEncodeValue}'.",
        );
    }

    #[DataProviderExternal(EncodeProvider::class, 'value')]
    public function testEncodeValueHandlesMixedTypesAndDoubleEncoding(
        float|int|string|null $value,
        string $expected,
        bool $doubleEncode,
    ): void {
        self::assertSame(
            $expected,
            Encode::value($value),
            "Should encode value ({$value}) as ({$expected}) (doubleEncode: 'true').",
        );

        $doubleEncodeValue = $doubleEncode ? 'true' : 'false';

        self::assertSame(
            $expected,
            Encode::value($value, $doubleEncode),
            "Should encode value ({$value}) as ({$expected}) with doubleEncode='{$doubleEncodeValue}'.",
        );
    }
}
