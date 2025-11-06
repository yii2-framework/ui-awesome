<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\attributes;

/**
 * Data provider for {@see \yii\ui\tests\attributes\HasIdTest} class.
 *
 * Supplies comprehensive test data for validating the handling of the global HTML `id` attribute in widget and tag
 * rendering, ensuring standards-compliant assignment, nullability, and value propagation according to the HTML
 * specification.
 *
 * The test data covers real-world scenarios for setting, unsetting, and propagating the `id` attribute, supporting both
 * explicit `string` values and `null` for attribute removal, to maintain consistent output across different rendering
 * configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features.
 * - Ensures correct propagation and removal of the `id` attribute in HTML element rendering.
 * - Named test data sets for precise failure identification.
 * - Validation of empty `string`, `null`, and standard string values for the `id` attribute.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class IdProvider
{
    /**
     * Provides test cases for HTML `id` attribute scenarios.
     *
     * Supplies test data for validating assignment and propagation of the global HTML `id` attribute, including empty
     * `string`, `null`, and standard string values.
     *
     * Each test case includes the input value, the expected output, and an assertion message for clear identification.
     *
     * @return array Test data for `id` attribute scenarios.
     *
     * @phpstan-return array<string, array{string|null, string, string}>
     */
    public static function values(): array
    {
        return [
            'empty string' => [
                '',
                '',
                'Should return an empty string when setting an empty string.',
            ],
            'null' => [
                null,
                '',
                "Should return 'null' when the attribute is set to 'null'.",
            ],
            'string' => [
                'id-one',
                'id-one',
                'Should return the attribute value after setting it.',
            ],
        ];
    }
}
