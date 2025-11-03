<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\helpers\CSSClass;
use yii\ui\helpers\exception\Message;
use yii\ui\tests\providers\CSSClassProvider;
use yii\ui\tests\support\stub\enum\AlertType;

/**
 * Test suite for {@see CSSClass} class functionality and behavior.
 *
 * Verifies CSS class attribute manipulation capabilities including class addition, merging, validation, enum handling,
 * and string/array conversion for HTML attribute rendering.
 *
 * These tests ensure that CSS class handling features work correctly under various scenarios and maintain consistent
 * behavior after code changes.
 *
 * The tests validate scenarios such as array and enum class handling class name validation, merge operations, override
 * behavior, and string formatting, which are essential for generating valid and maintainable HTML output in the
 * framework.
 *
 * Test coverage includes.
 * - Addition and merging of CSS classes from strings, arrays, enums, and mixed types.
 * - Deduplication and normalization of class names, including whitespace and special character handling.
 * - Edge cases: long class names, unicode, special characters, and complex real-world scenarios
 *   (for example, Tailwind CSS).
 * - Enum integration (including BackedEnum and filtering of non-string enums).
 * - Exception handling for invalid class values and enums not in allowed lists.
 * - Formatting and rendering of class strings, including value substitution and validation.
 * - Handling of empty, `null`, and invalid values, with preservation of unrelated attributes.
 * - Override logic for replacing existing class attributes.
 *
 * {@see CSSClassProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
final class CSSClassTest extends TestCase
{
    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[]|string|null $classes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'arrayOfStringsValues')]
    public function testAddWithArrayOfStringsValue(
        array $attributes,
        array|string|null $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[]|string|null $classes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'duplicateValues')]
    public function testAddWithDuplicateValues(
        array $attributes,
        array|string|null $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[]|string|null $classes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'edgeValues')]
    public function testAddWithEdgeValues(
        array $attributes,
        array|string|null $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[]|string|null $classes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'emptyAndNullValues')]
    public function testAddWithEmptyAndNullValue(
        array $attributes,
        array|string|null $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     * @phpstan-param mixed[] $attributes
     * @phpstan-param array<string|null|UnitEnum>|UnitEnum $classes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'enumValues')]
    public function testAddWithEnumValues(
        array $attributes,
        array|UnitEnum $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[]|string $classes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'existingAttributesClassArrayValues')]
    public function testAddWithExistingAttributesClassArrayValues(
        array $attributes,
        array|string $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[]|string|UnitEnum $classes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'existingAttributesClassEnumValues')]
    public function testAddWithExistingAttributesClassEnumValues(
        array $attributes,
        array|string|UnitEnum $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'existingAttributesValues')]
    public function testAddWithExistingAttributesValues(
        array $attributes,
        string $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[]|string|null|UnitEnum $classes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'overrideValues')]
    public function testAddWithOverrideValues(
        array $attributes,
        string|array|UnitEnum|null $classes,
        array $expected,
        string $message,
        bool $override,
    ): void {
        CSSClass::add($attributes, $classes, $override);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'regexEdgeCases')]
    public function testAddWithRegexEdgeCases(
        array $attributes,
        string $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'singleStringValue')]
    public function testAddWithSingleStringValue(
        array $attributes,
        string $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'specialValues')]
    public function testAddWithSpecialValues(
        array $attributes,
        string $classes,
        array $expected,
        string $message,
    ): void {
        CSSClass::add($attributes, $classes);

        self::assertSame($expected, $attributes, $message);
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     */
    public function testRenderClassString(): void
    {
        self::assertSame(
            'p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400',
            CSSClass::render(
                'yellow',
                'p-4 mb-4 text-sm text-%1$s-800 rounded-lg bg-%1$s-50 dark:bg-gray-800 dark:text-%1$s-400',
                ['blue', 'gray', 'green', 'red', 'yellow'],
            ),
            'Should render class string with correct value substitution.',
        );
    }

    /**
     * @throws InvalidArgumentException for invalid value errors.
     */
    public function testRenderWithEnum(): void
    {
        self::assertSame(
            'alert alert-success',
            CSSClass::render(AlertType::SUCCESS, 'alert alert-%s', ['success', 'warning', 'error']),
            'Should render class string using enum value.',
        );
    }

    public function testThrowExceptionForInvalidClassValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'indigo',
                'class',
                implode('\', \'', ['blue', 'gray', 'green', 'red', 'yellow']),
            ),
        );

        CSSClass::render(
            'indigo',
            'p-4 mb-4 text-sm text-%1$s-800 rounded-lg bg-%1$s-50 dark:bg-gray-800 dark:text-%1$s-400',
            ['blue', 'gray', 'green', 'red', 'yellow'],
        );
    }

    public function testThrowExceptionForInvalidEnum(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage('info', 'class', implode('\', \'', ['success', 'warning', 'error'])),
        );

        CSSClass::render(AlertType::INFO, 'alert alert-%s', ['success', 'warning', 'error']);
    }
}
