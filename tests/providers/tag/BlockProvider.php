<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\tag;

use yii\ui\tag\Block;

use function sprintf;

/**
 * Data provider for {@see \yii\ui\tests\elements\ElementTest} class.
 *
 * Supplies comprehensive test data for validating block-level HTML tag handling, including normalization, enum
 * integration, and operation type propagation, ensuring standards-compliant output and robust value processing in
 * widget and tag rendering.
 *
 * The test data covers real-world scenarios for block, inline, and void tag operations, supporting both explicit
 * `string` values and `UnitEnum` for consistent behavior across different rendering configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct normalization and propagation of block, inline, and void HTML tags.
 * - Named test data sets for precise failure identification.
 * - Validation of enum integration and operation type handling in tag rendering.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class BlockProvider
{
    /**
     * Provides test cases for block tag scenarios.
     *
     * Supplies test data for validating block-level HTML tag normalization and enum integration.
     *
     * Each test case includes the input tag (`UnitEnum`) and the expected `string` value.
     *
     * @return array Test data for block tag scenarios.
     *
     * @phpstan-return array<string, array{Block, string}>
     */
    public static function blockTags(): array
    {
        $data = [];

        foreach (Block::cases() as $case) {
            $data[sprintf('%s block tag', $case->value)] = [$case, $case->value];
        }

        return $data;
    }

    /**
     * Provides test cases for empty tag operation scenarios.
     *
     * Supplies test data for validating empty tag operations, including 'begin' and 'end' operation types.
     *
     * Each test case includes the operation type for clear identification.
     *
     * @return array Test data for empty tag operation scenarios.
     *
     * @phpstan-return array<string, array{'begin'|'end'}>
     */
    public static function emptyTags(): array
    {
        return [
            'empty tag begin operation' => ['begin'],
            'empty tag end operation' => ['end'],
        ];
    }
}
