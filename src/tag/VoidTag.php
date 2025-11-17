<?php

declare(strict_types=1);

namespace yii\ui\tag;

use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;

use function strtolower;

/**
 * Enum representing all supported HTML void (self-closing) tags for rendering and validation.
 *
 * Provides a type-safe, standards-compliant set of void HTML tag names for use in tag rendering systems, attribute
 * validation, and widget construction. Ensures consistent handling of void elements in HTML5 contexts, supporting
 * strict type safety and predictable output for tag-based operations.
 *
 * Key features:
 * - Comprehensive coverage of HTML void tags as defined by the HTML5 specification.
 * - Designed for integration with advanced attribute and element rendering systems.
 * - Type-safe enumeration for tag validation and rendering.
 * - Utility method for void tag detection supporting case-insensitive matching.
 *
 * {@see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/void_elements} HTML Void Elements.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum VoidTag: string
{
    /**
     * Case for the `<area>` HTML tag.
     */
    case AREA = 'area';

    /**
     * Case for the `<base>` HTML tag.
     */
    case BASE = 'base';

    /**
     * Case for the `<br>` HTML tag.
     */
    case BR = 'br';

    /**
     * Case for the `<col>` HTML tag.
     */
    case COL = 'col';

    /**
     * Case for the `<embed>` HTML tag.
     */
    case EMBED = 'embed';

    /**
     * Case for the `<hr>` HTML tag.
     */
    case HR = 'hr';

    /**
     * Case for the `<img>` HTML tag.
     */
    case IMG = 'img';

    /**
     * Case for the `<input>` HTML tag.
     */
    case INPUT = 'input';

    /**
     * Case for the `<link>` HTML tag.
     */
    case LINK = 'link';

    /**
     * Case for the `<meta>` HTML tag.
     */
    case META = 'meta';

    /**
     * Case for the `<param>` HTML tag.
     */
    case PARAM = 'param';

    /**
     * Case for the `<source>` HTML tag.
     */
    case SOURCE = 'source';

    /**
     * Case for the `<track>` HTML tag.
     */
    case TRACK = 'track';

    /**
     * Case for the `<wbr>` HTML tag.
     */
    case WBR = 'wbr';

    /**
     * Determines whether a given tag name is a supported void (self-closing) HTML tag.
     *
     * Provides a case-insensitive check against the set of defined void tags, supporting validation and rendering logic
     * for HTML tag-based systems.
     *
     * @param string $tag Tag name to validate.
     *
     * @throws InvalidArgumentException if the tag name is empty.
     *
     * @return bool `true` if the tag is a supported void tag, `false` otherwise.
     */
    public static function isVoid(string $tag): bool
    {
        if ($tag === '') {
            throw new InvalidArgumentException(Message::EMPTY_TAG_NAME->getMessage());
        }

        return self::tryFrom(strtolower($tag)) !== null;
    }
}
