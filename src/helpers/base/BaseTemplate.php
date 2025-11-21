<?php

declare(strict_types=1);

namespace yii\ui\helpers\base;

use function explode;
use function implode;
use function strtr;

/**
 * Base class for template string rendering and token substitution in HTML helpers.
 *
 * Provides a unified API for rendering template strings with dynamic token replacement, supporting safe and predictable
 * output for HTML tag generation, attribute rendering, and view systems.
 *
 * This class is designed for use in HTML helpers, tag builders, and view renderers, enabling flexible and secure
 * template string processing for modern web applications.
 *
 * Key features:
 * - Efficient token substitution for template-based rendering.
 * - Immutable, stateless design for safe reuse.
 * - Integration-ready for tag, attribute, and view rendering systems.
 * - Type-safe, static rendering methods for template strings.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseTemplate
{
    /**
     * Renders a template string by substituting tokens with provided values.
     *
     * Processes the given template string, replacing tokens according to the provided associative array, and returns
     * the rendered result as a string with lines joined by the system line ending.
     *
     * @param string $template Template string containing tokens to be replaced.
     * @param array<string, string> $tokenValues Associative array of token replacements.
     *
     * @return string Rendered template string with substituted values.
     *
     * @phpstan-param string[] $tokenValues
     */
    public static function render(string $template, array $tokenValues): string
    {
        $template = str_replace('\n', "\n", $template);
        $tokens = explode("\n", $template);

        $lines = [];

        foreach ($tokens as $token) {
            $value = strtr($token, $tokenValues);

            if ($value !== '') {
                $lines[] = $value;
            }
        }

        return implode(PHP_EOL, $lines);
    }
}
