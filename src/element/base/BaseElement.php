<?php

declare(strict_types=1);

namespace yii\ui\element\base;

use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\helpers\{Attributes, Encode};
use yii\ui\tag\{Block, Inline, Voids};

/**
 * Base class for standards-compliant HTML element rendering.
 *
 * Provides a unified, immutable API for generating block-level, inline-level, and void HTML elements according to the
 * HTML specification.
 *
 * Designed for use in widget, view, and tag rendering systems, this class ensures correct tag normalization, attribute
 * encoding, and type-safe handling of element categories.
 *
 * Key features:
 * - Exception-driven error handling for invalid tag usage.
 * - Integration with attribute and encoding helpers for safe output.
 * - Standards-compliant rendering of block, inline, and void elements.
 * - Supports both string and `UnitEnum` tag types for flexible API design.
 * - Tag normalization and validation against HTML specifications.
 *
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Block-level_content
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Inline-level_content
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Void_element
 * {@see InvalidArgumentException} for invalid value errors.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseElement
{
    /**
     * Renders the opening tag for a block-level HTML element.
     *
     * Validates the tag as block-level and generates the opening tag with encoded attributes.
     *
     * @param Block $tag Enum representing the block element.
     * @param array $attributes Associative array of HTML attributes.
     *
     * @return string Rendered opening tag for the block element.
     *
     * Usage example:
     * ```php
     * Element::begin(Block::DIV, ['class' => 'container']);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function begin(Block $tag, array $attributes = []): string
    {
        $renderAttributes = Attributes::render($attributes);

        return "<{$tag->value}{$renderAttributes}>";
    }

    /**
     * Renders the closing tag for a block-level HTML element.
     *
     * Validates the tag as block-level and generates the closing tag.
     *
     * @param Block $tag Enum representing the block element.
     *
     * @return string Rendered closing tag for the block element.
     *
     * Usage example:
     * ```php
     * Element::end(Block::DIV);
     * ```
     */
    public static function end(Block $tag): string
    {
        return "</{$tag->value}>";
    }

    /**
     * Renders an inline-level HTML element with content.
     *
     * Validates the tag as inline-level and generates the element with encoded attributes and optional content
     * encoding.
     *
     * @param Inline $tag Enum representing the inline element.
     * @param string $content Content to render inside the element.
     * @param array $attributes Associative array of HTML attributes.
     * @param bool $encode Whether to encode the content for safe HTML output.
     *
     * @return string Rendered inline element with content.
     *
     * Usage example:
     * ```php
     * Element::inline(Inline::SPAN, 'Hello, World!', ['class' => 'highlight']);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function inline(Inline $tag, string $content, array $attributes = [], bool $encode = false): string
    {
        if ($encode) {
            $content = Encode::content($content);
        }

        $renderAttributes = Attributes::render($attributes);

        return "<{$tag->value}{$renderAttributes}>{$content}</{$tag->value}>";
    }

    /**
     * Renders a void (self-closing) HTML element.
     *
     * Validates the tag as a void element and generates the self-closing tag with encoded attributes.
     *
     * @param Voids $tag Enum representing the void element.
     * @param array $attributes Associative array of HTML attributes.
     *
     * @return string Rendered void element.
     *
     * Usage example:
     * ```php
     * Element::void(Voids::IMG, ['src' => 'image.png', 'alt' => 'An image']);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function void(Voids $tag, array $attributes = []): string
    {
        $renderAttributes = Attributes::render($attributes);

        return "<{$tag->value}{$renderAttributes}>";
    }
}
