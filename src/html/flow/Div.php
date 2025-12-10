<?php

declare(strict_types=1);

namespace yii\ui\html\flow;

use yii\ui\element\BaseBlock;
use yii\ui\tag\Block;

/**
 * HTML `<div>` element implementation for block-level flow content.
 *
 * Provides a concrete, type-safe implementation of the HTML `<div>` element, supporting flexible content injection and
 * attribute management for advanced rendering scenarios.
 *
 * Designed for integration in view renderers, tag systems, and component libraries, ensuring consistent and
 * standards-compliant handling of block container elements according to the HTML specification.
 *
 * Key features.
 * - Immutable, stateless design for safe reuse in rendering engines.
 * - Standards-compliant rendering of the `<div>` HTML element.
 * - Supports arbitrary block-level content and attribute sets.
 * - Type-safe methods for content and attribute management.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/div
 * {@see BaseBlock} for the base implementation.
 * {@see Block} for valid block-level tags.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Div extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<div>` element.
     *
     * @return Block Tag enumeration instance for `<div>`.
     */
    protected function getTag(): Block
    {
        return Block::DIV;
    }
}
