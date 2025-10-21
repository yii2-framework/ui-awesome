<?php

declare(strict_types=1);

namespace yii\ui\helpers\exception;

use function sprintf;

/**
 * Represents standardized error messages for helper exceptions.
 *
 * This enum defines formatted error messages for various error conditions that may occur during helper operations such
 * as value validation.
 *
 * It provides a consistent and standardized way to present error messages across the helper system.
 *
 * Each case represents a specific type of error, with a message template that can be populated with dynamic values
 * using the {@see Message::getMessage()} method.
 *
 * This centralized approach improves the consistency of error messages and simplifies potential internationalization.
 *
 * Key features.
 * - Centralization of an error text for easier maintenance.
 * - Consistent error handling across the helper system.
 * - Integration with specific exception classes.
 * - Message formatting with dynamic parameters.
 * - Standardized error messages for common helper and utility cases.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Message: string
{
    /**
     * Error when a value can't be empty.
     *
     * Format: "The '%s' must not be empty, valid values are: '%s'."
     */
    case VALUE_CANNOT_BE_EMPTY = "The '%s' must not be empty, valid values are: '%s'.";

    /**
     * Error when a value is not in the list of valid values.
     *
     * Format: "Value '%s' is not in the list of valid values for '%s': '%s'."
     */
    case VALUE_NOT_IN_LIST = "Value '%s' is not in the list of valid values for '%s': '%s'.";

    /**
     * Returns the formatted message string for the error case.
     *
     * Retrieves and formats the error message string by interpolating the provided arguments.
     *
     * @param int|string ...$argument Dynamic arguments to insert into the message.
     *
     * @return string Error message with interpolated arguments.
     *
     * Usage example:
     * ```php
     * throw new InvalidArgumentException(Message::INVALID_PATH_ALIAS->getMessage('alias'));
     * ```
     */
    public function getMessage(int|string ...$argument): string
    {
        return sprintf($this->value, ...$argument);
    }
}
