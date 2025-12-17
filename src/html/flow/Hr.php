<?php

declare(strict_types=1);

namespace yii\ui\html\flow;

use yii\ui\element\BaseVoid;
use yii\ui\tag\Voids;

/**
 * HTML `<hr>` element implementation for thematic break (horizontal rule) flow content.
 *
 * Provides a concrete, type-safe implementation of the HTML `<hr>` void element, supporting standards-compliant
 * rendering for thematic breaks within flow content according to the HTML specification.
 *
 * Designed for integration in view renderers, tag systems, and component libraries, ensuring consistent and
 * standards-compliant handling of horizontal rule elements.
 *
 * Key features:
 * - Immutable, stateless design for safe reuse in rendering engines.
 * - Standards-compliant rendering of the `<hr>` HTML element.
 * - Supports attribute management for void elements.
 * - Type-safe methods for attribute management.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/hr
 * {@see BaseVoid} for the base implementation.
 * {@see Voids} for valid void-level tags.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Hr extends BaseVoid
{
    /**
     * Returns the tag enumeration for the `<hr>` element.
     *
     * @return Voids Tag enumeration instance for `<hr>`.
     */
    protected function getTag(): Voids
    {
        return Voids::HR;
    }
}
