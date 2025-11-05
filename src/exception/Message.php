<?php

declare(strict_types=1);

namespace yii\ui\exception;

use function sprintf;

/**
 * Represents standardized error messages.
 *
 * This enum defines formatted error messages for various error conditions that may occur during operations such as
 * value validation.
 *
 * It provides a consistent and standardized way to present error messages across the system.
 *
 * Each case represents a specific type of error, with a message template that can be populated with dynamic values
 * using the {@see Message::getMessage()} method.
 *
 * This centralized approach improves the consistency of error messages and simplifies potential internationalization.
 *
 * Key features.
 * - Centralization of an error text for easier maintenance.
 * - Consistent error handling across the system.
 * - Integration with specific exception classes.
 * - Message formatting with dynamic parameters.
 * - Standardized error messages for common and utility cases.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Message: string
{
    /**
     * Error when a data attribute key is not a string.
     *
     * Format: "Data attribute key must be of type 'string', '%s' given."
     */
    case DATA_ATTRIBUTE_KEY_MUST_BE_STRING = "Data attribute key must be of type 'string', '%s' given.";

    /**
     * Error when a data attribute value is not a string or Closure.
     *
     * Format: "Data attribute value must be of type 'string' or 'Closure', '%s' given."
     */
    case DATA_ATTRIBUTE_VALUE_MUST_BE_STRING_OR_CLOSURE = "Data attribute value must be of type 'string' or 'Closure', " .
    "'%s' given.";

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
     * throw new InvalidArgumentException(Message::VALUE_CANNOT_BE_EMPTY->getMessage('status', 'active, inactive'));
     * ```
     */
    public function getMessage(int|string ...$argument): string
    {
        return sprintf($this->value, ...$argument);
    }
}
