<?php

declare(strict_types=1);

namespace yii\ui\helpers\base;

use BackedEnum;
use UnitEnum;

use function array_map;

/**
 * Base class for advanced enum normalization and value extraction utilities.
 *
 * Provides a unified API for normalizing enum values and arrays, supporting both backed and pure enums in a type-safe
 * and predictable manner. This class abstracts the complexity of extracting scalar values from enums, enabling seamless
 * integration with serialization, comparison, and data transformation logic across the framework.
 *
 * It supports normalization of single enum instances or arrays of enums, returning their scalar value (for backed
 * enums) or name (for pure enums), and passes through non-enum values unchanged.
 *
 * This is essential for consistent handling of enums in configuration, storage, and API layers.
 *
 * Key features:
 * - Batch normalization of arrays of enums or mixed values with support for `null` handling.
 * - Pass-through behavior for non-enum values to support mixed-type arrays.
 * - Type-safe normalization of backed and pure enums to scalar values or names.
 * - Unified API for enum value extraction in serialization and comparison logic.
 * - Utility methods for simplifying enum handling in data processing and configuration workflows.
 *
 * @see BackedEnum for enums with scalar values.
 * @see UnitEnum for all enum types.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseEnum
{
    /**
     * Normalizes an array of enum values or mixed values to their scalar values or names.
     *
     * Applies {@see normalizeValue()} to each element of the array, returning an array of normalized values.
     *
     * This method is essential for batch processing of enum arrays in serialization, configuration, or data
     * transformation logic, supporting both enums and non-enum values in mixed arrays.
     *
     * @param array $values Array of enum instances or mixed values to normalize.
     *
     * @return array Array of normalized scalar values, names, or original values for non-enums.
     *
     * Usage example:
     * ```php
     * Enum::normalizeArray([Status::ACTIVE, Status::INACTIVE]); // ['active', 'inactive']
     * Enum::normalizeArray(['foo', Status::ACTIVE, 42]); // ['foo', 'active', 42]
     * ```
     *
     * {@see normalizeValue()} for single value normalization.
     *
     * @phpstan-param list<UnitEnum|mixed> $values
     * @phpstan-return list<mixed>
     */
    public static function normalizeArray(array $values): array
    {
        return array_map([self::class, 'normalizeValue'], $values);
    }
    /**
     * Normalizes a single enum value to its scalar value or name.
     *
     * If the value is a backed enum, returns its scalar value. If it is a pure enum, returns its name. For non-enum
     * values, returns the value unchanged.
     *
     * This method is essential for extracting comparable or serializable values from enums in configuration, storage,
     * or API output.
     *
     * @param mixed $value Enum instance or any value to normalize.
     *
     * @return mixed Scalar value for backed enums, name for pure enums, or the original value for non-enums.
     *
     * Usage example:
     * ```php
     * Enum::normalizeValue(Status::ACTIVE); // 'active'
     * Enum::normalizeValue('foo'); // 'foo'
     * ```
     *
     * {@see normalizeArray()} for batch normalization.
     */
    public static function normalizeValue(mixed $value): mixed
    {
        if ($value instanceof UnitEnum) {
            return $value instanceof BackedEnum ? $value->value : $value->name;
        }

        return $value;
    }
}
