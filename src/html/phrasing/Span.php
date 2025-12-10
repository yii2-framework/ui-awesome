<?php

declare(strict_types=1);

namespace yii\ui\html\phrasing;

use yii\ui\element\BaseInline;
use yii\ui\tag\Inline;

/**
 * HTML `<span>` element implementation for inline phrasing content.
 *
 * Provides a concrete, type-safe implementation of the HTML `<span>` element, supporting flexible content injection
 * and attribute management for advanced rendering scenarios.
 *
 * Designed for integration in view renderers, tag systems, and component libraries, ensuring consistent and
 * standards-compliant handling of inline container elements according to the HTML specification.
 *
 * Key features.
 * - Immutable, stateless design for safe reuse in rendering engines.
 * - Standards-compliant rendering of the `<span>` HTML element.
 * - Supports arbitrary inline phrasing content and attribute sets.
 * - Type-safe methods for content and attribute management.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/span
 * {@see BaseInline} for the base implementation.
 * {@see Inline} for valid inline-level tags.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Span extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<span>` element.
     *
     * @return Inline Tag enumeration instance for `<span>`.
     */
    protected function getTag(): Inline
    {
        return Inline::SPAN;
    }

    /**
     * Renders the `<span>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<span>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
