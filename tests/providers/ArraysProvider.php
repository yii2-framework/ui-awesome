<?php

declare(strict_types=1);

namespace yii\ui\tests\providers;

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
     * Provides test cases for associative array detection scenarios.
     *
     * Supplies test data for validating the detection of associative arrays, including empty arrays, numeric keys, and
     * mixed key/value structures. Each test case includes the input array and the expected boolean result indicating
     * whether the array is associative.
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
     * key/value structures. Each test case includes the input array and the expected boolean result indicating whether
     * the array is a list.
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
