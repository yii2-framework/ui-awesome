<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\helpers\Arrays;
use yii\ui\helpers\exception\Message;
use yii\ui\tests\providers\ArraysProvider;
use yii\ui\tests\support\stub\enum\{Status, Theme};

use function implode;
use function json_encode;

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
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     *
     * @phpstan-param array<array-key, int|string> $array
     */
    #[DataProviderExternal(ArraysProvider::class, 'isAssociative')]
    public function testDetectArrayIsAssociative(array $array, bool $expected): void
    {
        self::assertSame(
            $expected,
            Arrays::isAssociative($array),
            'Should return ' . ($expected ? '\'true\'' : '\'false\'') . ' for input array ' . json_encode($array) . '.',
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     *
     * @phpstan-param list<UnitEnum|scalar|null> $allowed
     */
    #[DataProviderExternal(ArraysProvider::class, 'inList')]
    public function testDetectArrayValueInList(
        string $attribute,
        UnitEnum|int|string $value,
        array $allowed,
        bool $expected,
        string $message,
    ): void {
        self::assertSame($expected, Arrays::inList($attribute, $value, $allowed), $message);
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     *
     * @phpstan-param array<array-key, int|string> $array
     */
    #[DataProviderExternal(ArraysProvider::class, 'isList')]
    public function testReturnIsListWhenArrayIsListOrNot(array $array, bool $expected): void
    {
        self::assertSame(
            $expected,
            Arrays::isList($array),
            'Should return ' . ($expected ? '\'true\'' : '\'false\'') . ' for input array ' . json_encode($array) . '.',
        );
    }

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
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

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
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

    /**
     * @throws InvalidArgumentException if one or more arguments are invalid, of incorrect type or format.
     */
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
