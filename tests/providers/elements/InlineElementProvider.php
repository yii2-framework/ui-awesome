<?php

declare(strict_types=1);

namespace yii\ui\tests\providers\elements;

use yii\ui\element\tag\InlineTag;

use function sprintf;
use function strtoupper;

/**
 * Data provider for {@see \yii\ui\tests\elements\InlineElementTest} class.
 *
 * Supplies comprehensive test data for validating the handling of inline HTML tag operations in widget and tag
 * rendering, ensuring standards-compliant assignment, propagation, and value mapping according to the HTML
 * specification.
 *
 * The test data covers real-world scenarios for inline tag enumeration, supporting both explicit string values and enum
 * cases to maintain consistent output across different rendering configurations.
 *
 * The provider organizes test cases with descriptive names for clear identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features:
 * - Ensures correct propagation and mapping of inline tag operations in HTML element rendering.
 * - Named test data sets for precise failure identification.
 * - Validation of tag values and enum scenarios.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InlineElementProvider
{
    /**
     * Provides test cases for inline HTML tag scenarios.
     *
     * Supplies test data for validating assignment and propagation of inline HTML tags, including all cases defined in
     * {@see InlineTag}.
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

        foreach (InlineTag::cases() as $case) {
            $data[sprintf('%s inline tag as string', $case->value)] = [strtoupper($case->value)];
            $data[sprintf('%s inline tag as enum', $case->value)] = [$case];
        }

        return $data;
    }
}
