<?php

declare(strict_types=1);

namespace yii\ui\attributes;

/**
 * Trait for managing the global HTML `id` attribute in widget and tag rendering.
 *
 * Provides a standards-compliant, immutable API for setting the `id` attribute on HTML elements, following the HTML
 * specification for global attributes. Intended for use in widgets and components that require dynamic or programmatic
 * manipulation of element identifiers, ensuring correct attribute handling, type safety, and value validation.
 *
 * Key features:
 * - Designed for use in widget and tag rendering systems.
 * - Enforces standards-compliant handling of the HTML `id` global attribute.
 * - Immutable method for setting or overriding the `id` attribute.
 * - Supports `string` and `null` values for flexible identifier assignment.
 *
 * @property array $attributes HTML attributes array used by the implementing class.
 * @phpstan-property mixed[] $attributes
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/id
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasId
{
    /**
     * Sets the HTML `id` attribute for the element.
     *
     * Creates a new instance with the specified identifier value, supporting both explicit and nullable assignment
     * according to the HTML specification for global attributes.
     *
     * @param string|null $value Identifier value to set for the element. Can be `null` to unset the attribute.
     *
     * @return static New instance with the updated `id` attribute.
     *
     * @link https://html.spec.whatwg.org/multipage/dom.html#the-id-attribute
     */
    public function id(string|null $value): static
    {
        $new = clone $this;
        $new->attributes['id'] = $value;

        if ($value === null) {
            unset($new->attributes['id']);
        }

        return $new;
    }
}
