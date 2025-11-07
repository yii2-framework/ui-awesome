<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\attributes;

/**
 * Data provider for {@see \yii\ui\tests\attributes\HasDataTest} class.
 *
 * Supplies comprehensive test data for validating the handling of the global HTML `data-*` attribute in widget and tag
 * rendering, ensuring standards-compliant assignment, value propagation, and type safety according to the HTML
 * specification.
 *
 * The test data covers real-world scenarios for setting, overriding, and propagating `data-*` attributes, supporting
 * both explicit `string` values and `Closure(): string` for dynamic assignment, to maintain consistent output across
 * different rendering configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features.
 * - Conforms to the HTML global attribute specification for `data-*`.
 * - Ensures correct propagation and assignment of `data-*` attributes in HTML element rendering.
 * - Named test data sets for precise failure identification.
 * - Validation of empty `string`, dynamic `Closure`, and standard string values for the `data-*` attribute.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class DataProvider
{
    /**
     * Provides test cases for HTML `data-*` attribute scenarios.
     *
     * Supplies test data for validating assignment and propagation of the global HTML `data-*` attribute, including
     * empty `string`, dynamic `Closure`, and standard string values.
     *
     * Each test case includes the input value(s), the expected output, and an assertion message for clear
     * identification.
     *
     * @return array Test data for `data-*` attribute scenarios.
     *
     * @phpstan-return array<
     *   string,
     *   array{
     *     array<string, string|\Closure(): string>,
     *     array<string, string|\Closure(): string>,
     *     string,
     *   }
     * >
     */
    public static function values(): array
    {
        $closureValue = static fn(): string => 'test-action';

        return [
            'attribute with hyphenated key' => [
                ['custom-action' => 'value'],
                ['data-custom-action' => 'value'],
                'Should set data attribute with hyphenated key.',
            ],
            'empty string value' => [
                ['action' => ''],
                ['data-action' => ''],
                'Should set data attribute with empty string value.',
            ],
            'mixed string and closure values' => [
                [
                    'action' => 'test-action',
                    'callback' => $closureValue,
                ],
                [
                    'data-action' => 'test-action',
                    'data-callback' => $closureValue,
                ],
                'Should set multiple data attributes with mixed string and closure values.',
            ],
            'multiple string values' => [
                [
                    'action' => 'test-action',
                    'id' => 'test-id',
                    'value' => 'test-value',
                ],
                [
                    'data-action' => 'test-action',
                    'data-id' => 'test-id',
                    'data-value' => 'test-value',
                ],
                'Should set multiple data attributes with string values.',
            ],
            'single closure value' => [
                ['action' => $closureValue],
                ['data-action' => $closureValue],
                'Should set data attribute with closure value.',
            ],
            'single string value' => [
                ['action' => 'test-action'],
                ['data-action' => 'test-action'],
                'Should set data attribute with string value.',
            ],
        ];
    }
}
