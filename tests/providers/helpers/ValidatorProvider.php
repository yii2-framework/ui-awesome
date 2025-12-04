<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\helpers;

/**
 * Data provider for {@see \yii\ui\tests\helpers\ValidatorTest} class.
 *
 * Supplies comprehensive test data for validating integer-like value normalization and range validation in HTML
 * attribute scenarios, ensuring standards-compliant conversion, type safety, and correct boundary enforcement according
 * to the PHP specification.
 *
 * The test data covers real-world scenarios for integer and string input validation, including boundary conditions,
 * negative and positive values, string representations, and invalid formats, supporting robust validation logic for
 * tag rendering.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features.
 * - Ensures correct validation of integer-like values, including string and numeric types.
 * - Named test data sets for precise failure identification.
 * - Validation of boundary conditions, negative values, and invalid input formats.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class ValidatorProvider
{
    /**
     * Provides test cases for integer-like value validation scenarios.
     *
     * Supplies comprehensive test data for validating integer and string input values, including boundary checks,
     * negative and positive values, string representations, and invalid formats, ensuring correct normalization and
     * validation for HTML attribute usage.
     *
     * Each test case includes the input value, minimum and maximum boundaries, expected boolean result, and an
     * assertion message for clear failure identification.
     *
     * @return array Test data for integer-like value validation scenarios.
     *
     * @phpstan-return array<string, array{int|string, int|null, int|null, bool, string}>
     */
    public static function intLike(): array
    {
        return [
            'integer above max' => [
                11,
                0,
                10,
                false,
                'Should be invalid value.',
            ],
            'integer below min' => [
                -2,
                -1,
                null,
                false,
                'Should be invalid value.',
            ],
            'integer equal min' => [
                0,
                0,
                null,
                true,
                'Should be valid value.',
            ],
            'integer max boundary equal' => [
                10,
                0,
                10,
                true,
                'Should be valid value.',
            ],
            'integer min equal null' => [
                0,
                null,
                null,
                true,
                'Should be valid value.',
            ],
            'integer negative min equal null' => [
                -1,
                null,
                null,
                false,
                'Should be invalid value.',
            ],
            'integer valid above min' => [
                5,
                0,
                null,
                true,
                'Should be valid value.',
            ],
            'integer within range' => [
                5,
                1,
                10,
                true,
                'Should be valid value.',
            ],
            'string above max' => [
                '11',
                0,
                10,
                false,
                'Should be invalid value.',
            ],
            'string below min but below max' => [
                '0',
                5,
                10,
                false,
                'Should be invalid value.',
            ],
            'string equal max' => [
                '10',
                0,
                10,
                true,
                'Should be valid value.',
            ],
            'string equal min' => [
                '5',
                5,
                null,
                true,
                'Should be valid value.',
            ],
            'string equal with min and max' => [
                '5',
                5,
                10,
                true,
                'Should be valid value.',
            ],
            'string float' => [
                '3.5',
                0,
                null,
                false,
                'Should be invalid value.',
            ],
            'string in range' => [
                '5',
                0,
                10,
                true,
                'Should be valid value.',
            ],
            'string leading zero equal min' => [
                '05',
                5,
                null,
                true,
                'Should be valid value.',
            ],
            'string min equal null' => [
                '0',
                null,
                null,
                true,
                'Should be valid value.',
            ],
            'string negative min equal null' => [
                '-1',
                null,
                null,
                false,
                'Should be invalid value.',
            ],
            'string negative not allowed when min >= 0' => [
                '-1',
                0,
                null,
                false,
                'Should be invalid value.',
            ],
            'string non digit' => [
                'abc',
                0,
                null,
                false,
                'Should be invalid value.',
            ],
            'string numeric equals min' => [
                '0',
                0,
                null,
                true,
                'Should be valid value.',
            ],
            'string numeric valid' => [
                '5',
                0,
                null,
                true,
                'Should be valid value.',
            ],
            'string numeric with plus sign' => [
                '+1',
                0,
                null,
                false,
                'Should be invalid value.',
            ],
            'string numeric within range' => [
                '3',
                1,
                5,
                true,
                'Should be valid value.',
            ],
            'string scientific notation' => [
                '1e3',
                0,
                null,
                false,
                'Should be invalid value.',
            ],
            'string with spaces' => [
                ' 3 ',
                0,
                null,
                false,
                'Should be invalid value.',
            ],
        ];
    }
}
