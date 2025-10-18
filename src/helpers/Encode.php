<?php

declare(strict_types=1);

namespace yii\ui\helpers;

/**
 * HTML encoding helper for safe content and attribute output.
 *
 * Provides a fluent, immutable API for encoding HTML content and attributes, ensuring XSS prevention and
 * standards-compliant output for all HTML5 use cases.
 *
 * The API is designed for integration in view renderers, asset managers, and HTML document workflows, supporting safe
 * encoding of tag contents, attribute values, and arbitrary strings with flexible charset handling.
 *
 * {@see base\BaseEncode} for the base implementation.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Encode extends base\BaseEncode {}
