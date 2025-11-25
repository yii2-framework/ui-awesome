<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\attributes;

use UnitEnum;
use yii\ui\tests\support\stub\enum\Languages;

/**
 * Data provider for {@see \yii\ui\tests\attributes\HasLangTest} class.
 *
 * Supplies comprehensive test data for validating the handling of the global HTML `lang` attribute in widget and tag
 * rendering, ensuring standards-compliant assignment, override behavior, and value propagation according to the HTML
 * specification.
 *
 * The test data covers real-world scenarios for setting, overriding, and removing the `lang` attribute, supporting both
 * explicit `string` values, `UnitEnum` for enum-based language codes, and `null` for attribute removal, to maintain
 * consistent output across different rendering configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct propagation, assignment, and override of the `lang` attribute in HTML element rendering.
 * - Named test data sets for precise failure identification.
 * - Validation of empty `string`, `null`, and enum values for the `lang` attribute.
 *
 * {@see Languages} for enum test case usage.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class LangProvider
{
    /**
     * Provides test cases for rendered HTML `lang` attribute scenarios.
     *
     * Supplies test data for validating assignment, override, and removal of the global HTML `lang` attribute,
     * including empty `string`, `null`, `UnitEnum`, and standard string values.
     *
     * Each test case includes the input value, the initial attributes, the expected rendered output, and an assertion
     * message for clear identification.
     *
     * @return array Test data for rendered `lang` attribute scenarios.
     *
     * @phpstan-return array<string, array{string|UnitEnum|null, mixed[], string|UnitEnum, string}>
     */
    public static function renderAttribute(): array
    {
        return [
            'empty value' => [
                '',
                [],
                '',
                'Should return an empty string when setting an empty string.',
            ],
            'enum lang value' => [
                Languages::SPANISH,
                [],
                ' lang="es"',
                'Should return the attribute value after setting it.',
            ],
            'null value' => [
                null,
                [],
                '',
                "Should return 'null' when the attribute is set to 'null'.",
            ],
            'string value' => [
                'en',
                [],
                ' lang="en"',
                'Should return the attribute value after setting it.',
            ],
            'unset with null' => [
                null,
                ['lang' => 'fr'],
                '',
                "Should unset the 'lang' attribute when 'null' is provided after a value.",
            ],
        ];
    }

    /**
     * Provides test cases for HTML `lang` attribute scenarios.
     *
     * Supplies test data for validating assignment, override, and removal of the global HTML `lang` attribute,
     * including empty `string`, `null`, `UnitEnum`, and standard string values.
     *
     * Each test case includes the input value, the initial attributes, the expected output, and an assertion message
     * for clear identification.
     *
     * @return array Test data for `lang` attribute scenarios.
     *
     * @phpstan-return array<string, array{string|UnitEnum|null, mixed[], string|UnitEnum, string}>
     */
    public static function values(): array
    {
        return [
            'empty value' => [
                '',
                [],
                '',
                'Should return an empty string when setting an empty string.',
            ],
            'enum lang value' => [
                Languages::SPANISH,
                [],
                Languages::SPANISH,
                'Should return the attribute value after setting it.',
            ],
            'null value' => [
                null,
                [],
                '',
                "Should return 'null' when the attribute is set to 'null'.",
            ],
            'string value' => [
                'en',
                [],
                'en',
                'Should return the attribute value after setting it.',
            ],
            'unset with null' => [
                null,
                ['lang' => 'fr'],
                '',
                "Should unset the 'lang' attribute when 'null' is provided after a value.",
            ],
        ];
    }
}
