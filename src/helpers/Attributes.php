<?php

declare(strict_types=1);

namespace yii\ui\helpers;

/**
 * HTML attribute helper for safe, flexible attribute rendering and manipulation.
 *
 * Provides a fluent, immutable API for processing and rendering HTML attributes, supporting array and boolean values,
 * data/ARIA attribute expansion, and HTML-safe encoding for secure output.
 *
 * Designed for integration in tag builders, view renderers, and widget systems, it ensures correct attribute ordering,
 * escaping, and compatibility with all major HTML5 use cases.
 *
 * Key features.
 * - Array and boolean attribute handling for dynamic attribute sets.
 * - Data/ARIA attribute expansion for accessibility and custom data.
 * - HTML-safe encoding to prevent XSS and markup errors.
 * - Immutable, widget-based configuration for safe reuse.
 * - Standardized attribute ordering for predictable output.
 * - Type-safe, documented methods for all major attribute scenarios.
 *
 * The API is intended for use in advanced HTML generation workflows, including asset managers, tag widgets, and
 * server-side rendering engines, where attribute correctness and security are critical.
 *
 * {@see base\BaseAttributes} for the base implementation.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Attributes extends base\BaseAttributes {}
