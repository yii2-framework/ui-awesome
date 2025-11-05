<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use yii\ui\helpers\Enum;
use yii\ui\tests\support\stub\enum\Status;
use yii\ui\tests\support\stub\enum\Theme;

/**
 * Test suite for {@see Enum} utility class functionality and behavior.
 *
 * Verifies the enum utility component's ability to normalize enum values and arrays, supporting both BackedEnum and
 * UnitEnum, and ensuring the correct scalar conversion and pass-through for mixed input types.
 *
 * These tests ensure enum normalization features work correctly under different conditions and maintain consistent
 * behavior after code changes.
 *
 * The tests validate normalization of arrays and single values, handling of backed and unit enums, and pass-through of
 * scalars, which are essential for robust enum processing and type safety in the framework.
 *
 * Test coverage.
 * - Consistent conversion of enum values to their scalar representation.
 * - Normalization of arrays containing backed enums, unit enums, and mixed values.
 * - Scalar value pass-through for non-enum types.
 * - Support for both backed and unit enum normalization.
 *
 * {@see BackedEnum} for enums with scalar values.
 * {@see UnitEnum} for all enum types.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('helpers')]
final class EnumTest extends TestCase
{
    public function testNormalizeArrayNormalizesArrayOfEnumsForBackedEnum(): void
    {
        self::assertSame(
            ['active', 'inactive'],
            Enum::normalizeArray([Status::ACTIVE, Status::INACTIVE]),
            'Should return an array of name values for backed enums.',
        );
    }

    public function testNormalizeArrayNormalizesArrayOfEnumsForUnitEnum(): void
    {
        self::assertSame(
            ['DARK', 'LIGHT'],
            Enum::normalizeArray([Theme::DARK, Theme::LIGHT]),
            'Should return an array of name values for unit enums.',
        );
    }

    public function testNormalizeArrayPassesThroughMixedArray(): void
    {
        self::assertSame(
            ['foo', 'active', 42],
            Enum::normalizeArray(['foo', Status::ACTIVE, 42]),
            'Should normalize enums and pass through scalars.',
        );
    }

    public function testNormalizeValuePassesThroughScalar(): void
    {
        self::assertSame(
            42,
            Enum::normalizeValue(42),
            'Should return the original scalar value if not an enum.',
        );
    }

    public function testNormalizeValueReturnsNameForUnitEnum(): void
    {
        self::assertSame(
            'DARK',
            Enum::normalizeValue(Theme::DARK),
            'Should return the name value for a unit enum.',
        );
    }

    public function testNormalizeValueReturnsScalarForBackedEnum(): void
    {
        self::assertSame(
            'active',
            Enum::normalizeValue(Status::ACTIVE),
            'Should return the name value for a backed enum.',
        );
    }

    public function testNormalizeValueReturnsScalarForUnitEnum(): void
    {
        self::assertSame(
            'LIGHT',
            Enum::normalizeValue(Theme::LIGHT),
            'Should return the name value for a unit enum.',
        );
    }

    public function testNormalizeValueReturnsValueForBackedEnum(): void
    {
        self::assertSame(
            'inactive',
            Enum::normalizeValue(Status::INACTIVE),
            'Should return the name value for a backed enum.',
        );
    }
}
