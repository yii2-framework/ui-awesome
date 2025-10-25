<?php

declare(strict_types=1);

namespace yii\ui\tests\providers;

use UnitEnum;
use yii\ui\tests\support\stub\enum\{AlertType, ButtonSize, Priority};

/**
 * Data provider for {@see \yii\ui\tests\helpers\CSSClassTest} class.
 *
 * Designed to ensure CSS class utility logic correctly processes all supported scenarios, including string and array
 * merging, duplicate removal, enum integration, and edge case handling, providing comprehensive test data for
 * validation and coverage.
 *
 * The test data covers real-world CSS class usage scenarios and edge cases to maintain consistent output across
 * different class configurations, ensuring class handling is robust and predictable throughout the application.
 *
 * The provider organizes test cases with descriptive names for quick identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features.
 * - Comprehensive coverage for class merging, deduplication, and normalization.
 * - Enum integration and validation for class values.
 * - Edge case validation for empty, `null`, and special character class names.
 * - Named test data sets for clear failure identification.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class CSSClassProvider
{
    /**
     * Provides test cases for adding single or multiple string class values.
     *
     * Supplies comprehensive test data for validating the addition of string-based class values, including single,
     * multiple, and mixed valid/empty string scenarios.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for string class scenarios.
     *
     * @phpstan-return array<string, array{mixed[], mixed[]|string|null, mixed[], string}>
     */
    public static function arrayOfStringsValues(): array
    {
        return [
            'single class' => [
                [],
                ['class-one'],
                ['class' => 'class-one'],
                'Should add single class from array.',
            ],
            'multiple classes' => [
                [],
                ['class-one', 'class-two', 'class-three'],
                ['class' => 'class-one class-two class-three'],
                'Should add multiple classes from array.',
            ],
            'mixed valid and empty strings' => [
                [],
                ['class-one', '', 'class-two', null, 'class-three'],
                ['class' => 'class-one class-two class-three'],
                "Should filter out empty strings and 'null' values from array.",
            ],
        ];
    }

    /**
     * Provides test cases for handling duplicate class values.
     *
     * Supplies comprehensive test data for validating the removal of duplicate class values, both within the same input
     * and when merging with existing classes.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for duplicate class scenarios.
     *
     * @phpstan-return array<string, array{mixed[], mixed[]|string|null, mixed[], string}>
     */
    public static function duplicateValues(): array
    {
        return [
            'duplicate class to existing class' => [
                ['class' => 'class-one'],
                'class-one',
                ['class' => 'class-one'],
                'Should not duplicate existing class when adding the same class.',
            ],
            'string with duplicate classes' => [
                [],
                'class-one class-one class-two',
                ['class' => 'class-one class-two'],
                'Should remove duplicates within the same string input.',
            ],
            'array with duplicate classes' => [
                [],
                ['class-one', 'class-two', 'class-one', 'class-three', 'class-two'],
                ['class' => 'class-one class-two class-three'],
                'Should remove duplicates within the same array input.',
            ],
            'new class to existing class' => [
                ['class' => 'class-one'],
                'class-two',
                ['class' => 'class-one class-two'],
                'Should append new class to existing classes.',
            ],
            'multiple new classes to existing classes' => [
                ['class' => 'class-one class-two'],
                ['class-three', 'class-four'],
                ['class' => 'class-one class-two class-three class-four'],
                'Should append multiple new classes to existing classes.',
            ],
            'mixed new and duplicate classes' => [
                ['class' => 'class-one class-two'],
                ['class-two', 'class-three', 'class-one', 'class-four'],
                ['class' => 'class-one class-two class-three class-four'],
                'Should append only new classes and ignore duplicates.',
            ],
        ];
    }

    /**
     * Provides test cases for edge value scenarios in class manipulation.
     *
     * Supplies comprehensive test data for validating the handling of edge cases such as very long class names, large
     * numbers of classes, unicode characters, and complex real-world scenarios.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for edge value scenarios.
     *
     * @phpstan-return array<string, array{mixed[], mixed[]|string|null, mixed[], string}>
     */
    public static function edgeValues(): array
    {
        return [
            'very long class name' => [
                [],
                'very-long-class-name-with-many-hyphens-and-segments',
                ['class' => 'very-long-class-name-with-many-hyphens-and-segments'],
                'Should handle very long class names.',
            ],
            'many classes at once' => [
                [],
                [
                    'class-1', 'class-2', 'class-3', 'class-4', 'class-5',
                    'class-6', 'class-7', 'class-8', 'class-9', 'class-10',
                ],
                [
                    'class' => 'class-1 class-2 class-3 class-4 class-5 class-6 class-7 class-8 class-9 class-10',
                ],
                'Should handle adding many classes at once.',
            ],
            'classes with unicode characters in square brackets' => [
                [],
                'content-[\'★\'] before:[content:\'→\']',
                ['class' => 'content-[\'★\'] before:[content:\'→\']'],
                'Should handle classes with unicode characters in square brackets.',
            ],
            'complex real-world scenario' => [
                ['id' => 'alert-box', 'role' => 'alert'],
                [
                    'p-4',
                    'mb-4',
                    'text-sm',
                    AlertType::WARNING,
                    'rounded-lg',
                    'border',
                    'border-yellow-300',
                    'bg-yellow-50',
                    'dark:bg-gray-800',
                    'dark:text-yellow-400',
                    'dark:border-yellow-800',
                ],
                [
                    'id' => 'alert-box',
                    'role' => 'alert',
                    'class' => 'p-4 mb-4 text-sm warning rounded-lg border border-yellow-300 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400 dark:border-yellow-800',
                ],
                'Should handle complex real-world scenario with Tailwind-style classes and enum.',
            ],
        ];
    }

    /**
     * Provides test cases for empty and `null` value handling in class manipulation.
     *
     * Supplies comprehensive test data for validating the handling of empty arrays, empty strings, `null` values, and
     * combinations thereof when adding class values.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for empty/`null` scenarios.
     *
     * @phpstan-return array<string, array{mixed[], mixed[]|string|null, mixed[], string}>
     */
    public static function emptyAndNullValues(): array
    {
        return [
            'empty array' => [
                [],
                [],
                [],
                'Should remain empty when adding an empty array.',
            ],
            'empty string' => [
                [],
                '',
                [],
                'Should remain empty when adding empty string.',
            ],
            'null' => [
                [],
                null,
                [],
                "Should remain empty when adding 'null'.",
            ],
            'array with empty string' => [
                [],
                [''],
                [],
                'Should remain empty when adding array with empty string.',
            ],
            'array with null' => [
                [],
                [null],
                [],
                "Should remain empty when adding array with 'null'.",
            ],
            'array with multiple empty strings' => [
                [],
                ['', '', ''],
                [],
                'Should remain empty when adding array with multiple empty strings.',
            ],
            'array with mixed null and empty strings' => [
                [],
                [null, '', null, ''],
                [],
                "Should remain empty when adding array with mixed 'null' and empty strings.",
            ],
        ];
    }

    /**
     * Provides test cases for enum value handling in class manipulation.
     *
     * Supplies comprehensive test data for validating the addition and merging of enum values as CSS classes, including
     * scenarios with single enums, arrays of enums, mixed enums and strings, and filtering of invalid enum types.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for enum class scenarios.
     *
     * @phpstan-return array<string, array{mixed[], array<string|null|UnitEnum>|UnitEnum, mixed[], string}>
     */
    public static function enumValues(): array
    {
        return [
            'add single enum to empty attributes' => [
                [],
                AlertType::SUCCESS,
                ['class' => 'success'],
                'Should add single enum value as class.',
            ],
            'add array with single enum' => [
                [],
                [AlertType::SUCCESS],
                ['class' => 'success'],
                'Should add single enum from array.',
            ],
            'add array with multiple enums' => [
                [],
                [AlertType::SUCCESS, AlertType::WARNING, ButtonSize::LARGE],
                ['class' => 'success warning lg'],
                'Should add multiple enum values as classes.',
            ],
            'add enum to existing classes' => [
                ['class' => 'class-one class-two'],
                AlertType::SUCCESS,
                ['class' => 'class-one class-two success'],
                'Should append enum value to existing classes.',
            ],
            'add array with mixed enums and strings' => [
                [],
                [AlertType::SUCCESS, 'custom-class', ButtonSize::MEDIUM, 'another-class'],
                ['class' => 'success custom-class md another-class'],
                'Should add mixed enum and string values as classes.',
            ],
            'add array with mixed enums, strings, and nulls' => [
                ['class' => 'existing'],
                [AlertType::WARNING, null, 'custom', '', ButtonSize::SMALL],
                ['class' => 'existing warning custom sm'],
                'Should add valid enum and string values while filtering nulls and empty strings.',
            ],
            'add enum with int value (should be ignored)' => [
                ['class' => 'class-one'],
                Priority::HIGH,
                ['class' => 'class-one'],
                'Should ignore enum with int value (CSS classes must be strings).',
            ],
            'add array with enum that returns int' => [
                ['class' => 'existing'],
                [AlertType::SUCCESS, Priority::HIGH, ButtonSize::MEDIUM],
                ['class' => 'existing success md'],
                'Should add only enums with string values and ignore int-valued enum.',
            ],
            'add duplicate enum to existing enum class' => [
                ['class' => 'success'],
                AlertType::SUCCESS,
                ['class' => 'success'],
                'Should not duplicate enum value when it already exists.',
            ],
        ];
    }

    /**
     * Provides test cases for merging with existing class attributes as arrays.
     *
     * Supplies comprehensive test data for validating the merging of new class values with existing class attributes
     * represented as arrays, including duplicate handling and preservation of existing values.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for merging with class arrays.
     *
     * @phpstan-return array<string, array{mixed[], mixed[]|string, mixed[], string}>
     */
    public static function existingAttributesClassArrayValues(): array
    {
        return [
            'existing class as array' => [
                ['class' => ['class-one', 'class-two']],
                'class-three',
                ['class' => 'class-one class-two class-three'],
                'Should handle existing class attribute as array and merge with new class.',
            ],
            'array to existing class as array' => [
                ['class' => ['class-one', 'class-two']],
                ['class-three', 'class-four'],
                ['class' => 'class-one class-two class-three class-four'],
                'Should merge array of new classes with existing class array.',
            ],
            'existing class as array with duplicates' => [
                ['class' => ['class-one', 'class-two']],
                ['class-two', 'class-three'],
                ['class' => 'class-one class-two class-three'],
                'Should not duplicate when merging with existing class array.',
            ],
        ];
    }

    /**
     * Provides test cases for merging with existing class attributes as enums.
     *
     * Supplies comprehensive test data for validating the merging of new class values with existing class attributes
     * represented as enums, including array and enum merging scenarios.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for merging with class enums.
     *
     * @phpstan-return array<string, array{mixed[], mixed[]|string|UnitEnum, mixed[], string}>
     */
    public static function existingAttributesClassEnumValues(): array
    {
        return [
            'existing class as enum' => [
                ['class' => AlertType::SUCCESS],
                'new-class',
                ['class' => 'success new-class'],
                'Should handle existing class attribute as enum and merge with new class.',
            ],
            'enum to existing class as enum' => [
                ['class' => AlertType::SUCCESS],
                ButtonSize::LARGE,
                ['class' => 'success lg'],
                'Should merge new enum with existing enum class.',
            ],
            'array to existing class as enum' => [
                ['class' => AlertType::WARNING],
                ['custom-class', 'another-class'],
                ['class' => 'warning custom-class another-class'],
                'Should merge array of classes with existing enum class.',
            ],
        ];
    }

    /**
     * Provides test cases for merging with existing attributes containing class and other attributes.
     *
     * Supplies comprehensive test data for validating the addition and merging of class values while preserving other
     * unrelated attributes.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for merging with other attributes.
     *
     * @phpstan-return array<string, array{mixed[], string, mixed[], string}>
     */
    public static function existingAttributesValues(): array
    {
        return [
            'class to attributes with other attributes' => [
                ['id' => 'main', 'data-value' => '123'],
                'new-class',
                ['id' => 'main', 'data-value' => '123', 'class' => 'new-class'],
                'Should add class attribute while preserving other attributes.',
            ],
            'class to existing class with other attributes' => [
                ['id' => 'main', 'class' => 'existing', 'data-value' => '123'],
                'new-class',
                ['id' => 'main', 'class' => 'existing new-class', 'data-value' => '123'],
                'Should append to existing class while preserving other attributes.',
            ],
        ];
    }

    /**
     * Provides test cases for class value override scenarios.
     *
     * Supplies comprehensive test data for validating the override behavior when adding new class values, including
     * scenarios with empty, `null`, array, enum, and mixed values, as well as preservation of other attributes.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, an assertion message,
     * and a boolean indicating whether the override should occur.
     *
     * @return array Test data for override scenarios.
     *
     * @phpstan-return array<string, array{mixed[], mixed[]|string|null|UnitEnum, mixed[], string, bool}>
     */
    public static function overrideValues(): array
    {
        return [
            'empty attributes with string' => [
                [],
                'new-class',
                ['class' => 'new-class'],
                'Should add class to empty attributes when override is true.',
                true,
            ],
            'existing class with string' => [
                ['class' => 'old-class'],
                'new-class',
                ['class' => 'new-class'],
                'Should completely replace existing class when override is true.',
                true,
            ],
            'existing classes with multiple classes' => [
                ['class' => 'old-one old-two old-three'],
                'new-one new-two',
                ['class' => 'new-one new-two'],
                'Should replace all existing classes with new classes when override is true.',
                true,
            ],
            'array of classes' => [
                ['class' => 'old-class'],
                ['new-one', 'new-two', 'new-three'],
                ['class' => 'new-one new-two new-three'],
                'Should replace existing class with array of new classes when override is true.',
                true,
            ],
            'enum' => [
                ['class' => 'old-class'],
                AlertType::ERROR,
                ['class' => 'error'],
                'Should replace existing class with enum value when override is true.',
                true,
            ],
            'mixed array' => [
                ['class' => 'old-class'],
                [AlertType::SUCCESS, 'custom', ButtonSize::SMALL],
                ['class' => 'success custom sm'],
                'Should replace existing class with mixed enum and string values when override is true.',
                true,
            ],
            'preserves other attributes' => [
                ['id' => 'main', 'class' => 'old-class', 'data-value' => '123'],
                'new-class',
                ['id' => 'main', 'class' => 'new-class', 'data-value' => '123'],
                'Should replace class but preserve other attributes when override is true.',
                true,
            ],
            'empty should not add class' => [
                ['class' => 'existing-class'],
                '',
                ['class' => 'existing-class'],
                'Should not modify class when overriding with empty string.',
                true,
            ],
            'null should not add class' => [
                ['class' => 'existing-class'],
                null,
                ['class' => 'existing-class'],
                'Should not modify class when overriding with null.',
                true,
            ],
            'empty array should not add class' => [
                ['class' => 'existing-class'],
                [],
                ['class' => 'existing-class'],
                'Should not modify class when overriding with empty array.',
                true,
            ],
            'enum that returns int should not modify class' => [
                ['class' => 'existing-class'],
                Priority::HIGH,
                ['class' => 'existing-class'],
                'Should not modify class when overriding with enum that has int value.',
                true,
            ],
        ];
    }

    /**
     * Provides test cases for regex edge cases in class value parsing.
     *
     * Supplies comprehensive test data for validating the handling of whitespace, long strings, and normalization of
     * class values using regular expressions.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for regex edge cases.
     *
     * @phpstan-return array<string, array{mixed[], string, mixed[], string}>
     */
    public static function regexEdgeCases(): array
    {
        return [
            'extremely long string with unique classes' => [
                [],
                implode(' ', array_map(static fn($i): string => "class-{$i}", range(1, 100))),
                ['class' => implode(' ', array_map(static fn($i): string => "class-{$i}", range(1, 100)))],
                'Should handle extremely long strings with many unique classes.',
            ],
            'extremely long whitespace sequence' => [
                [],
                str_repeat(' ', 10000),
                [],
                'Should handle extremely long whitespace sequence without errors.',
            ],
            'mixed whitespace types' => [
                [],
                "  \t  \n  \r  \v  \f  ",
                [],
                'Should handle all types of whitespace characters.',
            ],
            'string with multiple consecutive spaces' => [
                [],
                'class-one     class-two          class-three',
                ['class' => 'class-one class-two class-three'],
                'Should normalize multiple consecutive spaces between classes.',
            ],
            'string with only whitespace characters' => [
                [],
                "   \t\n\r   ",
                [],
                'Should return empty array for string with only whitespace characters.',
            ],
            'token containing angle brackets' => [
                [],
                'bad<class>',
                [],
                'Should drop tokens containing < or >.',
            ],
            'token containing at-sign' => [
                [],
                'bad@class',
                [],
                'Should drop tokens containing @.',
            ],
            'token containing exclamation' => [
                [],
                'bad!class',
                [],
                'Should drop tokens containing !.',
            ],
        ];
    }

    /**
     * Provides test cases for adding single string class values.
     *
     * Supplies comprehensive test data for validating the addition of single or multiple string class values, including
     * trimming, normalization, and handling of whitespace and separators.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for single string class scenarios.
     *
     * @phpstan-return array<string, array{mixed[], string, mixed[], string}>
     */
    public static function singleStringValue(): array
    {
        return [
            'single class' => [
                [],
                'class-one',
                ['class' => 'class-one'],
                'Should add a single class to empty attributes.',
            ],
            'single class with spaces' => [
                [],
                '  class-one  ',
                ['class' => 'class-one'],
                'Should trim spaces and add single class.',
            ],
            'multiple classes in single string' => [
                [],
                'class-one class-two class-three',
                ['class' => 'class-one class-two class-three'],
                'Should add multiple space-separated classes from single string.',
            ],
            'classes with multiple spaces between them' => [
                [],
                'class-one    class-two     class-three',
                ['class' => 'class-one class-two class-three'],
                'Should normalize multiple spaces between classes.',
            ],
            'classes with tabs and newlines' => [
                [],
                "class-one\tclass-two\nclass-three",
                ['class' => 'class-one class-two class-three'],
                'Should handle tabs and newlines as separators.',
            ],
        ];
    }

    /**
     * Provides test cases for special character class values.
     *
     * Supplies comprehensive test data for validating the addition of class values containing hyphens, underscores,
     * colons, dots, and other special characters.
     *
     * Each test case includes the initial class array, the value(s) to add, the expected result, and an assertion
     * message for clear failure identification.
     *
     * @return array Test data for special character class scenarios.
     *
     * @phpstan-return array<string, array{mixed[], string, mixed[], string}>
     */
    public static function specialValues(): array
    {
        return [
            'classes with hyphens' => [
                [],
                'btn-primary btn-lg text-center',
                ['class' => 'btn-primary btn-lg text-center'],
                'Should add classes with hyphens (kebab-case).',
            ],
            'classes with underscores' => [
                [],
                'class_name _private another_class',
                ['class' => 'class_name _private another_class'],
                'Should add classes with underscores.',
            ],
            'classes with colons (pseudo-class modifiers)' => [
                [],
                'hover:bg-blue-500 focus:ring-2 lg:text-xl',
                ['class' => 'hover:bg-blue-500 focus:ring-2 lg:text-xl'],
                'Should add classes with colons for pseudo-class modifiers.',
            ],
            'classes with dots' => [
                [],
                'utility.class namespace.component',
                ['class' => 'utility.class namespace.component'],
                'Should add classes with dots.',
            ],
            'classes with square brackets (arbitrary values)' => [
                [],
                'w-[200px] bg-[#1da1f2] p-[2rem]',
                ['class' => 'w-[200px] bg-[#1da1f2] p-[2rem]'],
                'Should add classes with square brackets for arbitrary values.',
            ],
            'classes with numbers' => [
                [],
                'col-12 grid-3 z-50',
                ['class' => 'col-12 grid-3 z-50'],
                'Should add classes with numbers.',
            ],
            'classes starting with hyphens' => [
                [],
                '-mt-4 -ml-2 --custom-var',
                ['class' => '-mt-4 -ml-2 --custom-var'],
                'Should add classes starting with hyphens.',
            ],
            'complex modern CSS classes' => [
                [],
                'sm:hover:bg-blue-500 md:focus:ring-[3px] lg:w-[calc(100%-2rem)]',
                ['class' => 'sm:hover:bg-blue-500 md:focus:ring-[3px] lg:w-[calc(100%-2rem)]'],
                'Should add complex modern CSS framework classes.',
            ],
        ];
    }
}
