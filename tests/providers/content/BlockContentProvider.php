<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\content;

use UnitEnum;
use yii\ui\tag\ClassifierTag;

use function sprintf;
use function strtoupper;

/**
 * Data provider for {@see \yii\ui\tests\elements\BlockElementTest} class.
 *
 * Supplies comprehensive test data for validating block-level HTML content handling, including enum integration,
 * operation type detection, and edge case processing, ensuring standards-compliant output and robust widget rendering.
 *
 * The test data covers real-world scenarios for block content identification, operation type assignment, and
 * differentiation between valid and invalid block tags, supporting both `string` and enum values for consistent
 * behavior across rendering modes.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct identification and handling of block-level HTML content and operations.
 * - Named test data sets for precise failure identification.
 * - Validation of enum integration, operation type assignment, and edge case processing.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class BlockContentProvider
{
    /**
     * Provides test cases for block content scenarios.
     *
     * Supplies test data for validating block-level HTML content handling, including enum integration and uppercase
     * conversion.
     *
     * Each test case includes the input value (`string` or enum value) and the expected normalized string for
     * block content scenarios.
     *
     * @return array Test data for block content scenarios.
     *
     * @phpstan-return array<string, array{string|UnitEnum, string}>
     */
    public static function blockContent(): array
    {
        $data = [];

        foreach (ClassifierTag::blockTags() as $case) {
            $data[sprintf('%s tag', $case->value)] = [strtoupper($case->value), $case->value];
            $data[sprintf('%s tag with enum', $case->value)] = [$case, $case->value];
        }

        return $data;
    }

    /**
     * Provides test cases for empty block content operation scenarios.
     *
     * Supplies test data for validating handling of empty block content operations, including 'begin' and 'end'
     * operation types.
     *
     * Each test case includes the operation type for empty block content scenarios.
     *
     * @return array Test data for empty block content operation scenarios.
     *
     * @phpstan-return array<string, array{'begin'|'end'}>
     */
    public static function emptyContent(): array
    {
        return [
            'empty tag begin operation' => ['begin'],
            'empty tag end operation' => ['end'],
        ];
    }

    /**
     * Provides test cases for non-block content scenarios.
     *
     * Supplies test data for validating differentiation between valid and invalid block tags, including edge cases with
     * non-standard or malformed tag values and operation types.
     *
     * Each test case includes the input tag value and operation type for non-block content scenarios.
     *
     * @return array Test data for non-block content scenarios.
     *
     * @phpstan-return array<string, array{string, 'begin'|'end'}>
     */
    public static function nonBlockContent(): array
    {
        $data = [];
        $tags = [
            'false',
            'span ',
            ' span',
            'span',
            'STRONG',
            'true',
        ];

        foreach ($tags as $tag) {
            $data[sprintf('%s tag begin operation', $tag)] = [$tag, 'begin'];
            $data[sprintf('%s tag end operation', $tag)] = [$tag, 'end'];
        }

        return $data;
    }
}
