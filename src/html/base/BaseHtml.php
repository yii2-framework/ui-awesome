<?php

declare(strict_types=1);

namespace yii\ui\html\base;

use yii\ui\helpers\{Attributes, Encode};
use yii\ui\tag\{Block, Inline, Lists, Root, Table, Voids};

/**
 * Base class for standards-compliant HTML rendering.
 *
 * Provides a unified, immutable API for generating block-level, inline-level, list-level, root-level, table-level, and
 * void HTML elements according to the HTML specification.
 *
 * Designed for use in widget, view, and tag rendering systems, this class ensures correct tag normalization, attribute
 * encoding, and type-safe handling of element categories.
 *
 * Key features:
 * - Exception-driven error handling for invalid tag usage.
 * - Integration with attribute and encoding helpers for safe output.
 * - Standards-compliant rendering of block, inline, list, root, table and void elements.
 * - Support `UnitEnum` tag types for flexible API design.
 *
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Block-level_content
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Inline-level_content
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Void_element
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements#main_root
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements#table_content
 * {@see InvalidArgumentException} for invalid value errors.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseHtml
{
    /**
     * Renders the opening tag for a block-level, list-level, root-level, or table-level.
     *
     * Validates the tag as block-level, list-level, root-level, or table-level and generates the opening tag with
     * encoded attributes.
     *
     * @param Block|Lists|Root|Table $tag Enum representing the block, list, root or table tag.
     * @param array $attributes Associative array of HTML attributes.
     *
     * @return string Rendered opening tag for the block, list, root or table tag.
     *
     * {@see Block} for valid block-level tags.
     * {@see Lists} for valid list-level tags.
     * {@see Root} for valid root-level tags.
     * {@see Table} for valid table-level tags.
     *
     * Usage example:
     * ```php
     * Html::begin(Block::DIV, ['class' => 'container']);
     * Html::begin(Lists::UL, ['class' => 'list']);
     * Html::begin(Root::HTML, ['lang' => 'en']);
     * Html::begin(Table::TABLE, ['class' => 'table']);
     * ```
     *
     * @phpstan-param mixed[] $attributes
     */
    public static function begin(Block|Lists|Root|Table $tag, array $attributes = []): string
    {
        $renderAttributes = Attributes::render($attributes);

        return "<{$tag->value}{$renderAttributes}>";
    }

    /**
     * Renders the closing tag for a block-level, list-level, root-level, or table-level.
     *
     * Validates the tag as block-level, list-level, root-level, or table-level and generates the closing tag.
     *
     * @param Block|Lists|Root|Table $tag Enum representing the block, list, root, or table tag.
     *
     * @return string Rendered closing tag for the block, list, root, or table tag.
     *
     * {@see Block} for valid block-level tags.
     * {@see Lists} for valid list-level tags.
     * {@see Root} for valid root-level tags.
     * {@see Table} for valid table-level tags.
     *
     * Usage example:
     * ```php
     * Html::end(Block::DIV);
     * Html::end(Lists::UL);
     * Html::end(Root::HTML);
     * Html::end(Table::TABLE);
     * ```
     */
    public static function end(Block|Lists|Root|Table $tag): string
    {
        return "</{$tag->value}>";
    }

    /**
     * Renders an inline-level HTML tag with content.
     *
     * Validates the tag as inline-level and generates the tag with encoded attributes and optional content encoding.
     *
     * @param Inline $tag Enum representing the inline tag.
     * @param string $content Content to render inside the tag.
     * @param array $attributes Associative array of HTML attributes.
     * @param bool $encode Whether to encode the content for safe HTML output.
     *
     * @return string Rendered inline tag with content.
     *
     * {@see Inline} for valid inline-level tags.
     *
     * Usage example:
     * ```php
     * Html::inline(Inline::SPAN, 'Hello, World!', ['class' => 'highlight']);
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
     * Renders a void (self-closing) tag.
     *
     * Validates the tag as a void tag and generates the self-closing tag with encoded attributes.
     *
     * @param Voids $tag Enum representing the void tag.
     * @param array $attributes Associative array of HTML attributes.
     *
     * @return string Rendered void tag.
     *
     * {@see Voids} for valid void-level tags.
     *
     * Usage example:
     * ```php
     * Html::void(Voids::IMG, ['src' => 'image.png', 'alt' => 'An image']);
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
