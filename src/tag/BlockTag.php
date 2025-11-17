<?php

declare(strict_types=1);

namespace yii\ui\tag;

use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;

use function strtolower;

/**
 * Enum representing all supported HTML block-level tags for rendering and validation.
 *
 * Provides a type-safe, standards-compliant set of block-level HTML tag names for use in tag rendering systems,
 * attribute validation, and widget construction. Ensures consistent handling of block-level elements in HTML5 contexts,
 * supporting strict type safety and predictable output for tag-based operations.
 *
 * Key features:
 * - Comprehensive coverage of HTML block-level tags as defined by the HTML5 specification.
 * - Designed for integration with advanced attribute and element rendering systems.
 * - Type-safe enumeration for tag validation and rendering.
 * - Utility method for block-level tag detection supporting case-insensitive matching.
 *
 * {@see https://developer.mozilla.org/en-US/docs/Web/HTML/Block-level_elements} HTML Block-level Elements.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum BlockTag: string
{
    /**
     * Case for the `<address>` HTML tag.
     */
    case ADDRESS = 'address';

    /**
     * Case for the `<article>` HTML tag.
     */
    case ARTICLE = 'article';

    /**
     * Case for the `<aside>` HTML tag.
     */
    case ASIDE = 'aside';

    /**
     * Case for the `<blockquote>` HTML tag.
     */
    case BLOCKQUOTE = 'blockquote';

    /**
     * Case for the `<canvas>` HTML tag.
     */
    case CANVAS = 'canvas';

    /**
     * Case for the `<dd>` HTML tag.
     */
    case DD = 'dd';

    /**
     * Case for the `<div>` HTML tag.
     */
    case DIV = 'div';

    /**
     * Case for the `<dl>` HTML tag.
     */
    case DL = 'dl';

    /**
     * Case for the `<dt>` HTML tag.
     */
    case DT = 'dt';

    /**
     * Case for the `<fieldset>` HTML tag.
     */
    case FIELDSET = 'fieldset';

    /**
     * Case for the `<figcaption>` HTML tag.
     */
    case FIGCAPTION = 'figcaption';

    /**
     * Case for the `<figure>` HTML tag.
     */
    case FIGURE = 'figure';

    /**
     * Case for the `<footer>` HTML tag.
     */
    case FOOTER = 'footer';

    /**
     * Case for the `<form>` HTML tag.
     */
    case FORM = 'form';

    /**
     * Case for the `<h1>` HTML tag.
     */
    case H1 = 'h1';

    /**
     * Case for the `<h2>` HTML tag.
     */
    case H2 = 'h2';

    /**
     * Case for the `<h3>` HTML tag.
     */
    case H3 = 'h3';

    /**
     * Case for the `<h4>` HTML tag.
     */
    case H4 = 'h4';

    /**
     * Case for the `<h5>` HTML tag.
     */
    case H5 = 'h5';

    /**
     * Case for the `<h6>` HTML tag.
     */
    case H6 = 'h6';

    /**
     * Case for the `<header>` HTML tag.
     */
    case HEADER = 'header';

    /**
     * Case for the `<hr>` HTML tag.
     */
    case HR = 'hr';

    /**
     * Case for the `<li>` HTML tag.
     */
    case LI = 'li';

    /**
     * Case for the `<main>` HTML tag.
     */
    case MAIN = 'main';

    /**
     * Case for the `<nav>` HTML tag.
     */
    case NAV = 'nav';

    /**
     * Case for the `<noscript>` HTML tag.
     */
    case NOSCRIPT = 'noscript';

    /**
     * Case for the `<ol>` HTML tag.
     */
    case OL = 'ol';

    /**
     * Case for the `<p>` HTML tag.
     */
    case P = 'p';

    /**
     * Case for the `<pre>` HTML tag.
     */
    case PRE = 'pre';

    /**
     * Case for the `<section>` HTML tag.
     */
    case SECTION = 'section';

    /**
     * Case for the `<table>` HTML tag.
     */
    case TABLE = 'table';

    /**
     * Case for the `<tfoot>` HTML tag.
     */
    case TFOOT = 'tfoot';

    /**
     * Case for the `<ul>` HTML tag.
     */
    case UL = 'ul';

    /**
     * Case for the `<video>` HTML tag.
     */
    case VIDEO = 'video';

    /**
     * Determines whether a given tag name is a supported block-level HTML tag.
     *
     * Provides a case-insensitive check against the set of defined block-level tags, supporting validation and
     * rendering logic for HTML tag-based systems.
     *
     * @param string $tag Tag name to validate.
     *
     * @throws InvalidArgumentException if the tag name is empty.
     *
     * @return bool `true` if the tag is a supported block-level tag, `false` otherwise.
     */
    public static function isBlock(string $tag): bool
    {
        if ($tag === '') {
            throw new InvalidArgumentException(Message::EMPTY_TAG_NAME->getMessage());
        }

        return self::tryFrom(strtolower($tag)) !== null;
    }
}
