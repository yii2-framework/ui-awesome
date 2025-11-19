<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\tag;

use UnitEnum;
use yii\ui\helpers\Enum;
use yii\ui\tag\{Block, Inline, Voids};

use function sprintf;
use function strtoupper;

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
     * Each test case includes the input tag (as `string` or `UnitEnum`) and the expected normalized value.
     *
     * @return array Test data for block tag scenarios.
     *
     * @phpstan-return array<string, array{string|UnitEnum, string}>
     */
    public static function blockTags(): array
    {
        $data = [];

        foreach (Block::cases() as $case) {
            $data[sprintf('%s tag', $case->value)] = [strtoupper($case->value), $case->value];
            $data[sprintf('%s tag with enum', $case->value)] = [$case, $case->value];
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

    /**
     * Provides test cases for non-block tag operation scenarios.
     *
     * Supplies test data for validating non-block tag operations, including inline and void tags, with normalization
     * and operation type propagation.
     *
     * Each test case includes the input tag (as `string` or `UnitEnum`) and the operation type.
     *
     * @return array Test data for non-block tag operation scenarios.
     *
     * @phpstan-return array<string, array{string|UnitEnum, 'begin'|'end'}>
     */
    public static function nonBlockTags(): array
    {
        $tags = [
            ' a',
            'a ',
            ...Inline::cases(),
            ...Voids::cases(),
        ];

        $data = [];

        foreach ($tags as $tag) {
            $tagName = (string) Enum::normalizeValue($tag);

            $data[sprintf('%s tag begin operation', $tagName)] = [$tag, 'begin'];
            $data[sprintf('%s tag end operation', $tagName)] = [$tag, 'end'];
        }

        return $data;
    }
}
