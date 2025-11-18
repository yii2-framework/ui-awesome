<?php

declare(strict_types=1);

namespace yii\ui\content\flow;

use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;

use function strtolower;

/**
 * Enum representing all supported HTML inline-level tags for rendering and validation.
 *
 * Defines a comprehensive set of inline-level HTML elements as specified by the HTML standard and MDN documentation,
 * supporting validation and rendering logic for standards-compliant document generation.
 *
 * This enum is designed for use in view renderers, widget systems, and asset managers that require precise handling of
 * inline elements within flow content categories.
 *
 * Key features:
 * - Enumerates all inline-level tags recognized in flow content per HTML specification.
 * - Integrates with validation and normalization routines for predictable layout behavior.
 * - Provides immutable, type-safe API for robust HTML generation workflows.
 * - Strict adherence to inline element semantics for technical consistency.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Guides/Content_categories#flow_content
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum InlineContent: string
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
     * Case for the `<i>` HTML tag.
     */
    case I = 'i';

    /**
     * Case for the `<iframe>` HTML tag.
     */
    case IFRAME = 'iframe';

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
     * Case for the `<samp>` HTML tag.
     */
    case SAMP = 'samp';

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
     * Case for the `<time>` HTML tag.
     */
    case TIME = 'time';

    /**
     * Case for the `<var>` HTML tag.
     */
    case VAR_ = 'var';

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
     * if (InlineContent::isInline('span')) {
     *     // valid inline content
     * }
     * ```
     */
    public static function isInline(string $tag): bool
    {
        if ($tag === '') {
            throw new InvalidArgumentException(Message::EMPTY_TAG_NAME->getMessage());
        }

        return self::tryFrom(strtolower($tag)) !== null;
    }
}
