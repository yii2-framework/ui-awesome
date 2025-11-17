<?php

declare(strict_types=1);

namespace yii\ui\tag;

use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;

use function strtolower;

/**
 * Enum representing all supported HTML inline tags for rendering and validation.
 *
 * Provides a type-safe, standards-compliant set of inline HTML tag names for use in tag rendering systems, attribute
 * validation, and widget construction. Ensures consistent handling of inline elements in HTML5 contexts, supporting
 * strict type safety and predictable output for tag-based operations.
 *
 * Key features:
 * - Comprehensive coverage of HTML inline tags as defined by HTML5 specification.
 * - Designed for integration with advanced attribute and element rendering systems.
 * - Type-safe enumeration for tag validation and rendering.
 * - Utility method for inline tag detection supporting case-insensitive matching.
 *
 * {@see https://developer.mozilla.org/en-US/docs/Web/HTML/Inline_elements} HTML Inline Elements.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum InlineTag: string
{
    /**
     * Case for the `<a>` HTML tag.
     */
    case A = 'a';

    /**
     * Case for the `<abbr>` HTML tag.
     */
    case ABBR = 'abbr';

    /**
     * Case for the `<b>` HTML tag.
     */
    case B = 'b';

    /**
     * Case for the `<bdi>` HTML tag.
     */
    case BDI = 'bdi';

    /**
     * Case for the `<bdo>` HTML tag.
     */
    case BDO = 'bdo';

    /**
     * Case for the `<big>` HTML tag.
     */
    case BIG = 'big';

    /**
     * Case for the `<br>` HTML tag.
     */
    case BR = 'br';

    /**
     * Case for the `<button>` HTML tag.
     */
    case BUTTON = 'button';

    /**
     * Case for the `<cite>` HTML tag.
     */
    case CITE = 'cite';

    /**
     * Case for the `<code>` HTML tag.
     */
    case CODE = 'code';

    /**
     * Case for the `<data>` HTML tag.
     */
    case DATA = 'data';

    /**
     * Case for the `<datalist>` HTML tag.
     */
    case DATALIST = 'datalist';

    /**
     * Case for the `<del>` HTML tag.
     */
    case DEL = 'del';

    /**
     * Case for the `<dfn>` HTML tag.
     */
    case DFN = 'dfn';

    /**
     * Case for the `<em>` HTML tag.
     */
    case EM = 'em';

    /**
     * Case for the `<embed>` HTML tag.
     */
    case EMBED = 'embed';

    /**
     * Case for the `<i>` HTML tag.
     */
    case I = 'i';

    /**
     * Case for the `<iframe>` HTML tag.
     */
    case IFRAME = 'iframe';

    /**
     * Case for the `<img>` HTML tag.
     */
    case IMG = 'img';

    /**
     * Case for the `<input>` HTML tag.
     */
    case INPUT = 'input';

    /**
     * Case for the `<ins>` HTML tag.
     */
    case INS = 'ins';

    /**
     * Case for the `<kbd>` HTML tag.
     */
    case KBD = 'kbd';

    /**
     * Case for the `<label>` HTML tag.
     */
    case LABEL = 'label';

    /**
     * Case for the `<map>` HTML tag.
     */
    case MAP = 'map';

    /**
     * Case for the `<mark>` HTML tag.
     */
    case MARK = 'mark';

    /**
     * Case for the `<meter>` HTML tag.
     */
    case METER = 'meter';

    /**
     * Case for the `<noscript>` HTML tag.
     */
    case NOSCRIPT = 'noscript';

    /**
     * Case for the `<object>` HTML tag.
     */
    case OBJECT = 'object';

    /**
     * Case for the `<option>` HTML tag.
     */
    case OPTION = 'option';

    /**
     * Case for the `<output>` HTML tag.
     */
    case OUTPUT = 'output';

    /**
     * Case for the `<picture>` HTML tag.
     */
    case PICTURE = 'picture';

    /**
     * Case for the `<progress>` HTML tag.
     */
    case PROGRESS = 'progress';

    /**
     * Case for the `<q>` HTML tag.
     */
    case Q = 'q';

    /**
     * Case for the `<ruby>` HTML tag.
     */
    case RUBY = 'ruby';

    /**
     * Case for the `<s>` HTML tag.
     */
    case S = 's';

    /**
     * Case for the `<samp>` HTML tag.
     */
    case SAMP = 'samp';

    /**
     * Case for the `<slot>` HTML tag.
     */
    case SLOT = 'slot';

    /**
     * Case for the `<small>` HTML tag.
     */
    case SMALL = 'small';

    /**
     * Case for the `<span>` HTML tag.
     */
    case SPAN = 'span';

    /**
     * Case for the `<strong>` HTML tag.
     */
    case STRONG = 'strong';

    /**
     * Case for the `<sub>` HTML tag.
     */
    case SUB = 'sub';

    /**
     * Case for the `<sup>` HTML tag.
     */
    case SUP = 'sup';

    /**
     * Case for the `<svg>` HTML tag.
     */
    case SVG = 'svg';

    /**
     * Case for the `<template>` HTML tag.
     */
    case TEMPLATE = 'template';

    /**
     * Case for the `<time>` HTML tag.
     */
    case TIME = 'time';

    /**
     * Case for the `<tt>` HTML tag.
     */
    case TT = 'tt';

    /**
     * Case for the `<u>` HTML tag.
     */
    case U = 'u';

    /**
     * Case for the `<var>` HTML tag.
     */
    case VAR_ = 'var';

    /**
     * Case for the `<wbr>` HTML tag.
     */
    case WBR = 'wbr';

    /**
     * Determines whether a given tag name is a supported inline HTML tag.
     *
     * Provides a case-insensitive check against the set of defined inline tags, supporting validation and rendering
     * logic for HTML tag-based systems.
     *
     * @param string $tag Tag name to validate.
     *
     * @throws InvalidArgumentException if the tag name is empty.
     *
     * @return bool `true` if the tag is a supported inline tag, `false` otherwise.
     *
     * Usage example:
     * ```php
     * if (InlineTag::isInline('span')) {
     *     // Valid inline tag
     * }
     * ```
     */
    public static function isInline(string $tag): bool
    {
        if ($tag === '') {
            throw new InvalidArgumentException(Message::EMPTY_TAG_NAME->getMessage());
        }

        $tag = strtolower($tag);

        foreach (self::cases() as $case) {
            if ($case->value === $tag) {
                return true;
            }
        }

        return false;
    }
}
