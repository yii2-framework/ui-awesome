<?php

declare(strict_types=1);

namespace yii\ui\tests\providers;

/**
 * Data provider for {@see \yii\ui\tests\helpers\EncodeTest} class.
 *
 * Designed to ensure the HTML encoding logic correctly processes all supported scenarios, including double encoding,
 * special character handling, and Unicode sequence processing, providing comprehensive test data for encoding
 * validation and edge case coverage.
 *
 * The test data covers real-world HTML encoding scenarios and edge cases to maintain consistent output across different
 * encoding configurations, ensuring HTML content is rendered securely and predictably throughout the application.
 *
 * The provider organizes test cases with descriptive names for quick identification of failure cases during test
 * execution and debugging sessions.
 *
 * Key features.
 * - Double encoding and entity handling scenarios.
 * - Edge case validation for null, empty, and non-string values.
 * - Named test data sets for clear failure identification.
 * - Special character and Unicode sequence encoding.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class EncodeProvider
{
    /**
     * Provides test cases for HTML encoding scenarios.
     *
     * Supplies test data for validating HTML entity encoding, double encoding behavior, and Unicode/binary sequence
     * handling. Each test case includes the input string, the expected encoded output, and a flag indicating whether
     * double encoding is enabled.
     *
     * @return array Test data for encoding scenarios.
     *
     * @phpstan-return array<string, array{string, string, bool}>
     */
    public static function content(): array
    {
        return [
            'ampersand-double' => [
                'Sam &amp; Dark',
                'Sam &amp;amp; Dark',
                true,
            ],
            'ampersand-no-double' => [
                'Sam & Dark',
                'Sam &amp; Dark',
                false,
            ],
            'basic-entities-double' => [
                "a<>&amp;\"'\x80",
                'a&lt;&gt;&amp;amp;"\'�',
                true,
            ],
            'basic-entities-no-double' => [
                "a<>&\"'\x80",
                'a&lt;&gt;&amp;"\'�',
                false,
            ],
            'quotes-not-encoded-in-content' => [
                'He said "Hello" and she said \'Hi\'',
                'He said "Hello" and she said \'Hi\'',
                true,
            ],
            'unicode-null-double' => [
                '\u{0000}',
                '\u{0000}',
                true,
            ],
            'unicode-null-no-double' => [
                '\u{0000}',
                '\u{0000}',
                false,
            ],
        ];
    }

    /**
     * Provides test cases for encode value scenarios.
     *
     * Supplies test data for validating mixed type encoding, double encoding behavior, and Unicode/binary sequence
     * handling. Each test case includes the input value, the expected encoded output, and a flag indicating whether
     * double encoding is enabled.
     *
     * @return array Test data for encode value scenarios.
     *
     * @phpstan-return array<string, array{mixed, mixed, bool}>
     */
    public static function value(): array
    {
        return [
            'all-special-chars' => [
                '<a href="test" data-name=\'value\'>A&B</a>',
                '&lt;a href=&quot;test&quot; data-name=&apos;value&apos;&gt;A&amp;B&lt;/a&gt;',
                true,
            ],
            'ampersand-double' => [
                'Sam &amp; Dark',
                'Sam &amp;amp; Dark',
                true,
            ],
            'ampersand-no-double' => [
                'Sam & Dark',
                'Sam &amp; Dark',
                false,
            ],
            'double-quote-encoding' => [
                'Say "Hello"',
                'Say &quot;Hello&quot;',
                true,
            ],
            'float-value' => [
                1.5,
                '1.5',
                false,
            ],
            'int-value' => [
                42,
                '42',
                false,
            ],
            'mixed-quotes' => [
                'It\'s a "test"',
                'It&apos;s a &quot;test&quot;',
                true,
            ],
            'null-byte-double' => [
                "\0",
                "\0",
                true,
            ],
            'null-byte-no-double' => [
                "\0",
                "\0",
                false,
            ],
            'null-value' => [
                null,
                '',
                false,
            ],
            'single-quote-encoding' => [
                "O'Reilly",
                'O&apos;Reilly',
                true,
            ],
            'unicode-null-double' => [
                "\u{0000}",
                "\u{0000}",
                true,
            ],
            'unicode-null-no-double' => [
                "\u{0000}",
                "\u{0000}",
                false,
            ],
        ];
    }
}
