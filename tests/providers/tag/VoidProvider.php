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
 * Supplies comprehensive test data for validating void-level HTML tag handling, including normalization, enum
 * integration, and operation type propagation, ensuring standards-compliant output and robust value processing in
 * widget and tag rendering.
 *
 * The test data covers real-world scenarios for void and non-void tag operations, supporting both explicit `string`
 * values and `UnitEnum` for consistent behavior across different rendering configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct normalization and propagation of void and non-void HTML tags.
 * - Named test data sets for precise failure identification.
 * - Validation of enum integration and operation type handling in tag rendering.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class VoidProvider
{
    /**
     * Provides test cases for non-void tag scenarios.
     *
     * Supplies test data for validating non-void tag operations, including block and inline tags, with normalization
     * and operation type propagation.
     *
     * Each test case includes the input tag (as `string` or `UnitEnum`).
     *
     * @return array Test data for non-void tag scenarios.
     *
     * @phpstan-return array<string, list{string|UnitEnum}>
     */
    public static function nonVoidTags(): array
    {
        $tags = [
            'div ',
            ' div',
            ...Block::cases(),
            ...Inline::cases(),
        ];

        $data = [];

        foreach ($tags as $tag) {
            $tagName = (string) Enum::normalizeValue($tag);

            $data[sprintf('%s non-void tag', $tagName)] = [$tag];
        }

        return $data;
    }

    /**
     * Provides test cases for void tag scenarios.
     *
     * Supplies test data for validating void-level HTML tag normalization and enum integration.
     *
     * Each test case includes the input tag (as `string` or `UnitEnum`) and the expected normalized value.
     *
     * @return array Test data for void tag scenarios.
     *
     * @phpstan-return array<string, array{string|UnitEnum, string}>
     */
    public static function voidTags(): array
    {
        $data = [];

        foreach (Voids::cases() as $case) {
            $data[sprintf('%s void tag as string', $case->value)] = [strtoupper($case->value), $case->value];
            $data[sprintf('%s void tag as enum', $case->value)] = [$case, $case->value];
        }

        return $data;
    }
}
