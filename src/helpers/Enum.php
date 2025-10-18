<?php

declare(strict_types=1);

namespace yii\ui\helpers;

/**
 * Enum utility helper for advanced enum operations and type-safe value handling.
 *
 * Provides a concrete, ready-to-use implementation for working with PHP enums, offering utility methods for value
 * extraction, validation, and conversion between enum cases and scalar values.
 *
 * This class centralizes common enum operations, ensuring consistent handling of enum types, strict type safety, and
 * robust error handling for invalid values or cases.
 *
 * {@see base\BaseEnum} for the base implementation.
 *
 * Usage example:
 * ```php
 * // Normalize a single enum value
 * Enum::normalizeValue(Status::ACTIVE); // $value === 'active' (for a backed enum)
 *
 * // Normalize an array of enums
 * Enum::normalizeArray([Status::ACTIVE, Status::INACTIVE]); // $values === ['active', 'inactive']
 *
 * // Pass-through for non-enum values
 * Enum::normalizeArray(['foo', Status::ACTIVE, 42]); // $mixed === ['foo', 'active', 42]
 * ```
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Enum extends base\BaseEnum {}
