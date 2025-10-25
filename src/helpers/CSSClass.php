<?php

declare(strict_types=1);

namespace yii\ui\helpers;

/**
 * CSS class manipulation helper for attribute normalization and merging.
 *
 * Provides a fluent, immutable API for processing, validating, and rendering CSS class attributes, supporting
 * string/array conversion, safe class merging, and normalization for HTML output.
 *
 * Designed for integration in HTML helpers, view renderers, and widget systems ensuring consistent and secure handling
 * of CSS class attributes across all supported use cases.
 *
 * Key features.
 * - Attribute manipulation and normalization for HTML output.
 * - CSS class name validation and sanitization.
 * - Immutable, widget-based configuration for safe reuse.
 * - Safe merging and overriding of class lists.
 * - String and array conversion utilities.
 *
 * {@see base\BaseCSSClass} for the base implementation.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class CSSClass extends base\BaseCSSClass {}
