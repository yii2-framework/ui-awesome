<?php

declare(strict_types=1);

namespace yii\ui\helpers;

/**
 * Array manipulation utility providing advanced and type-safe array operations.
 *
 * Concrete implementation offering utility methods for array validation, inspection, and transformation with strict
 * type safety and performance optimizations.
 *
 * This class centralizes common array operations, ensuring consistent handling of empty arrays, strict key and value
 * validation, and optimized checks for list and associative array types.
 *
 * Exception-driven error handling is provided for invalid values, supporting defensive programming and early error
 * detection.
 *
 * Key features.
 * - Consistent handling of empty arrays for both list and associative checks.
 * - Detection of list arrays (integer keys) and associative arrays (string keys).
 * - Exception-driven error handling for invalid or empty values.
 * - Optimized for performance and strict type safety.
 * - Type-safe value validation against allowed lists with exception support.
 *
 * {@see base\BaseArrays} for the base implementation.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Arrays extends base\BaseArrays {}
