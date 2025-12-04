<?php

declare(strict_types=1);

namespace yii\ui\helpers;

/**
 * Validation helper for robust, type-safe input and attribute validation in HTML rendering contexts.
 *
 * Provides a static API for validating HTML attributes, tag values, and user input, supporting strict type checks,
 * value normalization, and custom validation logic for secure and predictable output.
 *
 * Designed for integration in HTML helpers, view renderers, tags, and components, ensuring consistent enforcement of
 * attribute correctness, value constraints, and input integrity across all supported use cases.
 *
 * Key features.
 * - Customizable validation logic for advanced scenarios.
 * - Ensures secure, standards-compliant output for HTML generation.
 * - Stateless, reusable static methods for validation workflows.
 * - Type-safe validation for HTML attributes and tag values.
 *
 * {@see base\BaseValidator} for the base implementation.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Validator extends base\BaseValidator {}
