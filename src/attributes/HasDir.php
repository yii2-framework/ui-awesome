<?php

declare(strict_types=1);

namespace yii\ui\attributes;

use UnitEnum;

/**
 * Trait for managing the global HTML `dir` attribute in tag rendering.
 *
 * Provides a standards-compliant, immutable API for setting the `dir` attribute on HTML elements, following the HTML
 * specification for global attributes.
 *
 * Intended for use in tags and components that require dynamic or programmatic manipulation of text directionality,
 * ensuring correct attribute handling, type safety, and value validation.
 *
 * Key features.
 * - Designed for use in tags and components.
 * - Enforces standards-compliant handling of the HTML `dir` global attribute.
 * - Immutable method for setting or overriding the `dir` attribute.
 * - Supports `string`, `UnitEnum`, and `null` values for flexible direction assignment.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/dir
 * @property array $attributes HTML attributes array used by the implementing class.
 * @phpstan-property mixed[] $attributes
 * {@see \yii\ui\mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasDir
{
    /**
     * Sets the HTML `dir` attribute for the element.
     *
     * Creates a new instance with the specified directionality value, supporting both explicit and nullable assignment
     * according to the HTML specification for global attributes.
     *
     * @param string|UnitEnum|null $value Directionality value to set for the element. Can be `null` to unset the
     * attribute.
     *
     * @return static New instance with the updated `dir` attribute.
     *
     * @link https://html.spec.whatwg.org/multipage/dom.html#the-dir-attribute
     */
    public function dir(string|UnitEnum|null $value): static
    {
        $new = clone $this;

        if ($value === null) {
            unset($new->attributes['dir']);
        } else {
            $new->attributes['dir'] = $value;
        }

        return $new;
    }
}
