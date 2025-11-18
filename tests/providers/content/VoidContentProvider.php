<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\content;

use yii\ui\content\flow\VoidContent;

use function sprintf;
use function strtoupper;

/**
 * Data provider for {@see \yii\ui\tests\elements\VoidElementTest} class.
 *
 * Supplies comprehensive test data for validating void-level HTML content handling, including enum integration,
 * differentiation between valid and invalid void tags, and edge case processing, ensuring standards-compliant output
 * and robust widget rendering.
 *
 * The test data covers real-world scenarios for void content identification, enum assignment, and differentiation
 * between valid and invalid void tags, supporting both `string` and enum values for consistent behavior across
 * rendering modes.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct identification and handling of void-level HTML content and operations.
 * - Named test data sets for precise failure identification.
 * - Validation of enum integration, tag assignment, and edge case processing.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class VoidContentProvider
{
    /**
     * Provides test cases for non-void content scenarios.
     *
     * Supplies test data for validating differentiation between valid and invalid void tags, including edge cases
     * with non-standard or malformed tag values.
     *
     * Each test case includes the input tag value for non-void content scenarios.
     *
     * @return array Test data for non-void content scenarios.
     *
     * @phpstan-return array<string, list{string}>
     */
    public static function nonVoidContent(): array
    {
        $data = [];
        $tags = [
            'div ',
            ' div',
            'div',
            'false',
            'STRONG',
            'true',
        ];

        foreach ($tags as $tag) {
            $data[sprintf('%s non-void tag', $tag)] = [$tag];
        }

        return $data;
    }
    /**
     * Provides test cases for void content scenarios.
     *
     * Supplies test data for validating void-level HTML content handling, including enum integration and uppercase
     * conversion.
     *
     * Each test case includes the input value (`string` or `VoidContent` enum) for void content scenarios.
     *
     * @return array Test data for void content scenarios.
     *
     * @phpstan-return array<string, array{string|VoidContent}>
     */
    public static function voidContent(): array
    {
        $data = [];

        foreach (VoidContent::cases() as $case) {
            $data[sprintf('%s void tag as string', $case->value)] = [strtoupper($case->value)];
            $data[sprintf('%s void tag as enum', $case->value)] = [$case];
        }

        return $data;
    }
}
