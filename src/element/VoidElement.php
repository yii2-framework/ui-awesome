<?php

declare(strict_types=1);

namespace yii\ui\element;

/**
 * Void-level HTML tag element for standards-compliant document structure.
 *
 * Provides a concrete implementation for rendering void HTML elements, ensuring correct semantics and integration
 * within view renderers, widget systems, and asset managers.
 *
 * Designed to encapsulate elements that do not contain content or closing tags, following the HTML specification for
 * void elements as defined by the W3C and referenced in the MDN documentation.
 *
 * Key features:
 * - Immutable, type-safe API for robust HTML generation workflows.
 * - Integration-ready for advanced attribute handling, encoding, and normalization.
 * - Strict adherence to void tag semantics for predictable layout behavior.
 *
 * {@see base\BaseVoidElement} for the base implementation.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class VoidElement extends base\BaseVoidElement {}
