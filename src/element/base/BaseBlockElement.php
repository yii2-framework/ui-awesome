<?php

declare(strict_types=1);

namespace yii\ui\element\base;

use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;
use yii\ui\helpers\{Attributes, Enum};
use yii\ui\tag\BlockTag;

/**
 * Base class for standardized rendering of HTML block-level elements.
 *
 * Provides a strict, type-safe API for generating block-level HTML tags according to the HTML specification and CSS
 * block formatting context.
 *
 * Ensures that only valid block-level tags are rendered, enforcing semantic correctness and preventing misuse of inline
 * elements with block syntax.
 *
 * Block-level elements always start on a new line and occupy the full horizontal space of their parent container,
 * participating in vertical block layout as defined by CSS.
 *
 * This class abstracts the complexity of block-level tag generation, supporting robust, maintainable HTML output in UI
 * frameworks.
 *
 * Key features:
 * - Exception-driven error handling for invalid tag usage.
 * - Immutable, static API for safe integration in widget, view, and markup systems.
 * - Standards-compliant attribute rendering for block elements.
 * - Validation of tag type against block-level semantics (per MDN specification).
 *
 * {@see https://developer.mozilla.org/en-US/docs/Glossary/Block-level_content} for block-level content specification.
 * {@see InvalidArgumentException} for invalid tag errors.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseBlockElement
{
    /**
     * Begins a block-level HTML element with validated tag and rendered attributes.
     *
     * Validates that the provided tag is a block-level element according to the HTML specification.
     *
     * Renders the opening tag with all attributes in standards-compliant order and encoding.
     *
     * @param string|UnitEnum $tag Block-level HTML tag name to render.
     * @param array $attributes Associative array of HTML attributes to include.
     *
     * @throws InvalidArgumentException if the tag is not a block-level element.
     *
     * @return string Rendered opening block-level HTML tag with attributes.
     *
     * Usage example:
     * ```php
     * Block::begin('div', ['class' => 'container']);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function begin(string|UnitEnum $tag, array $attributes = []): string
    {
        $tag = self::assertBlock($tag);

        $renderAttributes = Attributes::render($attributes);

        return "<{$tag}{$renderAttributes}>";
    }

    /**
     * Ends a block-level HTML element with validated tag.
     *
     * Validates that the provided tag is a block-level element according to the HTML specification.
     *
     * Renders the closing tag for the block-level element.
     *
     * @param string $tag Block-level HTML tag name to close.
     *
     * @throws InvalidArgumentException if the tag is not a block-level element.
     *
     * @return string Rendered closing block-level HTML tag.
     *
     * Usage example:
     * ```php
     * Block::end('div');
     * ```
     */
    public static function end(string $tag): string
    {
        $tag = self::assertBlock($tag);

        return "</{$tag}>";
    }

    /**
     * Asserts that the provided tag is a valid block-level HTML element.
     *
     * @param string|UnitEnum $tag HTML tag name to validate.
     *
     * @throws InvalidArgumentException if the tag is not a block-level element.
     *
     * @return string Validated block-level HTML tag name.
     */
    private static function assertBlock(string|UnitEnum $tag): string
    {
        $tag = (string) Enum::normalizeValue($tag);

        if (BlockTag::isBlock($tag) === false) {
            throw new InvalidArgumentException(
                Message::INVALID_BLOCK_ELEMENT->getMessage($tag),
            );
        }

        return $tag;
    }
}
