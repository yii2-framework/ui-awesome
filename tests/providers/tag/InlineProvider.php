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
 * Supplies comprehensive test data for validating inline-level HTML tag handling, including normalization, enum
 * integration, and operation type propagation, ensuring standards-compliant output and robust value processing in
 * widget and tag rendering.
 *
 * The test data covers real-world scenarios for inline and non-inline tag operations, supporting both explicit `string`
 * values and `UnitEnum` for consistent behavior across different rendering configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct normalization and propagation of inline and non-inline HTML tags.
 * - Named test data sets for precise failure identification.
 * - Validation of enum integration and operation type handling in tag rendering.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InlineProvider
{
    /**
     * Provides test cases for inline tag scenarios.
     *
     * Supplies test data for validating inline-level HTML tag normalization and enum integration.
     *
     * Each test case includes the input tag (as `string` or `UnitEnum`) and the expected normalized value.
     *
     * @return array Test data for inline tag scenarios.
     *
     * @phpstan-return array<string, array{string|UnitEnum, string}>
     */
    public static function inlineTags(): array
    {
        $data = [];

        foreach (Inline::cases() as $case) {
            $data[sprintf('%s inline tag as string', $case->value)] = [strtoupper($case->value), $case->value];
            $data[sprintf('%s inline tag as enum', $case->value)] = [$case, $case->value];
        }

        return $data;
    }

    /**
     * Provides test cases for non-inline tag scenarios.
     *
     * Supplies test data for validating non-inline tag operations, including block and void tags, with normalization
     * and operation type propagation.
     *
     * Each test case includes the input tag (as `string` or `UnitEnum`).
     *
     * @return array Test data for non-inline tag scenarios.
     *
     * @phpstan-return array<string, list{string|UnitEnum}>
     */
    public static function nonInlineTags(): array
    {
        $tags = [
            ' div',
            'div ',
            ...Block::cases(),
            ...Voids::cases(),
        ];

        $data = [];

        foreach ($tags as $tag) {
            $tagName = (string) Enum::normalizeValue($tag);

            $data[sprintf('%s non-inline tag', $tagName)] = [$tag];
        }

        return $data;
    }
}
