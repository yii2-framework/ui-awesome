<?php

declare(strict_types=1);

namespace yii\ui\tag;

use function in_array;

/**
 * Centralized enumeration for HTML, SVG, and MathML tag names.
 *
 * Provides a type-safe, standards-compliant API for representing and validating tag names used in widget, rendering,
 * and attribute systems.
 *
 * This enum ensures robust handling of tag semantics, void element detection, and integration with classifier and
 * content category utilities.
 *
 * Key features:
 * - Comprehensive coverage of HTML, SVG, and MathML tag names as enum cases.
 * - Defensive validation for tag existence and void element classification.
 * - Integration-ready for advanced HTML rendering, validation, and widget systems.
 * - Type-safe detection of void elements for correct markup generation.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements
 * @link https://developer.mozilla.org/en-US/docs/Web/MathML/Reference/Element
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Reference/Element
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Tag: string
{
    /**
     * Case for the `<a>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::interactive()}, {@see ContentTag::palpable()}, and
     * {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/a
     */
    case A = 'a';

    /**
     * Case for the `<abbr>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/abbr
     */
    case ABBR = 'abbr';

    /**
     * Case for the `<address>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/address
     */
    case ADDRESS = 'address';

    /**
     * Case for the `<area>` HTML tag.
     *
     * Categorized as {@see Tag::void()}, {@see ContentTag::flow()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/area
     */
    case AREA = 'area';

    /**
     * Case for the `<article>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::sectioning()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/article
     */
    case ARTICLE = 'article';

    /**
     * Case for the `<aside>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::sectioning()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/aside
     */
    case ASIDE = 'aside';

    /**
     * Case for the `<audio>` HTML tag.
     *
     * Categorized as {@see ContentTag::embedded()}, {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and
     * {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio
     */
    case AUDIO = 'audio';

    /**
     * Case for the `<b>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/b
     */
    case B = 'b';

    /**
     * Case for the `<base>` HTML tag.
     *
     * Categorized as {@see Tag::void()} and {@see ContentTag::metadata()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/base
     */
    case BASE = 'base';

    /**
     * Case for the `<bdi>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/bdi
     */
    case BDI = 'bdi';

    /**
     * Case for the `<bdo>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/bdo
     */
    case BDO = 'bdo';

    /**
     * Case for the `<blockquote>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/blockquote
     */
    case BLOCKQUOTE = 'blockquote';

    /**
     * Case for the `<body>` HTML tag.
     *
     * Categorized as {@see ContentTag::root()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/body
     */
    case BODY = 'body';

    /**
     * Case for the `<br>` HTML tag.
     *
     * Categorized as {@see Tag::void()}, {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and
     * {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/br
     */
    case BR = 'br';

    /**
     * Case for the `<button>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::formAssociated()}, {@see ContentTag::interactive()},
     * {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/button
     */
    case BUTTON = 'button';

    /**
     * Case for the `<canvas>` HTML tag.
     *
     * Categorized as {@see ContentTag::embedded()}, {@see ContentTag::flow()}, {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/canvas
     */
    case CANVAS = 'canvas';

    /**
     * Case for the `<caption>` HTML tag.
     *
     * Categorized as {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/caption
     */
    case CAPTION = 'caption';

    /**
     * Case for the `<cite>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/cite
     */
    case CITE = 'cite';

    /**
     * Case for the `<code>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/code
     */
    case CODE = 'code';

    /**
     * Case for the `<col>` HTML tag.
     *
     * Categorized as {@see Tag::void()} and {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/col
     */
    case COL = 'col';

    /**
     * Case for the `<colgroup>` HTML tag.
     *
     * Categorized as {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/colgroup
     */
    case COLGROUP = 'colgroup';

    /**
     * Case for the `<data>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/data
     */
    case DATA = 'data';

    /**
     * Case for the `<datalist>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/datalist
     */
    case DATALIST = 'datalist';

    /**
     * Case for the `<dd>` HTML tag.
     *
     * Categorized as {@see ContentTag::listing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dd
     */
    case DD = 'dd';

    /**
     * Case for the `<del>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/del
     */
    case DEL = 'del';

    /**
     * Case for the `<details>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::interactive()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/details
     */
    case DETAILS = 'details';

    /**
     * Case for the `<dfn>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dfn
     */
    case DFN = 'dfn';

    /**
     * Case for the `<dialog>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dialog
     */
    case DIALOG = 'dialog';

    /**
     * Case for the `<div>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/div
     */
    case DIV = 'div';

    /**
     * Case for the `<dl>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::listing()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dl
     */
    case DL = 'dl';

    /**
     * Case for the `<dt>` HTML tag.
     *
     * Categorized as {@see ContentTag::listing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dt
     */
    case DT = 'dt';

    /**
     * Case for the `<em>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/em
     */
    case EM = 'em';

    /**
     * Case for the `<embed>` HTML tag.
     *
     * Categorized as {@see Tag::void()}, {@see ContentTag::embedded()}, {@see ContentTag::flow()},
     * {@see ContentTag::interactive()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/embed
     */
    case EMBED = 'embed';

    /**
     * Case for the `<fieldset>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::formAssociated()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/fieldset
     */
    case FIELDSET = 'fieldset';

    /**
     * Case for the `<figcaption>` HTML tag.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/figcaption
     */
    case FIGCAPTION = 'figcaption';

    /**
     * Case for the `<figure>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/figure
     */
    case FIGURE = 'figure';

    /**
     * Case for the `<footer>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/footer
     */
    case FOOTER = 'footer';

    /**
     * Case for the `<form>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form
     */
    case FORM = 'form';

    /**
     * Case for the `<h1>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::heading()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
     */
    case H1 = 'h1';

    /**
     * Case for the `<h2>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::heading()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
     */
    case H2 = 'h2';

    /**
     * Case for the `<h3>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::heading()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
     */
    case H3 = 'h3';

    /**
     * Case for the `<h4>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::heading()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
     */
    case H4 = 'h4';

    /**
     * Case for the `<h5>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::heading()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
     */
    case H5 = 'h5';

    /**
     * Case for the `<h6>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::heading()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
     */
    case H6 = 'h6';

    /**
     * Case for the `<head>` HTML tag.
     *
     * Categorized as {@see ContentTag::root()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/head
     */
    case HEAD = 'head';

    /**
     * Case for the `<header>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/header
     */
    case HEADER = 'header';

    /**
     * Case for the `<hr>` HTML tag.
     *
     * Categorized as {@see Tag::void()} and {@see ContentTag::flow()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/hr
     */
    case HR = 'hr';

    /**
     * Case for the `<html>` HTML tag.
     *
     * Categorized as {@see ContentTag::root()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/html
     */
    case HTML = 'html';

    /**
     * Case for the `<i>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/i
     */
    case I = 'i';

    /**
     * Case for the `<iframe>` HTML tag.
     *
     * Categorized as {@see ContentTag::embedded()}, {@see ContentTag::flow()}, {@see ContentTag::interactive()},
     * {@see ContentTag::palpable()} and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/iframe
     */
    case IFRAME = 'iframe';

    /**
     * Case for the `<img>` HTML tag.
     *
     * Categorized as {@see Tag::void()}, {@see ContentTag::embedded()}, {@see ContentTag::flow()},
     * {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/img
     */
    case IMG = 'img';

    /**
     * Case for the `<input>` HTML tag.
     *
     * Categorized as {@see Tag::void()}, {@see ContentTag::flow()}, {@see ContentTag::formAssociated()},
     * {@see ContentTag::interactive()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input
     */
    case INPUT = 'input';

    /**
     * Case for the `<ins>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/ins
     */
    case INS = 'ins';

    /**
     * Case for the `<kbd>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/kbd
     */
    case KBD = 'kbd';

    /**
     * Case for the `<label>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::formAssociated()},
     * {@see ContentTag::interactive()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/label
     */
    case LABEL = 'label';

    /**
     * Case for the `<legend>` HTML tag.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/legend
     */
    case LEGEND = 'legend';

    /**
     * Case for the `<li>` HTML tag.
     *
     * Categorized as {@see ContentTag::listing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/li
     */
    case LI = 'li';

    /**
     * Case for the `<link>` HTML tag.
     *
     * Categorized as {@see Tag::void()} and {@see ContentTag::metadata()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/link
     */
    case LINK = 'link';

    /**
     * Case for the `<main>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/main
     */
    case MAIN = 'main';

    /**
     * Case for the `<map>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/map
     */
    case MAP = 'map';

    /**
     * Case for the `<mark>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/mark
     */
    case MARK = 'mark';

    /**
     * Case for the `<math>` MathML tag.
     *
     * Categorized as {@see ContentTag::flow()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/MathML/Reference/Element/math
     */
    case MATH = 'math';

    /**
     * Case for the `<menu>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()} and {@see ContentTag::listing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/menu
     */
    case MENU = 'menu';

    /**
     * Case for the `<meta>` HTML tag.
     *
     * Categorized as {@see Tag::void()} and {@see ContentTag::metadata()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/meta
     */
    case META = 'meta';

    /**
     * Case for the `<meter>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::formAssociated()}, {@see ContentTag::palpable()}, and
     * {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/meter
     */
    case METER = 'meter';

    /**
     * Case for the `<nav>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::sectioning()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/nav
     */
    case NAV = 'nav';

    /**
     * Case for the `<noscript>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::metadata()}, {@see ContentTag::phrasing()}, and
     * {@see ContentTag::scriptSupporting()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/noscript
     */
    case NOSCRIPT = 'noscript';

    /**
     * Case for the `<object>` HTML tag.
     *
     * Categorized as {@see ContentTag::embedded()}, {@see ContentTag::flow()}, {@see ContentTag::formAssociated()},
     * {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/object
     */
    case OBJECT = 'object';

    /**
     * Case for the `<ol>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::listing()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/ol
     */
    case OL = 'ol';

    /**
     * Case for the `<optgroup>` HTML tag.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/optgroup
     */
    case OPTGROUP = 'optgroup';

    /**
     * Case for the `<option>` HTML tag.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/option
     */
    case OPTION = 'option';

    /**
     * Case for the `<output>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::formAssociated()}, {@see ContentTag::palpable()},
     * and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/output
     */
    case OUTPUT = 'output';

    /**
     * Case for the `<p>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/p
     */
    case P = 'p';

    /**
     * Case for the `<picture>` HTML tag.
     *
     * Categorized as {@see ContentTag::embedded()}, {@see ContentTag::flow()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/picture
     */
    case PICTURE = 'picture';

    /**
     * Case for the `<pre>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/pre
     */
    case PRE = 'pre';

    /**
     * Case for the `<progress>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::formAssociated()}, {@see ContentTag::palpable()}, and
     * {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/progress
     */
    case PROGRESS = 'progress';

    /**
     * Case for the `<q>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/q
     */
    case Q = 'q';

    /**
     * Case for the `<rp>` HTML tag.
     *
     * Categorized as {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/rp
     */
    case RP = 'rp';

    /**
     * Case for the `<rt>` HTML tag.
     *
     * Categorized as {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/rt
     */
    case RT = 'rt';

    /**
     * Case for the `<ruby>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/ruby
     */
    case RUBY = 'ruby';

    /**
     * Case for the `<s>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/s
     */
    case S = 's';

    /**
     * Case for the `<samp>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/samp
     */
    case SAMP = 'samp';

    /**
     * Case for the `<script>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::metadata()}, {@see ContentTag::phrasing()}, and
     * {@see ContentTag::scriptSupporting()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script
     */
    case SCRIPT = 'script';

    /**
     * Case for the `<search>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/search
     */
    case SEARCH = 'search';

    /**
     * Case for the `<section>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::sectioning()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/section
     */
    case SECTION = 'section';

    /**
     * Case for the `<select>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::formAssociated()}, {@see ContentTag::interactive()},
     * {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/select
     */
    case SELECT = 'select';

    /**
     * Case for the `<slot>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/slot
     */
    case SLOT = 'slot';

    /**
     * Case for the `<small>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/small
     */
    case SMALL = 'small';

    /**
     * Case for the `<source>` HTML tag.
     *
     * Categorized as {@see Tag::void()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/source
     */
    case SOURCE = 'source';

    /**
     * Case for the `<span>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/span
     */
    case SPAN = 'span';

    /**
     * Case for the `<strong>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/strong
     */
    case STRONG = 'strong';

    /**
     * Case for the `<style>` HTML tag.
     *
     * Categorized as {@see ContentTag::metadata()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/style
     */
    case STYLE = 'style';

    /**
     * Case for the `<sub>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/sub
     */
    case SUB = 'sub';

    /**
     * Case for the `<summary>` HTML tag.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/summary
     */
    case SUMMARY = 'summary';

    /**
     * Case for the `<sup>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/sup
     */
    case SUP = 'sup';

    /**
     * Case for the `<svg>` SVG tag.
     *
     * Categorized as {@see ContentTag::embedded()}, {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and
     * {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/svg
     */
    case SVG = 'svg';

    /**
     * Case for the `<table>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/table
     */
    case TABLE = 'table';

    /**
     * Case for the `<tbody>` HTML tag.
     *
     * Categorized as {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/tbody
     */
    case TBODY = 'tbody';

    /**
     * Case for the `<td>` HTML tag.
     *
     * Categorized as {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/td
     */
    case TD = 'td';

    /**
     * Case for the `<template>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::metadata()}, and
     * {@see ContentTag::scriptSupporting()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template
     */
    case TEMPLATE = 'template';

    /**
     * Case for the `<textarea>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::formAssociated()}, {@see ContentTag::interactive()},
     * {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/textarea
     */
    case TEXTAREA = 'textarea';

    /**
     * Case for the `<tfoot>` HTML tag.
     *
     * Categorized as {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/tfoot
     */
    case TFOOT = 'tfoot';

    /**
     * Case for the `<th>` HTML tag.
     *
     * Categorized as {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/th
     */
    case TH = 'th';

    /**
     * Case for the `<thead>` HTML tag.
     *
     * Categorized as {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/thead
     */
    case THEAD = 'thead';

    /**
     * Case for the `<time>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/time
     */
    case TIME = 'time';

    /**
     * Case for the `<title>` HTML tag.
     *
     * Categorized as {@see ContentTag::metadata()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/title
     */
    case TITLE = 'title';

    /**
     * Case for the `<tr>` HTML tag.
     *
     * Categorized as {@see ContentTag::table()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/tr
     */
    case TR = 'tr';

    /**
     * Case for the `<track>` HTML tag.
     *
     * Categorized as {@see Tag::void()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/track
     */
    case TRACK = 'track';

    /**
     * Case for the `<u>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/u
     */
    case U = 'u';

    /**
     * Case for the `<ul>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::listing()}, and {@see ContentTag::palpable()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/ul
     */
    case UL = 'ul';

    /**
     * Case for the `<var>` HTML tag.
     *
     * Categorized as {@see ContentTag::flow()}, {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/var
     */
    case VAR = 'var';

    /**
     * Case for the `<video>` HTML tag.
     *
     * Categorized as {@see ContentTag::embedded()}, {@see ContentTag::flow()}, {@see ContentTag::interactive()},
     * {@see ContentTag::palpable()}, and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/video
     */
    case VIDEO = 'video';

    /**
     * Case for the `<wbr>` HTML tag.
     *
     * Categorized as {@see Tag::void()}, {@see ContentTag::flow()} and {@see ContentTag::phrasing()}.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/wbr
     */
    case WBR = 'wbr';

    /**
     * Determines whether the given tag is classified as a void element.
     *
     * Void elements are self-closing and do not contain content.
     *
     * @param self $tag Tag enum instance to check.
     *
     * @return bool `true` if the tag is a void element, `false` otherwise.
     */
    public static function isVoid(self $tag): bool
    {
        return in_array($tag, self::void(), true);
    }

    /**
     * Returns the list of void (self-closing) HTML tags.
     *
     * Void elements do not contain content and must not have closing tags.
     *
     * @return array Array of void Tag enum instances.
     *
     * @phpstan-return list<Tag>
     */
    public static function void(): array
    {
        return [
            self::AREA,
            self::BASE,
            self::BR,
            self::COL,
            self::EMBED,
            self::HR,
            self::IMG,
            self::INPUT,
            self::LINK,
            self::META,
            self::SOURCE,
            self::TRACK,
            self::WBR,
        ];
    }
}
