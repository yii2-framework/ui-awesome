<?php

declare(strict_types=1);

namespace yii\ui\mixin;

use Stringable;
use yii\ui\helpers\Encode;

/**
 * Trait for managing HTML element content in widget and tag rendering.
 *
 * Provides a standards-compliant, immutable API for setting the textual or raw HTML content of elements, following the
 * HTML specification for content assignment. Intended for use in widgets and components that require dynamic or
 * programmatic manipulation of element content, ensuring correct handling, type safety, and value encoding.
 *
 * Key features.
 * - Designed for use in widget and tag rendering systems.
 * - Enforces standards-compliant handling of HTML content assignment.
 * - Immutable methods for setting encoded (safe) or raw (HTML) content.
 * - Supports `string` and `Stringable` values for flexible content assignment.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/textContent
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Cross-site_scripting
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasContent
{
    /**
     * Content string assigned to the element.
     */
    protected string $content = '';

    /**
     * Sets the encoded (safe) content for the element.
     *
     * Creates a new instance with the specified content, encoding each value to prevent XSS and ensure
     * standards-compliant handling of textual content according to the HTML specification.
     *
     * @param string|Stringable ...$values Content values to set for the element. Each value is encoded for safety.
     *
     * @return static New instance with the updated encoded content.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/textContent
     * @link https://developer.mozilla.org/en-US/docs/Glossary/Cross-site_scripting
     */
    public function content(string|Stringable ...$values): static
    {
        $new = clone $this;

        foreach ($values as $value) {
            $new->content .= Encode::content((string) $value);
        }

        return $new;
    }

    /**
     * Returns the content assigned to the element.
     *
     * @return string Content value assigned to the element. Never `null`.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Sets the raw HTML content for the element.
     *
     * Creates a new instance with the specified content, assigning each value as raw HTML without encoding. Use with
     * caution to avoid XSS vulnerabilities. Intended for scenarios where trusted HTML is required.
     *
     * @param string|Stringable ...$values Content values to set for the element as raw HTML.
     *
     * @return static New instance with the updated raw HTML content.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML
     * @link https://developer.mozilla.org/en-US/docs/Glossary/Cross-site_scripting
     */
    public function html(string|Stringable ...$values): static
    {
        $new = clone $this;

        foreach ($values as $value) {
            $new->content .= $value;
        }

        return $new;
    }
}
