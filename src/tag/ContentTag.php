<?php

declare(strict_types=1);

namespace yii\ui\tag;

/**
 * Centralized classifier for HTML content categories and tag groupings.
 *
 * Provides static methods for retrieving standardized lists of HTML tags by semantic category, supporting
 * standards-compliant rendering, validation, and widget systems.
 *
 * This class ensures robust, predictable handling of HTML element semantics, enabling advanced tag classification and
 * content modeling for modern web applications.
 *
 * Key features:
 * - Defensive, type-safe groupings for embedded, flow, form-associated, heading, interactive, metadata, palpable,
 *   phrasing, script-supporting, and sectioning content.
 * - Integration-ready for advanced HTML rendering, validation, and widget systems.
 * - Technical mapping of HTML content categories to tag enums.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class ContentTag
{
    /**
     * Returns the list of embedded content HTML tags.
     *
     * Embedded content includes media and object elements as defined by the HTML specification.
     *
     * @return array Array of embedded Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#embedded_content
     *
     * @phpstan-return list<Tag>
     */
    public static function embedded(): array
    {
        return [
            Tag::AUDIO,
            Tag::CANVAS,
            Tag::EMBED,
            Tag::IFRAME,
            Tag::IMG,
            Tag::OBJECT,
            Tag::PICTURE,
            Tag::SVG,
            Tag::VIDEO,
        ];
    }

    /**
     * Returns the list of flow content HTML tags.
     *
     * Flow content includes elements that can be used as part of the main document flow.
     *
     * @return array Array of flow Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#flow_content
     *
     * @phpstan-return list<Tag>
     */
    public static function flow(): array
    {
        return [
            Tag::A,
            Tag::ABBR,
            Tag::ADDRESS,
            Tag::AREA,
            Tag::ARTICLE,
            Tag::ASIDE,
            Tag::AUDIO,
            Tag::B,
            Tag::BDI,
            Tag::BDO,
            Tag::BLOCKQUOTE,
            Tag::BR,
            Tag::BUTTON,
            Tag::CANVAS,
            Tag::CITE,
            Tag::CODE,
            Tag::DATA,
            Tag::DATALIST,
            Tag::DEL,
            Tag::DETAILS,
            Tag::DFN,
            Tag::DIALOG,
            Tag::DIV,
            Tag::DL,
            Tag::EM,
            Tag::EMBED,
            Tag::FIELDSET,
            Tag::FIGURE,
            Tag::FOOTER,
            Tag::FORM,
            Tag::H1,
            Tag::H2,
            Tag::H3,
            Tag::H4,
            Tag::H5,
            Tag::H6,
            Tag::HEADER,
            Tag::HR,
            Tag::I,
            Tag::IFRAME,
            Tag::IMG,
            Tag::INPUT,
            Tag::INS,
            Tag::KBD,
            Tag::LABEL,
            Tag::MAIN,
            Tag::MAP,
            Tag::MARK,
            Tag::MATH,
            Tag::MENU,
            Tag::METER,
            Tag::NAV,
            Tag::NOSCRIPT,
            Tag::OBJECT,
            Tag::OL,
            Tag::OUTPUT,
            Tag::P,
            Tag::PICTURE,
            Tag::PRE,
            Tag::PROGRESS,
            Tag::Q,
            Tag::RUBY,
            Tag::S,
            Tag::SAMP,
            Tag::SCRIPT,
            Tag::SEARCH,
            Tag::SECTION,
            Tag::SELECT,
            Tag::SLOT,
            Tag::SMALL,
            Tag::SPAN,
            Tag::STRONG,
            Tag::SUB,
            Tag::SUP,
            Tag::SVG,
            Tag::TABLE,
            Tag::TEMPLATE,
            Tag::TEXTAREA,
            Tag::TIME,
            Tag::U,
            Tag::UL,
            Tag::VAR,
            Tag::VIDEO,
            Tag::WBR,
        ];
    }

    /**
     * Returns the list of form-associated content HTML tags.
     *
     * Form-associated content includes elements that participate in form submission and interaction.
     *
     * @return array Array of form-associated Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#form-associated_content
     *
     * @phpstan-return list<Tag>
     */
    public static function formAssociated(): array
    {
        return [
            Tag::BUTTON,
            Tag::FIELDSET,
            Tag::INPUT,
            Tag::LABEL,
            Tag::METER,
            Tag::OBJECT,
            Tag::OUTPUT,
            Tag::PROGRESS,
            Tag::SELECT,
            Tag::TEXTAREA,
        ];
    }

    /**
     * Returns the list of heading content HTML tags.
     *
     * Heading content includes elements used for document headings and structure.
     *
     * @return array Array of heading Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#heading_content
     *
     * @phpstan-return list<Tag>
     */
    public static function heading(): array
    {
        return [
            Tag::H1,
            Tag::H2,
            Tag::H3,
            Tag::H4,
            Tag::H5,
            Tag::H6,
        ];
    }

    /**
     * Returns the list of interactive content HTML tags.
     *
     * Interactive content includes elements that enable user interaction.
     *
     * @return array Array of interactive Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#interactive_content
     *
     * @phpstan-return list<Tag>
     */
    public static function interactive(): array
    {
        return [
            Tag::A,
            Tag::BUTTON,
            Tag::DETAILS,
            Tag::EMBED,
            Tag::IFRAME,
            Tag::INPUT,
            Tag::LABEL,
            Tag::SELECT,
            Tag::TEXTAREA,
            Tag::VIDEO,
        ];
    }

    /**
     * Returns the list of listing content HTML tags.
     *
     * Listing content includes elements used for lists and list-like structures.
     *
     * @return array Array of listing Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#listing_content
     *
     * @phpstan-return list<Tag>
     */
    public static function listing(): array
    {
        return [
            Tag::DD,
            Tag::DL,
            Tag::DT,
            Tag::LI,
            Tag::MENU,
            Tag::OL,
            Tag::UL,
        ];
    }

    /**
     * Returns the list of metadata content HTML tags.
     *
     * Metadata content includes elements that provide document metadata and resources.
     *
     * @return array Array of metadata Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#metadata_content
     *
     * @phpstan-return list<Tag>
     */
    public static function metadata(): array
    {
        return [
            Tag::BASE,
            Tag::LINK,
            Tag::META,
            Tag::NOSCRIPT,
            Tag::SCRIPT,
            Tag::STYLE,
            Tag::TEMPLATE,
            Tag::TITLE,
        ];
    }

    /**
     * Returns the list of palpable content HTML tags.
     *
     * Palpable content includes elements that are perceivable and meaningful to users.
     *
     * @return array Array of palpable Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#palpable_content
     *
     * @phpstan-return list<Tag>
     */
    public static function palpable(): array
    {
        return [
            Tag::A,
            Tag::ABBR,
            Tag::ADDRESS,
            Tag::ARTICLE,
            Tag::ASIDE,
            Tag::AUDIO,
            Tag::B,
            Tag::BDI,
            Tag::BDO,
            Tag::BLOCKQUOTE,
            Tag::BUTTON,
            Tag::CANVAS,
            Tag::CITE,
            Tag::CODE,
            Tag::DATA,
            Tag::DETAILS,
            Tag::DFN,
            Tag::DIV,
            Tag::DL,
            Tag::EM,
            Tag::EMBED,
            Tag::FIELDSET,
            Tag::FIGURE,
            Tag::FOOTER,
            Tag::FORM,
            Tag::H1,
            Tag::H2,
            Tag::H3,
            Tag::H4,
            Tag::H5,
            Tag::H6,
            Tag::HEADER,
            Tag::I,
            Tag::IFRAME,
            Tag::IMG,
            Tag::INPUT,
            Tag::INS,
            Tag::KBD,
            Tag::LABEL,
            Tag::MAIN,
            Tag::MAP,
            Tag::MARK,
            Tag::METER,
            Tag::NAV,
            Tag::OBJECT,
            Tag::OL,
            Tag::OUTPUT,
            Tag::P,
            Tag::PRE,
            Tag::PROGRESS,
            Tag::Q,
            Tag::RUBY,
            Tag::S,
            Tag::SAMP,
            Tag::SECTION,
            Tag::SELECT,
            Tag::SMALL,
            Tag::SPAN,
            Tag::STRONG,
            Tag::SUB,
            Tag::SUMMARY,
            Tag::SUP,
            Tag::SVG,
            Tag::TABLE,
            Tag::TEXTAREA,
            Tag::TIME,
            Tag::U,
            Tag::UL,
            Tag::VAR,
            Tag::VIDEO,
        ];
    }

    /**
     * Returns the list of phrasing content HTML tags.
     *
     * Phrasing content includes elements that define the text and inline structure of the document.
     *
     * @return array Array of phrasing Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#phrasing_content
     *
     * @phpstan-return list<Tag>
     */
    public static function phrasing(): array
    {
        return [
            Tag::A,
            Tag::ABBR,
            Tag::AREA,
            Tag::AUDIO,
            Tag::B,
            Tag::BDI,
            Tag::BDO,
            Tag::BR,
            Tag::BUTTON,
            Tag::CITE,
            Tag::CODE,
            Tag::DATA,
            Tag::DFN,
            Tag::EM,
            Tag::EMBED,
            Tag::I,
            Tag::IFRAME,
            Tag::IMG,
            Tag::INPUT,
            Tag::KBD,
            Tag::LABEL,
            Tag::MAP,
            Tag::MARK,
            Tag::METER,
            Tag::NOSCRIPT,
            Tag::OBJECT,
            Tag::OUTPUT,
            Tag::PICTURE,
            Tag::PROGRESS,
            Tag::Q,
            Tag::RP,
            Tag::RT,
            Tag::RUBY,
            Tag::S,
            Tag::SAMP,
            Tag::SCRIPT,
            Tag::SELECT,
            Tag::SMALL,
            Tag::SPAN,
            Tag::STRONG,
            Tag::SUB,
            Tag::SUP,
            Tag::SVG,
            Tag::TEXTAREA,
            Tag::TIME,
            Tag::U,
            Tag::VAR,
            Tag::VIDEO,
            Tag::WBR,
        ];
    }

    /**
     * Returns the list of root HTML tags.
     *
     * Root tags include the fundamental structural elements of an HTML document.
     *
     * @return array Array of root Tag enum instances.
     *
     * @phpstan-return list<Tag>
     */
    public static function root(): array
    {
        return [
            Tag::BODY,
            Tag::HEAD,
            Tag::HTML,
        ];
    }

    /**
     * Returns the list of script-supporting content HTML tags.
     *
     * Script-supporting content includes elements that enable scripting and template functionality.
     *
     * @return array Array of script-supporting Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#script-supporting_elements
     *
     * @phpstan-return list<Tag>
     */
    public static function scriptSupporting(): array
    {
        return [
            Tag::NOSCRIPT,
            Tag::SCRIPT,
            Tag::TEMPLATE,
        ];
    }

    /**
     * Returns the list of sectioning content HTML tags.
     *
     * Sectioning content includes elements that define the structure and outline of the document.
     *
     * @return array Array of sectioning Tag enum instances.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Content_categories#sectioning_content
     *
     * @phpstan-return list<Tag>
     */
    public static function sectioning(): array
    {
        return [
            Tag::ARTICLE,
            Tag::ASIDE,
            Tag::NAV,
            Tag::SECTION,
        ];
    }

    /**
     * Returns the list of table content HTML tags.
     *
     * Table content includes elements used for structuring tabular data.
     *
     * @return array Array of table Tag enum instances.
     *
     * @phpstan-return list<Tag>
     */
    public static function table(): array
    {
        return [
            Tag::CAPTION,
            Tag::COL,
            Tag::COLGROUP,
            Tag::TABLE,
            Tag::TBODY,
            Tag::TD,
            Tag::TFOOT,
            Tag::TH,
            Tag::THEAD,
            Tag::TR,
        ];
    }
}
