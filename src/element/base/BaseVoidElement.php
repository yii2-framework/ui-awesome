<?php

declare(strict_types=1);

namespace yii\ui\element\base;

use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\element\tag\VoidTag;
use yii\ui\exception\Message;
use yii\ui\helpers\{Attributes, Enum};

/**
 * Base class for standardized rendering of HTML void elements.
 *
 * Provides a strict, type-safe API for generating void (self-closing) HTML tags according to the HTML specification and
 * semantics.
 *
 * Ensures that only valid void elements are rendered, enforcing semantic correctness and preventing misuse of non-void
 * elements with void syntax.
 *
 * Void elements are those that cannot have any child nodes or content, and are always self-closing as defined by the
 * HTML standard.
 *
 * Key features:
 * - Exception-driven error handling for invalid tag usage.
 * - Immutable, static API for safe integration in widget, view, and markup systems.
 * - Standards-compliant attribute rendering for void elements.
 * - Validation of tag type against void element semantics (per MDN specification).
 *
 * {@see https://developer.mozilla.org/en-US/docs/Glossary/Void_element} for void element specification.
 * {@see InvalidArgumentException} for invalid tag errors.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseVoidElement
{
    /**
     * Renders a void (self-closing) HTML element with validated tag and rendered attributes.
     *
     * Validates that the provided tag is a void element according to the HTML specification.
     *
     * @param string|UnitEnum $tag Void HTML tag name to render.
     * @param array $attributes Associative array of HTML attributes to include.
     *
     * @throws InvalidArgumentException if the tag is not a void element.
     *
     * @return string Rendered void HTML tag with attributes.
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function render(string|UnitEnum $tag, array $attributes = []): string
    {
        $tag = (string) Enum::normalizeValue($tag);

        if (VoidTag::isVoid($tag) === false) {
            throw new InvalidArgumentException(Message::INVALID_VOID_ELEMENT->getMessage($tag));
        }

        $renderAttributes = Attributes::render($attributes);

        return "<{$tag}{$renderAttributes}>";
    }
}
