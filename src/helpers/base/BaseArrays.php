<?php

declare(strict_types=1);

namespace yii\ui\helpers\base;

use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\helpers\BaseArrayHelper;
use yii\ui\exception\Message;
use yii\ui\helpers\Enum;

use function array_is_list;
use function implode;
use function in_array;
use function is_int;
use function is_string;

/**
 * Base class for advanced array structure validation and type-safe operations.
 *
 * Provides a unified API for validating, inspecting, and working with PHP arrays, including detection of a list and
 * associative structures, key type checking, and value validation against allowed sets.
 *
 * This class centralizes common array operations, ensuring consistent handling of empty arrays, strict key and value
 * validation, and performance-optimized checks for list and associative array types.
 *
 * Exception-driven error handling is provided for invalid values, supporting defensive programming and early error
 * detection.
 *
 * Key features:
 * - Consistent handling of empty arrays for both list and associative checks.
 * - Detection of list arrays (`integer` keys) and associative arrays (`string` keys).
 * - Exception-driven error handling for invalid or empty values.
 * - Optimized for performance and strict type safety.
 * - Type-safe value validation against allowed lists with exception support.
 *
 * {@see BaseArrayHelper} for the base implementation.
 * {@see InvalidArgumentException} for invalid value errors.
 * {@see Message} for standardized error messages.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseArrays extends BaseArrayHelper
{
    /**
     * Validates that a value exists in a list of allowed values for a given attribute.
     *
     * Provides strict, type-safe validation of a value against an allowed set, supporting case-sensitive matching,
     * empty value checks, and exception-driven error handling for invalid or empty values.
     *
     * Designed for use in attribute validation scenarios where only specific values are permitted (such as enum-like
     * attributes or option lists).
     *
     * This method ensures that only valid values are accepted for the specified attribute, throwing a detailed
     * exception if the value is empty or not present in the allowed list when `$throw` is `true`.
     *
     * @param string $attribute Attribute name being validated (for error reporting).
     * @param UnitEnum|int|string $value Value to check against the allowed list.
     * @param array $allowed List of allowed values (must be non-empty).
     * @param bool $throw Whether to throw an exception on failure (default: `false`).
     *
     * @throws InvalidArgumentException if the value is empty or not in the allowed list and `$throw` is `true`.
     *
     * @return bool `true` if the value is valid, `false` otherwise (unless exception is thrown).
     *
     * Usage example:
     * ```php
     * // Validate that a status is allowed
     * Arrays::inList('status', $status, ['active', 'inactive'], true);
     *
     * // Validate a numeric option
     * Arrays::inList('priority', $priority, [1, 2, 3], true);
     *
     * // Use without exception (returns `bool`)
     * $isValid = Arrays::inList('type', $type, ['a', 'b', 'c']);
     *
     * // Use with enum
     * Arrays::inList('status', Status::ACTIVE, Status::cases(), true);
     * ```
     *
     * @phpstan-param mixed[] $allowed
     */
    public static function inList(
        string $attribute,
        UnitEnum|int|string $value,
        array $allowed,
        bool $throw = false,
    ): bool {
        $normalizedAllowedValues = Enum::normalizeArray($allowed);

        if ($value === '' && $throw) {
            throw new InvalidArgumentException(
                Message::HELPER_VALUE_CANNOT_BE_EMPTY->getMessage(
                    $attribute,
                    implode('\', \'', $normalizedAllowedValues),
                ),
            );
        }

        $normalizedValue = Enum::normalizeValue($value);

        if (in_array($normalizedValue, $normalizedAllowedValues, true)) {
            return true;
        }

        if ($throw && (is_string($normalizedValue) || is_int($normalizedValue))) {
            throw new InvalidArgumentException(
                Message::HELPER_VALUE_NOT_IN_LIST->getMessage(
                    $normalizedValue,
                    $attribute,
                    implode('\', \'', $normalizedAllowedValues),
                ),
            );
        }

        return false;
    }

    /**
     * Determines whether the given array is a list (sequential integer keys starting from zero).
     *
     * Provides a type-safe, performance-optimized check for list arrays, where all keys are integers in sequential
     * order without gaps.
     *
     * Definition considers an empty array a list.
     *
     * This method is essential for distinguishing between a list and associative arrays in scenarios such as
     * serialization, data validation, and type enforcement, ensuring predictable array structure handling throughout
     * the application.
     *
     * @param array $array Array to check for list structure.
     *
     * @return bool `true` if the array is a list (sequential `integer` keys), `false` otherwise.
     *
     * {@see isAssociative()} for associative array detection.
     *
     * Usage example:
     * ```php
     * Arrays::isList([1, 2, 3]); // return `true`
     * Arrays::isList(['a' => 1, 'b' => 2]); // return `false`
     * Arrays::isList([]); // return `true`
     * ```
     *
     * @phpstan-param mixed[] $array
     */
    public static function isList(array $array): bool
    {
        return array_is_list($array);
    }
}
