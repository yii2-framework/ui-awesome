<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\elements;

use yii\ui\tag\{BlockTag, InlineTag, VoidTag};

use function array_map;
use function in_array;
use function sprintf;
use function strtoupper;

/**
 * Data provider for {@see \yii\ui\tests\elements\InlineTest} class.
 *
 * Supplies comprehensive test data for validating the handling of inline, block, and void HTML tag operations in widget
 * and tag rendering, ensuring standards-compliant assignment, propagation, and value mapping according to the HTML
 * specification.
 *
 * The test data covers real-world scenarios for inline tag enumeration, block tag exclusion, void tag operations, and
 * mixed type handling, supporting both explicit `string` values and enum instances to maintain consistent output across
 * different rendering configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct propagation and mapping of inline, block, and void tag operations in HTML element rendering.
 * - Named test data sets for precise failure identification.
 * - Validation of tag values, operation types, and void tag scenarios.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InlineProvider
{
    /**
     * Provides test cases for inline HTML tag scenarios.
     *
     * Supplies test data for validating assignment and propagation of inline HTML tags, excluding void tags, including
     * all cases defined in {@see InlineTag}.
     *
     * Each test case includes the tag value as a `string` or enum instance for clear identification.
     *
     * @return array Test data for inline tag scenarios.
     *
     * @phpstan-return array<string, array{string|InlineTag}>
     */
    public static function inlineTags(): array
    {
        $data = [];
        $voidTags = self::voidTagValues();

        foreach (InlineTag::cases() as $case) {
            if (in_array($case->value, $voidTags, true) === false) {
                $data[sprintf('%s inline tag as string', $case->value)] = [strtoupper($case->value)];
                $data[sprintf('%s inline tag as enum', $case->value)] = [$case];
            }
        }

        return $data;
    }

    /**
     * Provides test cases for block HTML tag scenarios excluding inline tags.
     *
     * Supplies test data for validating assignment and propagation of block HTML tags, excluding those defined as
     * inline tags.
     *
     * Each test case includes the tag value as a `string` or enum instance for clear identification.
     *
     * @return array Test data for non-inline block tag scenarios.
     *
     * @phpstan-return array<string, array{string|BlockTag}>
     */
    public static function nonInlineTags(): array
    {
        $data = [];
        $inlineTags = self::inlineTagValues();

        foreach (BlockTag::cases() as $case) {
            if (in_array($case->value, $inlineTags, true) === false) {
                $data[sprintf('%s block tag as string', $case->value)] = [strtoupper($case->value)];
                $data[sprintf('%s block tag as enum', $case->value)] = [$case];
            }
        }

        return $data;
    }

    /**
     * Provides test cases for inline void HTML tag scenarios.
     *
     * Supplies test data for validating assignment and propagation of inline void HTML tags, including all cases
     * defined in {@see InlineTag} that are void tags.
     *
     * Each test case includes the tag value as a `string` or enum instance for clear identification.
     *
     * @return array Test data for inline void tag scenarios.
     *
     * @phpstan-return array<string, array{string|InlineTag}>
     */
    public static function voidInlineTags(): array
    {
        $data = [];
        $voidTags = self::voidTagValues();

        foreach (InlineTag::cases() as $case) {
            if (in_array($case->value, $voidTags, true)) {
                $data[sprintf('%s inline void tag as string', $case->value)] = [strtoupper($case->value)];
                $data[sprintf('%s inline void tag as enum', $case->value)] = [$case];
            }
        }

        return $data;
    }

    /**
     * Provides test cases for void HTML tag scenarios.
     *
     * Supplies test data for validating assignment and propagation of void HTML tags, including all cases defined in
     * {@see VoidTag}.
     *
     * Each test case includes the tag value as a `string` or enum instance for clear identification.
     *
     * @return array Test data for void tag scenarios.
     *
     * @phpstan-return array<string, array{string|VoidTag}>
     */
    public static function voidTags(): array
    {
        $data = [];

        foreach (VoidTag::cases() as $case) {
            $data[sprintf('%s void tag as string', $case->value)] = [strtoupper($case->value)];
            $data[sprintf('%s void tag as enum', $case->value)] = [$case];
        }

        return $data;
    }

    /**
     * Returns all inline tag values as a list of strings.
     *
     * Used internally for tag type filtering and validation.
     *
     * @return list<string> List of inline tag values.
     *
     * @phpstan-return list<string>
     */
    private static function inlineTagValues(): array
    {
        return array_map(static fn(InlineTag $case): string => $case->value, InlineTag::cases());
    }

    /**
     * Returns all void tag values as a list of strings.
     *
     * Used internally for tag type filtering and validation.
     *
     * @return list<string> List of void tag values.
     *
     * @phpstan-return list<string>
     */
    private static function voidTagValues(): array
    {
        return array_map(static fn(VoidTag $case): string => $case->value, VoidTag::cases());
    }
}
