<?php

declare(strict_types=1);

namespace yii\ui\element\base;

use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;
use yii\ui\helpers\{Attributes, Encode, Enum};
use yii\ui\tag\{Block, Inline, Voids};

use function strtolower;

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
     * @param string|UnitEnum $tag Tag name or enum representing the block element.
     * @param array $attributes Associative array of HTML attributes.
     *
     * @throws InvalidArgumentException if the tag is not a valid block-level element or is empty.
     *
     * @return string Rendered opening tag for the block element.
     *
     * Usage example:
     * ```php
     * Element::begin('div', ['class' => 'container']);
     * Element::begin(Block::DIV, ['class' => 'container']);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function begin(string|UnitEnum $tag, array $attributes = []): string
    {
        $tagName = self::normalizeTag($tag);

        self::validateBlockTag($tagName);

        $renderAttributes = Attributes::render($attributes);

        return "<{$tagName}{$renderAttributes}>";
    }

    /**
     * Renders the closing tag for a block-level HTML element.
     *
     * Validates the tag as block-level and generates the closing tag.
     *
     * @param string|UnitEnum $tag Tag name or enum representing the block element.
     *
     * @throws InvalidArgumentException if the tag is not a valid block-level element or is empty.
     *
     * @return string Rendered closing tag for the block element.
     *
     * Usage example:
     * ```php
     * Element::end('div');
     * Element::end(Block::DIV);
     * ```
     */
    public static function end(string|UnitEnum $tag): string
    {
        $tagName = self::normalizeTag($tag);

        self::validateBlockTag($tagName);

        return "</{$tagName}>";
    }

    /**
     * Renders an inline-level HTML element with content.
     *
     * Validates the tag as inline-level and generates the element with encoded attributes and optional content
     * encoding.
     *
     * @param string|UnitEnum $tag Tag name or enum representing the inline element.
     * @param string $content Content to render inside the element.
     * @param array $attributes Associative array of HTML attributes.
     * @param bool $encode Whether to encode the content for safe HTML output.
     *
     * @throws InvalidArgumentException if the tag is not a valid inline-level element or is empty.
     *
     * @return string Rendered inline element with content.
     *
     * Usage example:
     * ```php
     * Element::inline('span', 'Hello, World!', ['class' => 'highlight']);
     * Element::inline(Inline::SPAN, 'Hello, World!', ['class' => 'highlight'], true);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function inline(
        string|UnitEnum $tag,
        string $content,
        array $attributes = [],
        bool $encode = false,
    ): string {
        $tagName = self::normalizeTag($tag);

        if (Inline::isInline($tagName) === false) {
            throw new InvalidArgumentException(Message::INVALID_INLINE_ELEMENT->getMessage($tagName));
        }

        if ($encode) {
            $content = Encode::content($content);
        }

        $renderAttributes = Attributes::render($attributes);

        return "<{$tagName}{$renderAttributes}>{$content}</{$tagName}>";
    }

    /**
     * Renders a void (self-closing) HTML element.
     *
     * Validates the tag as a void element and generates the self-closing tag with encoded attributes.
     *
     * @param string|UnitEnum $tag Tag name or enum representing the void element.
     * @param array $attributes Associative array of HTML attributes.
     *
     * @throws InvalidArgumentException if the tag is not a valid void element or is empty.
     *
     * @return string Rendered void element.
     *
     * Usage example:
     * ```php
     * Element::void('img', ['src' => 'image.png', 'alt' => 'An image']);
     * Element::void(Voids::IMG, ['src' => 'image.png', 'alt' => 'An image']);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function void(string|UnitEnum $tag, array $attributes = []): string
    {
        $tagName = self::normalizeTag($tag);

        if (Voids::isVoid($tagName) === false) {
            throw new InvalidArgumentException(Message::INVALID_VOID_ELEMENT->getMessage($tagName));
        }

        $renderAttributes = Attributes::render($attributes);

        return "<{$tagName}{$renderAttributes}>";
    }

    /**
     * Normalizes and validates the tag name.
     *
     * Converts the tag to a lowercase string and validates non-empty value.
     *
     * @param string|UnitEnum $tag Tag name or enum to normalize.
     *
     * @throws InvalidArgumentException if the tag name is empty.
     *
     * @return string Normalized tag name.
     */
    private static function normalizeTag(string|UnitEnum $tag): string
    {
        if ($tag === '') {
            throw new InvalidArgumentException(Message::EMPTY_TAG_NAME->getMessage());
        }

        $tag = (string) Enum::normalizeValue($tag);

        return strtolower($tag);
    }

    /**
     * Validates that the tag is a block-level element.
     *
     * @param string $tag Tag name to validate.
     *
     * @throws InvalidArgumentException if the tag is not a valid block-level element.
     */
    private static function validateBlockTag(string $tag): void
    {
        if (Block::isBlock($tag) === false) {
            throw new InvalidArgumentException(Message::INVALID_BLOCK_ELEMENT->getMessage($tag));
        }
    }
}
