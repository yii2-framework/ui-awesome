<?php

declare(strict_types=1);

namespace yii\ui\element\base;

use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;
use yii\ui\helpers\{Attributes, Encode, Enum};
use yii\ui\tag\{InlineTag, VoidTag};

/**
 * Base class for standardized rendering of HTML inline-level elements.
 *
 * Provides a strict, type-safe API for generating inline-level HTML tags according to the HTML specification and CSS
 * inline formatting context.
 *
 * Ensures that only valid inline-level tags are rendered, enforcing semantic correctness and preventing misuse of block
 * or void elements with inline syntax.
 *
 * Inline-level elements participate in the flow of text and do not start on a new line, occupying only the space
 * bounded by their content, as defined by CSS and HTML standards.
 *
 * This class abstracts the complexity of inline-level tag generation, supporting robust, maintainable HTML output in UI
 * frameworks.
 *
 * Key features:
 * - Exception-driven error handling for invalid tag usage.
 * - Immutable, static API for safe integration in widget, view, and markup systems.
 * - Standards-compliant attribute rendering for inline elements.
 * - Validation of tag type against inline-level semantics (per MDN specification).
 *
 * {@see https://developer.mozilla.org/en-US/docs/Glossary/Inline-level_content} for inline-level content specification.
 * {@see InvalidArgumentException} for invalid tag errors.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseInlineElement
{
    /**
     * Renders an inline-level HTML element with validated tag, content, and attributes.
     *
     * Validates that the provided tag is an inline-level element according to the HTML specification.
     *
     * Renders the opening and closing tag with all attributes in standards-compliant order and encoding.
     *
     * @param string|UnitEnum $tag Inline-level HTML tag name to render.
     * @param string $content Content to be enclosed within the tag.
     * @param array $attributes Associative array of HTML attributes to include.
     * @param bool $encode Whether to encode the content for HTML output.
     *
     * @throws InvalidArgumentException if the tag is not an inline-level element or is a void element.
     *
     * @return string Rendered inline-level HTML tag with content and attributes.
     *
     * Usage example:
     * ```php
     * Inline::tag('span', 'Hello, World!', ['class' => 'highlight'], true);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function tag(
        string|UnitEnum $tag,
        string $content,
        array $attributes = [],
        bool $encode = false,
    ): string {
        $tag = (string) Enum::normalizeValue($tag);

        if (InlineTag::isInline($tag) === false) {
            throw new InvalidArgumentException(Message::INVALID_INLINE_ELEMENT->getMessage($tag));
        }

        if (VoidTag::isVoid($tag)) {
            throw new InvalidArgumentException(Message::VOID_ELEMENT_CANNOT_HAVE_CONTENT->getMessage($tag));
        }

        if ($encode) {
            $content = Encode::content($content);
        }

        $renderAttributes = Attributes::render($attributes);

        return "<{$tag}{$renderAttributes}>{$content}</{$tag}>";
    }

    /**
     * Renders a void inline-level HTML element with validated tag and attributes.
     *
     * Validates that the provided tag is a void element according to the HTML specification.
     *
     * Renders the tag with all attributes in standards-compliant order and encoding.
     *
     * @param string|UnitEnum $tag Void HTML tag name to render.
     * @param array $attributes Associative array of HTML attributes to include.
     *
     * @throws InvalidArgumentException if the tag is not a void element.
     *
     * @return string Rendered void HTML tag with attributes.
     *
     * Usage example:
     * ```php
     * Inline::void('br', ['class' => 'line-break']);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function void(string|UnitEnum $tag, array $attributes = []): string
    {
        $tag = (string) Enum::normalizeValue($tag);

        if (VoidTag::isVoid($tag) === false) {
            throw new InvalidArgumentException(Message::INVALID_VOID_ELEMENT->getMessage($tag));
        }

        $renderAttributes = Attributes::render($attributes);

        return "<{$tag}{$renderAttributes}>";
    }
}
