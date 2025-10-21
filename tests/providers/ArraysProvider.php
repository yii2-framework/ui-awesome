<?php

declare(strict_types=1);

namespace yii\ui\tests\providers;

use yii\ui\tests\support\stub\enum\{Priority, Status, Theme};

/**
 * Data provider for array structure validation in tests.
 *
 * Designed to ensure array utility logic correctly processes all supported scenarios, including list and associative
 * array detection, providing comprehensive test data for validation and edge case coverage.
 *
 * The test data covers real-world array usage scenarios and edge cases to maintain consistent output across different
 * array configurations, ensuring array handling is robust and predictable throughout the application.
 *
 * The provider organizes test cases with descriptive names for quick identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Comprehensive coverage for array structure validation.
 * - Edge case validation for empty, numeric, and mixed key arrays.
 * - List and associative array detection scenarios.
 * - Named test data sets for clear failure identification.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class ArraysProvider
{
    /**
     * Provides test cases for value membership validation in allowed lists.
     *
     * Supplies comprehensive test data for validating the inList method, including basic string values, enum instances,
     * empty values, empty allowed lists, case sensitivity checks, type strictness validation, and mixed enum type
     * scenarios.
     *
     * Each test case includes the attribute name, value to check, allowed list, expected boolean result, and an
     * assertion message for clear failure identification.
     *
     * @return array<array{string, mixed, array<mixed>, bool, string}> Test data for inList validation scenarios.
     *
     * @phpstan-return array<array{string, mixed, list<mixed>, bool, string}>
     */
    public static function inList(): array
    {
        return [
            'backed-enum-value-in-list' => [
                'attribute',
                Status::ACTIVE,
                Status::cases(),
                true,
                "Should return 'true' when 'active' is in the allowed list ['active', 'inactive'].",
            ],
            'empty-allowed-list' => [
                'attribute',
                'a',
                [],
                false,
                "Should return 'false' when the allowed list is empty.",
            ],
            'empty-value-not-in-list' => [
                'attribute',
                '',
                ['a', 'b', 'c'],
                false,
                "Should return 'false' when the value is empty and not in the allowed list ['a', 'b', 'c'].",
            ],
            'invalid-enum-comparison' => [
                'attribute',
                Status::ACTIVE,
                Theme::cases(),
                false,
                "Should return 'false' when 'Status::ACTIVE' is compared against 'Theme::cases()'.",
            ],
            'mixed-enum-types-backed-enum-value-found' => [
                'attribute',
                'DARK',
                [Status::ACTIVE, Theme::DARK, Priority::LOW],
                true,
                "Should return 'true' when 'DARK' is in a mixed enum list.",
            ],
            'mixed-enum-types-enum-instance-found' => [
                'attribute',
                Status::ACTIVE,
                [Status::ACTIVE, Theme::DARK, Priority::LOW],
                true,
                "Should return 'true' when 'Status::ACTIVE' is in a mixed enum list.",
            ],
            'mixed-enum-types-int-value-found' => [
                'attribute',
                1,
                [Status::ACTIVE, Theme::DARK, Priority::LOW],
                true,
                "Should return 'true' when integer '1' ('Priority::LOW') is in a mixed enum list.",
            ],
            'mixed-enum-types-string-not-found-type-strictness' => [
                'attribute',
                '1',
                [Status::ACTIVE, Theme::DARK, Priority::LOW],
                false,
                "Should return 'false' for string '1' when only int 1 is allowed in a mixed enum list.",
            ],
            'string-case-sensitive-enum-value' => [
                'attribute',
                'ACTIVE',
                [Status::ACTIVE, Status::INACTIVE],
                false,
                "Should return 'false' when string 'ACTIVE' (uppercase) is compared against backed enum values.",
            ],
            'string-value-in-list' => [
                'attribute',
                'a',
                ['a', 'b', 'c'],
                true,
                "Should return 'true' when 'a' is in the allowed list ['a', 'b', 'c'].",
            ],
            'string-value-not-in-list' => [
                'attribute',
                '1',
                ['a', 'b', 'c'],
                false,
                "Should return 'false' when '1' is not in the allowed list ['a', 'b', 'c'].",
            ],
            'unit-enum-value-in-list' => [
                'attribute',
                Theme::DARK,
                Theme::cases(),
                true,
                "Should return 'true' when 'DARK' is in the allowed list ['DARK', 'LIGHT'].",
            ],
        ];
    }

    /**
     * Provides test cases for associative array detection scenarios.
     *
     * Supplies test data for validating the detection of associative arrays, including empty arrays, numeric keys, and
     * mixed key/value structures.
     *
     * Each test case includes the input array and the expected boolean result indicating whether the array is
     * associative.
     *
     * @return array<array{array<array-key, int|string>, bool}> Test data for associative array scenarios.
     *
     * @phpstan-return array<array{array<array-key, int|string>, bool}>
     */
    public static function isAssociative(): array
    {
        return [
            'associative-array' => [
                [
                    'name' => 1,
                    'value' => 'test',
                ],
                true,
            ],
            'empty-array' => [
                [],
                false,
            ],
            'mixed-keys-array' => [
                [
                    'name' => 1,
                    'value' => 'test',
                    3,
                ],
                false,
            ],
            'numeric-indexed-array' => [
                [
                    1,
                    2,
                    3,
                ],
                false,
            ],
            'single-element-array' => [
                [1],
                false,
            ],
        ];
    }

    /**
     * Provides test cases for list array detection scenarios.
     *
     * Supplies test data for validating the detection of list arrays, including empty arrays, numeric keys, and mixed
     * key/value structures.
     *
     * Each test case includes the input array and the expected boolean result indicating whether the array is a list.
     *
     * @return array<array{array<array-key, int|string>, bool}> Test data for list array scenarios.
     *
     * @phpstan-return array<array{array<array-key, int|string>, bool}>
     */
    public static function isList(): array
    {
        return [
            'associative-array' => [
                [
                    'name' => 1,
                    'value' => 'test',
                ],
                false,
            ],
            'empty-array' => [
                [],
                true,
            ],
            'mixed-keys-array' => [
                [
                    'name' => 1,
                    'value' => 'test',
                    3,
                ],
                false,
            ],
            'numeric-indexed-array' => [
                [
                    1,
                    2,
                    3,
                ],
                true,
            ],
            'single-element-array' => [
                [1],
                true,
            ],
        ];
    }
}
