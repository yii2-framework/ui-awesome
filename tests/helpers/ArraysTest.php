<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\helpers\Arrays;
use yii\ui\helpers\exception\Message;
use yii\ui\tests\providers\ArraysProvider;
use yii\ui\tests\support\stub\enum\{Priority, Status, Theme};

use function implode;

/**
 * Test suite for {@see Arrays} utility class functionality and behavior.
 *
 * Verifies the array utility component's ability to validate list membership, detect associative and list arrays,
 * handle enum values, and manage invalid arguments with exception-driven error handling.
 *
 * These tests ensure array validation features work correctly under different conditions and maintain consistent
 * behavior after code changes.
 *
 * The tests validate strict value checking, exception propagation, correct detection of array types, and support for
 * both BackedEnum and UnitEnum values in list membership checks, which are essential for robust array processing and
 * defensive programming in the framework.
 *
 * Test coverage.
 * - BackedEnum and UnitEnum value support in inList checks.
 * - Detection of associative and list arrays using data providers.
 * - Exception handling for empty or invalid values.
 * - Type safety and strict comparison.
 * - Value membership validation with and without exceptions.
 *
 * {@see ArraysProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('helpers')]
final class ArraysTest extends TestCase
{
    /**
     * @phpstan-param array<array-key, int|string> $array
     */
    #[DataProviderExternal(ArraysProvider::class, 'isAssociative')]
    public function testDetectAssociativeArrayWithProvider(array $array, bool $expected): void
    {
        self::assertSame(
            $expected,
            Arrays::isAssociative($array),
            'Should return ' . ($expected ? '\'true\'' : '\'false\'') . ' for input array ' .
            json_encode($array, JSON_THROW_ON_ERROR) . '.',
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testInListWithCaseSensitiveEnumValue(): void
    {
        self::assertFalse(
            Arrays::inList('attribute', 'ACTIVE', [Status::ACTIVE, Status::INACTIVE]),
            "Should return 'false' when 'ACTIVE' (uppercase) is compared against 'Status::cases()' with 'active' " .
            '(lowercase).',
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testInListWithEmptyValue(): void
    {
        self::assertFalse(
            Arrays::inList('attribute', '', ['a', 'b', 'c']),
            "Should return 'false' when the value is empty and not in the allowed list ['a', 'b', 'c'].",
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testInListWithInvalidEnumComparisonAndThrowArgumentIsFalse(): void
    {
        self::assertFalse(
            Arrays::inList('attribute', Status::ACTIVE, Theme::cases()),
            "Should return 'false' when 'Status::ACTIVE' is compared against 'Theme::cases()'.",
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testInListWithMixedEnumTypesInAllowedList(): void
    {
        $mixedAllowed = [Status::ACTIVE, Theme::DARK, Priority::LOW];

        self::assertTrue(
            Arrays::inList('attribute', Status::ACTIVE, $mixedAllowed),
            "Should return 'true' when 'Status::ACTIVE' is in a mixed enum list.",
        );
        self::assertTrue(
            Arrays::inList('attribute', 'DARK', $mixedAllowed),
            "Should return 'true' when 'DARK' is in a mixed enum list.",
        );
        self::assertTrue(
            Arrays::inList('attribute', 1, $mixedAllowed),
            "Should return 'true' when '1' ('Priority::LOW') is in a mixed enum list.",
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testInListWithThrowArgumentIsTrue(): void
    {
        self::assertTrue(
            Arrays::inList('attribute', 'c', ['a', 'b', 'c'], true),
            "Should return 'true' when 'c' is in the allowed list ['a', 'b', 'c'] and exception is enabled.",
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testReturnFalseWhenValueNotInList(): void
    {
        self::assertFalse(
            Arrays::inList('attribute', '1', ['a', 'b', 'c']),
            "Should return 'false' when '1' is not in the allowed list ['a', 'b', 'c'].",
        );
    }

    /**
     * @phpstan-param array<array-key, int|string> $array
     */
    #[DataProviderExternal(ArraysProvider::class, 'isList')]
    public function testReturnIsListWhenArrayIsListOrNot(array $array, bool $expected): void
    {
        self::assertSame(
            $expected,
            Arrays::isList($array),
            'Should return ' . ($expected ? '\'true\'' : '\'false\'') . ' for input array ' .
            json_encode($array, JSON_THROW_ON_ERROR) . '.',
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testReturnTrueWhenBackedEnumValueIsInList(): void
    {
        self::assertTrue(
            Arrays::inList('attribute', Status::ACTIVE, Status::cases()),
            "Should return 'true' when 'active' is in the allowed list ['active', 'inactive'].",
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testReturnTrueWhenUnitEnumValueIsInList(): void
    {
        self::assertTrue(
            Arrays::inList('attribute', Theme::DARK, Theme::cases()),
            "Should return 'true' when 'DARK' is in the allowed list ['DARK', 'LIGHT'].",
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
    public function testReturnTrueWhenValueIsInList(): void
    {
        self::assertTrue(
            Arrays::inList('attribute', 'a', ['a', 'b', 'c']),
            "Should return 'true' when 'a' is in the allowed list ['a', 'b', 'c'].",
        );
    }

    public function testThrowExceptionWhenInListForEmptyValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_CANNOT_BE_EMPTY->getMessage(
                'attribute',
                implode('\', \'', ['a', 'b', 'c']),
            ),
        );

        Arrays::inList('attribute', '', ['a', 'b', 'c'], true);
    }

    public function testThrowExceptionWhenInListForInvalidEnumComparison(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'active',
                'attribute',
                implode('\', \'', ['DARK', 'LIGHT']),
            ),
        );

        Arrays::inList('attribute', Status::ACTIVE, Theme::cases(), true);
    }

    public function testThrowExceptionWhenInListForValueNotInList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                '1',
                'attribute',
                implode('\', \'', ['a', 'b', 'c']),
            ),
        );

        Arrays::inList('attribute', '1', ['a', 'b', 'c'], true);
    }
}
