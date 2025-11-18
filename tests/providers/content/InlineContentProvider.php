<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\content;

use yii\ui\content\flow\InlineContent;

use function sprintf;
use function strtoupper;

/**
 * Data provider for {@see \yii\ui\tests\elements\InlineElementTest} class.
 *
 * Supplies comprehensive test data for validating inline-level HTML content handling, including enum integration,
 * differentiation between valid and invalid inline tags, and edge case processing, ensuring standards-compliant output
 * and robust widget rendering.
 *
 * The test data covers real-world scenarios for inline content identification, enum assignment, and differentiation
 * between valid and invalid inline tags, supporting both `string` and enum values for consistent behavior across
 * rendering modes.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct identification and handling of inline-level HTML content and operations.
 * - Named test data sets for precise failure identification.
 * - Validation of enum integration, tag assignment, and edge case processing.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InlineContentProvider
{
    /**
     * Provides test cases for inline content scenarios.
     *
     * Supplies test data for validating inline-level HTML content handling, including enum integration and uppercase
     * conversion.
     *
     * Each test case includes the input value (`string` or `InlineContent` enum) and the expected normalized string for
     * inline content scenarios.
     *
     * @return array Test data for inline content scenarios.
     *
     * @phpstan-return array<string, array{string|InlineContent, string}>
     */
    public static function inlineContent(): array
    {
        $data = [];

        foreach (InlineContent::cases() as $case) {
            $data[sprintf('%s inline tag as string', $case->value)] = [strtoupper($case->value), $case->value];
            $data[sprintf('%s inline tag as enum', $case->value)] = [$case, $case->value];
        }

        return $data;
    }

    /**
     * Provides test cases for non-inline content scenarios.
     *
     * Supplies test data for validating differentiation between valid and invalid inline tags, including edge cases
     * with non-standard or malformed tag values.
     *
     * Each test case includes the input tag value for non-inline content scenarios.
     *
     * @return array Test data for non-inline content scenarios.
     *
     * @phpstan-return array<string, list{string}>
     */
    public static function nonInlineContent(): array
    {
        $data = [];
        $tags = [
            'div ',
            ' div',
            'div',
            'false',
            'NAV',
            'true',
        ];

        foreach ($tags as $tag) {
            $data[sprintf('%s non-inline tag', $tag)] = [$tag];
        }

        return $data;
    }
}
