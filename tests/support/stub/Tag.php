<?php

declare(strict_types=1);

namespace yii\ui\tests\support\stub;

use yii\ui\element\BaseInline;
use yii\ui\tag\Inline;

/**
 * Provides a stub implementation of an HTML `<span>` element for UI component and helper testing.
 *
 * This class serves as a test double for rendering and manipulating `<span>` tags, supporting scenarios involving
 * attribute handling, content rendering, and element lifecycle management.
 *
 * Key features.
 * - Delegates content and attribute rendering to the base element logic.
 * - Implements a flag property to track render state.
 * - Supplies a fixed tag type (`Inline::SPAN`) for consistent test behavior.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Tag extends BaseInline
{
    /**
     * Flag to indicate if the element has been rendered.
     */
    public bool $flag = false;

    /**
     * Internal flag to track if the element is disabled.
     *
     * @phpstan-ignore-next-line
     */
    private bool|null $flagDisabled = null;

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
