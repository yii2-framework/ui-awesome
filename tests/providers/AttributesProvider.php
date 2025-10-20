<?php

declare(strict_types=1);

namespace yii\ui\tests\providers;

use yii\ui\tests\support\stub\enum\{ButtonSize, Columns, Theme};

/**
 * Data provider for {@see \PHPPress\Tests\Html\Helper\AttributesTest} class.
 *
 * Designed to ensure HTML attribute rendering logic correctly processes all supported attribute types and edge cases,
 * providing comprehensive test data for attribute expansion, enum handling, and special value scenarios.
 *
 * The test data covers real-world HTML attribute rendering scenarios and edge cases to maintain consistent output
 * across different attribute configurations, ensuring HTML tags are rendered securely and predictably throughout the
 * application.
 *
 * The provider organizes test cases with descriptive names for quick identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features.
 * - Attribute expansion for data, aria, and custom prefixes.
 * - Comprehensive test cases for array, boolean, enum, and special attribute handling.
 * - Edge case validation for empty, null, and special character values.
 * - Enum integration in class, data, and style attributes.
 * - Named test data sets for clear failure identification.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class AttributesProvider
{
    /**
     * Data provider for enum attribute rendering scenarios.
     *
     * Tests attribute rendering with enum values in various contexts.
     * - Enum in a class array.
     * - Enum in data attribute.
     * - Enum in style attribute.
     * - Mixed enum and string values.
     * - Nested enum usage.
     * - Numeric enum values.
     * - Single enum as attribute value.
     *
     * Each test case provides the expected rendered attribute string and the input attribute array.
     *
     * {@see \PHPPress\Tests\Html\Helper\AttributesTest::testRenderEnumAttributesFromProvider()} for the test case using
     * this data.
     *
     * @return array<string, array{string, array<string, mixed>}>
     *
     * @phpstan-return array<string, array{string, array<string, mixed>}>
     */
    public static function enumAttribute(): array
    {
        return [
            'enum in class array' => [
                ' class="btn md"',
                [
                    'class' => ['btn', ButtonSize::MEDIUM],
                ],
            ],
            'enum in data attribute' => [
                ' data-theme="dark"',
                [
                    'data' => ['theme' => Theme::DARK],
                ],
            ],
            'enum in style' => [
                ' style="width: lg;"',
                [
                    'style' => ['width' => ButtonSize::LARGE],
                ],
            ],
            'mixed values' => [
                ' class="sm primary" data-theme="light"',
                [
                    'class' => [ButtonSize::SMALL, 'primary'],
                    'data' => ['theme' => Theme::LIGHT],
                ],
            ],
            'nested enum' => [
                ' class="sm primary" data-theme="light"',
                [
                    'class' => [ButtonSize::SMALL, 'primary'],
                    'data' => ['theme' => Theme::LIGHT],
                ],
            ],
            'numeric enum' => [
                ' cols="2"',
                [
                    'cols' => Columns::TWO,
                ],
            ],
            'single enum' => [
                ' type="sm"',
                [
                    'type' => ButtonSize::SMALL,
                ],
            ],
        ];
    }

    /**
     * Data provider for general HTML attribute rendering scenarios.
     *
     * Tests attribute rendering with various value types and structures.
     * - Array attributes (`class`, `style`, `data`, etc.).
     * - Attribute prefix expansion (`data-`, `aria-`, `ng-`, etc.).
     * - Boolean attributes.
     * - Edge cases for `null`, empty, and invalid keys.
     * - Numeric and string value handling.
     * - Special character and empty value handling.
     *
     * Each test case provides the expected rendered attribute string and the input attribute array.
     *
     * {@see \PHPPress\Tests\Html\Helper\AttributesTest::testRenderVariousAttributesFromProvider()} for the test case
     * using this data.
     *
     * @return array<string, array{string, array<string, mixed>}>
     *
     * @phpstan-return array<string, array{string, array<string, mixed>}>
     */
    public static function renderTagAttributes(): array
    {
        return [
            'boolean attributes' => [
                ' checked disabled required="yes"',
                [
                    'checked' => true,
                    'disabled' => true,
                    'hidden' => false,
                    'required' => 'yes',
                ],
            ],
            'class array' => [
                ' class="first second"',
                [
                    'class' => ['first', 'second'],
                ],
            ],
            'data attributes with array and scalar' => [
                ' data-a="0" data-b=\'[1,2]\' any="42"',
                [
                    'class' => [],
                    'style' => [],
                    'data' => ['a' => 0, 'b' => [1, 2]],
                    'any' => 42,
                ],
            ],
            'data attribute with empty array' => [
                ' data-foo=\'[]\'',
                [
                    'data' => ['foo' => []],
                ],
            ],
            'empty class array' => [
                '',
                [
                    'class' => [],
                ],
            ],
            'empty key' => [
                '',
                [
                    '' => 'test-class',
                ],
            ],
            'empty string value' => [
                '',
                [
                    'value' => '',
                ],
            ],
            'mixed attributes with arrays' => [
                ' class="a b" id="x" data-a="1" data-b="2" style="width: 100px;" any=\'[1,2]\'',
                [
                    'id' => 'x',
                    'class' => ['a', 'b'],
                    'data' => ['a' => 1, 'b' => 2],
                    'style' => ['width' => '100px'],
                    'any' => [1, 2],
                ],
            ],
            'null attribute value' => [
                '',
                [
                    'disabled' => null,
                ],
            ],
            'numeric and string attributes' => [
                ' name="position" value="42"',
                [
                    'value' => 42,
                    'name' => 'position',
                ],
            ],
            'src and aria attributes' => [
                ' src="xyz" aria-a="1" aria-b="c"',
                [
                    'src' => 'xyz',
                    'aria' => ['a' => 1, 'b' => 'c'],
                ],
            ],
            'src and data attributes' => [
                ' src="xyz" data-a="1" data-b="c"',
                [
                    'src' => 'xyz',
                    'data' => ['a' => 1, 'b' => 'c'],
                ],
            ],
            'src and data-ng attributes' => [
                ' src="xyz" data-ng-a="1" data-ng-b="c"',
                [
                    'src' => 'xyz',
                    'data-ng' => ['a' => 1, 'b' => 'c'],
                ],
            ],
            'src and ng attributes' => [
                ' src="xyz" ng-a="1" ng-b="c"',
                [
                    'src' => 'xyz',
                    'ng' => ['a' => 1, 'b' => 'c'],
                ],
            ],
            'style array' => [
                ' style="width: 100px; height: 200px;"',
                [
                    'style' => ['width' => '100px', 'height' => '200px'],
                ],
            ],
        ];
    }
}
