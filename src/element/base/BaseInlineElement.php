<?php

declare(strict_types=1);

namespace yii\ui\element\base;

use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\content\flow\InlineContent;
use yii\ui\exception\Message;
use yii\ui\helpers\{Attributes, Encode, Enum};

/**
 * Base class for standardized rendering of HTML inline-level elements.
 *
 * Provides a strict, type-safe API for generating inline-level HTML tags according to the HTML specification and CSS
 * inline formatting context.
 *
 * Ensures that only valid inline-level tags are rendered, enforcing semantic correctness and preventing misuse of block
 * elements with inline syntax.
 *
 * Inline-level elements do not start on a new line and only occupy the space bounded by their content, participating in
 * horizontal inline layout as defined by CSS.
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
     * Renders an inline-level HTML element with validated tag, attributes, and content.
     *
     * Validates that the provided tag is an inline-level element according to the HTML specification.
     *
     * @param string|UnitEnum $tag Inline-level HTML tag name to render.
     * @param string $content Content to be enclosed within the inline element.
     * @param array $attributes Associative array of HTML attributes to include.
     * @param bool $encode Whether to encode the content for safe HTML output (default: `false`).
     *
     * @throws InvalidArgumentException if the tag is not an inline-level element or tag name is empty.
     *
     * @return string Rendered inline-level HTML element with attributes and content.
     *
     * Usage example:
     * ```php
     * InlineElement::render('span', 'Hello, World!', ['class' => 'highlight']);
     * InlineElement::render(InlineTag::SPAN, 'Hello, World!', ['class' => 'highlight'], true);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function render(
        string|UnitEnum $tag,
        string $content,
        array $attributes = [],
        bool $encode = false,
    ): string {
        $tag = (string) Enum::normalizeValue($tag);

        if (InlineContent::isInline($tag) === false) {
            throw new InvalidArgumentException(Message::INVALID_INLINE_ELEMENT->getMessage($tag));
        }

        if ($encode) {
            $content = Encode::content($content);
        }

        $renderAttributes = Attributes::render($attributes);

        return "<{$tag}{$renderAttributes}>{$content}</{$tag}>";
    }
}
