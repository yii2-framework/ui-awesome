<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\attributes;

use UnitEnum;
use yii\ui\tests\support\stub\enum\AlertType;

/**
 * Data provider for {@see \yii\ui\tests\attributes\HasClassTest} class.
 *
 * Supplies comprehensive test data for validating the handling of the global HTML `class` attribute in widget and tag
 * rendering, ensuring standards-compliant assignment, override behavior, and value propagation according to the HTML
 * specification.
 *
 * The test data covers real-world scenarios for appending, overriding, and removing the `class` attribute, supporting
 * both explicit `string` values and `null` for attribute removal, to maintain consistent output across different
 * rendering configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features.
 * - Ensures correct propagation, appending, and override of the `class` attribute in HTML element rendering.
 * - Named test data sets for precise failure identification.
 * - Validation of empty `string`, `null`, and standard string values for the `class` attribute.
 *
 * {@see AlertType} for enum test case usage.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class ClassProvider
{
    /**
     * Provides test cases for HTML `class` attribute scenarios.
     *
     * Supplies test data for validating assignment, appending, and override of the global HTML `class` attribute,
     * including empty `string`, `null`, and standard string values.
     *
     * Each test case includes the input value(s), the expected output, and an assertion message for clear
     * identification.
     *
     * @return array Test data for `class` attribute scenarios.
     *
     * @phpstan-return array<
     *   string,
     *   array{0: array<array{value: string|UnitEnum|null, override?: bool}>, 1: string, 2: string}
     * >
     */
    public static function values(): array
    {
        return [
            'appending class values' => [
                [
                    ['value' => 'class-one'],
                    ['value' => 'class-two'],
                ],
                'class-one class-two',
                'Should append new attribute value to existing attribute value.',
            ],
            'empty class value' => [
                [['value' => '']],
                '',
                'Should return an empty string when setting an empty string.',
            ],
            'enum class value' => [
                [['value' => AlertType::WARNING]],
                'warning',
                'Should return the attribute value after setting it.',
            ],
            'multiple appends then override' => [
                [
                    ['value' => 'class-one'],
                    ['value' => 'class-two'],
                    [
                        'override' => true,
                        'value' => 'class-three',
                    ],
                ],
                'class-three',
                'Should override all previous class values when override flag is true.',
            ],
            'null class value' => [
                [['value' => null]],
                '',
                "Should return 'null' when the attribute is set to 'null'.",
            ],
            'overriding class value' => [
                [
                    ['value' => 'class-one'],
                    [
                        'override' => true,
                        'value' => 'class-override',
                    ],
                ],
                'class-override',
                'Should return new attribute value after overriding the existing attribute value.',
            ],
            'single class value' => [
                [['value' => 'class-one']],
                'class-one',
                'Should return the attribute value after setting it.',
            ],
            'unset with null' => [
                [
                    ['value' => 'class-one'],
                    ['value' => null],
                ],
                '',
                'Should unset the class attribute when null is provided after a value.',
            ],
        ];
    }
}
