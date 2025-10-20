<?php

declare(strict_types=1);

namespace yii\ui\tests\providers;

use yii\ui\tests\support\stub\enum\{ButtonSize, Columns, Theme};

/**
 * Data provider for {@see \yii\ui\tests\helpers\AttributesTest} class.
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
 * - Edge case validation for empty, `null`, and special character values.
 * - Enum integration in class, data, and style attributes.
 * - Named test data sets for clear failure identification.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class AttributesProvider
{
    /**
     * Provides test cases for attribute ordering scenarios.
     *
     * Supplies test data for validating the consistent ordering of HTML attributes when rendered.
     *
     * @return array<string, array{string, array<string, mixed>}> Test data for attribute ordering scenarios.
     *
     * @phpstan-return array<string, array{string, array<string, mixed>}>
     */
    public static function attributeOrdering(): array
    {
        return [
            'multiple attributes in order' => [
                ' class="class" id="id" name="name" height="height" data-tests="data-tests"',
                [
                    'id' => 'id',
                    'class' => 'class',
                    'data-tests' => 'data-tests',
                    'name' => 'name',
                    'height' => 'height',
                ],
            ],
        ];
    }

    /**
     * Provides test cases for empty and `null` value handling.
     *
     * Supplies test data for validating how the attribute renderer handles empty strings, `null` values, empty arrays,
     * and invalid attribute names.
     *
     * @return array<string, array{string, array<string, mixed>}> Test data for empty/`null` scenarios.
     *
     * @phpstan-return array<string, array{string, array<string, mixed>}>
     */
    public static function emptyAndNullValues(): array
    {
        return [
            'empty attribute name' => [
                '',
                ['' => 'value'],
            ],
            'empty attribute value' => [
                '',
                ['empty' => ''],
            ],
            'empty class array' => [
                '',
                ['class' => []],
            ],
            'invalid attribute name' => [
                ' valid="ok"',
                [
                    'valid' => 'ok',
                    '123-invalid' => 'bad',
                ],
            ],
            'null attribute value' => [
                '',
                ['null' => null],
            ],
        ];
    }

    /**
     * Provides test cases for enum attribute scenarios.
     *
     * Supplies test data for validating HTML attribute rendering with PHP enum values, including integration in class,
     * data, style, and numeric attributes.
     *
     * @return array<string, array{string, array<string, mixed>}> Test data for enum attribute scenarios.
     *
     * @phpstan-return array<string, array{string, array<string, mixed>}>
     */
    public static function enumAttribute(): array
    {
        return [
            'enum in class array' => [
                ' class="btn md"',
                [
                    'class' => [
                        'btn',
                        ButtonSize::MEDIUM,
                    ],
                ],
            ],
            'enum in data attribute' => [
                ' data-theme="dark"',
                ['data' => ['theme' => Theme::DARK]],
            ],
            'enum in style' => [
                ' style="width: lg;"',
                ['style' => ['width' => ButtonSize::LARGE]],
            ],
            'mixed values' => [
                ' class="sm primary" data-theme="light"',
                [
                    'class' => [
                        ButtonSize::SMALL,
                        'primary',
                    ],
                    'data' => ['theme' => Theme::LIGHT],
                ],
            ],
            'nested enum' => [
                ' class="sm primary" data-theme="light"',
                [
                    'class' => [
                        ButtonSize::SMALL,
                        'primary',
                    ],
                    'data' => ['theme' => Theme::LIGHT],
                ],
            ],
            'numeric enum' => [
                ' cols="2"',
                ['cols' => Columns::TWO],
            ],
            'single enum' => [
                ' type="sm"',
                ['type' => ButtonSize::SMALL],
            ],
        ];
    }

    /**
     * Provides test cases for malicious value handling and XSS prevention.
     *
     * Supplies test data for validating security measures in HTML attribute rendering including XSS attack prevention,
     * script injection blocking, and special character encoding.
     *
     * @return array<string, array{string, array<string, mixed>}> Test data for security scenarios.
     *
     * @phpstan-return array<string, array{string, array<string, mixed>}>
     */
    public static function maliciousValues(): array
    {
        return [
            'malicious class value with XSS' => [
                ' class="safe &lt;svg/onload=alert()&gt;"',
                [
                    'class' => [
                        'safe',
                        '<svg/onload=alert()>',
                    ],
                ],
            ],
            'malicious data attribute key' => [
                '',
                ['data' => ['key" onclick="alert(1)"' => 'value']],
            ],
            'nested array with script tag' => [
                ' data-key=\'{"sub":"\u0026lt;script\u0026gt;"}\'',
                ['data' => ['key' => ['sub' => '<script>']]],
            ],
        ];
    }

    /**
     * Provides test cases for HTML attribute rendering scenarios.
     *
     * Supplies comprehensive test data for validating HTML attribute expansion, boolean and enum handling, and edge
     * case processing.
     *
     * @return array<string, array{string, array<string, mixed>}> Test data for attribute rendering scenarios.
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
                    'class' => [
                        'first',
                        'second',
                    ],
                ],
            ],
            'data attributes with array and scalar' => [
                ' data-a="0" data-b=\'[1,2]\' data-d="99.99" any="42"',
                [
                    'class' => [],
                    'style' => [],
                    'data' => [
                        'a' => 0,
                        'b' => [1, 2],
                        'c' => null,
                        'd' => 99.99,
                    ],
                    'any' => 42,
                ],
            ],
            'data attribute with empty array' => [
                ' data-foo=\'[]\'',
                ['data' => ['foo' => []]],
            ],
            'float attribute value' => [
                ' width="99.99"',
                ['width' => 99.99],
            ],
            'integer attribute value' => [
                ' height="100"',
                ['height' => 100],
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
        ];
    }

    /**
     * Provides test cases for style attribute rendering scenarios.
     *
     * Supplies test data for validating style attribute handling with various value types including arrays, booleans,
     * nested structures, null values, and special characters.
     *
     * @return array<string, array{string, array<string, mixed>}> Test data for style attribute scenarios.
     *
     * @phpstan-return array<string, array{string, array<string, mixed>}>
     */
    public static function styleAttributes(): array
    {
        return [
            'style array with scalar values' => [
                ' style="width: 100px; height: 200px;"',
                [
                    'style' => [
                        'width' => '100px',
                        'height' => '200px',
                    ],
                ],
            ],
            'style with array value' => [
                ' style="complex-property: ["value1","value2"];"',
                [
                    'style' => [
                        'complex-property' => [
                            'value1',
                            'value2',
                        ],
                    ],
                ],
            ],
            'style with boolean value' => [
                ' style="flag: true;"',
                ['style' => ['flag' => true]],
            ],
            'style with float value' => [
                ' style="opacity: 0.5; font-size: 1.5;"',
                [
                    'style' => [
                        'opacity' => 0.5,
                        'font-size' => 1.5,
                    ],
                ],
            ],
            'style with nested array value' => [
                ' style="config: {"nested":{"key":"value"}};"',
                [
                    'style' => [
                        'config' => [
                            'nested' => [
                                'key' => 'value',
                            ],
                        ],
                    ],
                ],
            ],
            'style with null value' => [
                '',
                ['style' => ['nullable' => null]],
            ],
            'style with special characters' => [
                ' style="font-family: Times &amp; Serif;"',
                ['style' => ['font-family' => 'Times & Serif']],
            ],
        ];
    }
}
