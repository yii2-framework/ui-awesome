<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;
use yii\ui\helpers\Arrays;
use yii\ui\tests\providers\ArraysProvider;
use yii\ui\tests\support\stub\enum\{Status, Theme};

use function implode;
use function json_encode;

/**
 * Test suite for {@see Arrays} helper functionality and behavior.
 *
 * Validates the manipulation and validation of array structures according to the PHP language specification.
 *
 * Ensures correct handling, immutability, and validation of array operations, supporting both associative and
 * sequential arrays, as well as enum-based comparisons.
 *
 * Test coverage:
 * - Accurate detection of associative arrays.
 * - Compatibility with PHP enums and scalar types.
 * - Detection of sequential arrays.
 * - Exception handling for invalid values and comparisons.
 * - Validation of values within a predefined list.
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
            Message::HELPER_VALUE_CANNOT_BE_EMPTY->getMessage(
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
            Message::HELPER_VALUE_NOT_IN_LIST->getMessage(
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
            Message::HELPER_VALUE_NOT_IN_LIST->getMessage(
                '1',
                'attribute',
                implode('\', \'', ['a', 'b', 'c']),
            ),
        );

        Arrays::inList('attribute', '1', ['a', 'b', 'c'], true);
    }
}
