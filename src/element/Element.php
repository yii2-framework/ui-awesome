<?php

declare(strict_types=1);

namespace yii\ui\element;

/**
 * Standards-compliant HTML element renderer for block, inline, list, table and void tags.
 *
 * Provides a unified, immutable API for generating HTML elements according to the HTML specification, supporting
 * block-level, inline-level, list-level, root-level, table-level and void elements.
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
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Element extends base\BaseElement {}
