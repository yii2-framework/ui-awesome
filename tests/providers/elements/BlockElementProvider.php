<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\elements;

use yii\ui\element\tag\BlockTag;

use function sprintf;
use function strtoupper;

/**
 * Data provider for {@see \yii\ui\tests\elements\BlockElementTest} class.
 *
 * Supplies comprehensive test data for validating the handling of block and inline HTML tag operations in widget and
 * tag rendering, ensuring standards-compliant assignment, propagation, and value mapping according to the HTML
 * specification.
 *
 * The test data covers real-world scenarios for block tag enumeration, inline tag operations, and empty tag operations,
 * supporting both explicit string values and operation types to maintain consistent output across different rendering
 * configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct propagation and mapping of block and inline tag operations in HTML element rendering.
 * - Named test data sets for precise failure identification.
 * - Validation of tag values, operation types, and empty tag scenarios.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class BlockElementProvider
{
    /**
     * Provides test cases for block HTML tag scenarios.
     *
     * Supplies test data for validating assignment and propagation of block HTML tags, including all cases defined in
     * {@see BlockTag}.
     *
     * Each test case includes the tag value as a `string` or enum instance for clear identification.
     *
     * @return array Test data for block tag scenarios.
     *
     * @phpstan-return array<string, array{string|BlockTag}>
     */
    public static function blockTags(): array
    {
        $data = [];

        foreach (BlockTag::cases() as $case) {
            $data[sprintf('%s tag', $case->value)] = [strtoupper($case->value)];
            $data[sprintf('%s tag with enum', $case->value)] = [$case];
        }

        return $data;
    }

    /**
     * Provides test cases for empty tag operations.
     *
     * Supplies test data for validating handling of empty tag operations, including `begin` and `end` types.
     *
     * Each test case includes the operation type and a descriptive name.
     *
     * @return array Test data for empty tag operation scenarios.
     *
     * @phpstan-return array<string, array{'begin'|'end'}>
     */
    public static function emptyTagOperations(): array
    {
        return [
            'empty tag begin operation' => ['begin'],
            'empty tag end operation' => ['end'],
        ];
    }

    /**
     * Provides test cases for inline HTML tag operations.
     *
     * Supplies test data for validating assignment and propagation of inline HTML tag operations, including `begin` and
     * `end` operations for supported tags.
     *
     * Each test case includes the tag value, operation type, and a descriptive name.
     *
     * @return array Test data for inline tag operation scenarios.
     *
     * @phpstan-return array<string, array{string, 'begin'|'end'}>
     */
    public static function inlineTagOperations(): array
    {
        $data = [];
        $inlineTags = [
            'a',
            'abbr',
            'span',
            'STRONG',
        ];

        foreach ($inlineTags as $tag) {
            $data[sprintf('%s tag begin operation', $tag)] = [$tag, 'begin'];
            $data[sprintf('%s tag end operation', $tag)] = [$tag, 'end'];
        }

        return $data;
    }
}
