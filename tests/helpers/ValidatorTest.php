<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\ui\helpers\Validator;
use yii\ui\tests\providers\helpers\ValidatorProvider;

/**
 * Test suite for {@see Validator} helper functionality and behavior.
 *
 * Validates the normalization and validation of integer-like values according to PHP type and range constraints.
 *
 * Ensures correct handling, normalization, and validation of scalar and string values as integers, supporting minimum
 * and optional maximum boundaries for predictable validation output.
 *
 * Test coverage:
 * - Accurate detection of integer-like values within specified bounds.
 * - Compatibility with both `int` and `string` representations.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Immutability of the helper's API when validating values.
 *
 * {@see ValidatorProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('helpers')]
final class ValidatorTest extends TestCase
{
    #[DataProviderExternal(ValidatorProvider::class, 'intLike')]
    public function testIntegerLike(int|string $value, int $min, int|null $max, bool $expected, string $message): void
    {
        self::assertSame(
            $expected,
            Validator::intLike($value, $min, $max),
            $message,
        );
    }
}
