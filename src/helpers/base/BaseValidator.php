<?php

declare(strict_types=1);

namespace yii\ui\helpers\base;

use function ctype_digit;
use function is_int;

/**
 * Base class for type-safe validation of HTML helper values.
 *
 * Provides a unified, immutable API for validating integer-like values in HTML attributes, tag rendering, and view
 * systems, ensuring standards-compliant and predictable output for modern web applications.
 *
 * Key features:
 * - Efficient validation of integer-like values for attribute rendering.
 * - Immutable, stateless design for safe reuse in helpers and components.
 * - Integration-ready for tag, attribute, and view rendering systems.
 * - Type-safe, static validation methods for HTML values.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseValidator
{
    /**
     * Validates whether a value is an integer or integer-like string within a specified range.
     *
     * Ensures that the provided value is either an `int` or a string representing an integer, and that it falls within
     * the specified minimum and optional maximum bounds. Returns `true` if the value is valid, `false` otherwise.
     *
     * This method is designed for use in HTML attribute validation, tag rendering, and view systems requiring strict
     * type and range checks for numeric values.
     *
     * @param int|string $value Value to validate as integer-like.
     * @param int $min Minimum allowed value (inclusive).
     * @param int|null $max Optional maximum allowed value (inclusive). If `null`, no upper bound is enforced.
     *
     * @return bool Returns `true` if the value is integer-like and within bounds, `false` otherwise.
     */
    public static function intLike(int|string $value, int $min, int|null $max = null): bool
    {
        if (is_int($value)) {
            return $value >= $min && ($max === null || $value <= $max);
        }

        if ($value === (string) $min) {
            return true;
        }

        if ($value[0] === '-' || $value === '+') {
            return false;
        }

        if (ctype_digit($value) === false) {
            return false;
        }

        $int = (int) $value;

        return $int >= $min && ($max === null || $int <= $max);
    }
}
