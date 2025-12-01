<?php

declare(strict_types=1);

namespace yii\ui\element;

use Stringable;
use yii\ui\attributes\{HasClass, HasData, HasId, HasLang, HasStyle, HasTitle};
use yii\ui\helpers\Template;
use yii\ui\html\Html;
use yii\ui\mixin\{HasAttributes, HasPrefixCollection, HasSuffixCollection, HasTemplate};
use yii\ui\tag\{BaseTag, Inline, Voids};

/**
 * Base class for constructing HTML inline-level and void elements according to the HTML specification.
 *
 * Provides a standards-compliant, extensible foundation for inline and void tag rendering, supporting global HTML
 * attributes, template-based content composition, and attribute immutability.
 *
 * Intended for use in components and tags that require dynamic or programmatic manipulation of inline-level or void
 * HTML elements, supporting advanced rendering scenarios and consistent API design.
 *
 * Key features.
 * - Enforces standards-compliant handling of inline and void tags as defined by the HTML specification.
 * - Immutable API for attribute and template assignment.
 * - Implements the core logic for inline-level and void tag construction.
 * - Integrates global HTML attribute management via traits.
 * - Supports extensibility for custom inline or void element implementations.
 *
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Inline-level_content
 * @link https://developer.mozilla.org/en-US/docs/Glossary/Void_element
 * {@see Inline} for a list of inline-level HTML elements.
 * {@see Voids} for a list of void HTML elements.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseElement extends BaseTag
{
    use HasAttributes;
    use HasClass;
    use HasData;
    use HasId;
    use HasLang;
    use HasPrefixCollection;
    use HasStyle;
    use HasSuffixCollection;
    use HasTemplate;
    use HasTitle;

    /**
     * Returns the tag instance representing the inline-level or void element.
     *
     * @return Inline|Voids Tag instance for the element.
     *
     * Usage example:
     * ```php
     * public function getTag(): Inline|Voids
     * {
     *    return Inline::SPAN;
     * }
     * ```
     */
    abstract protected function getTag(): Inline|Voids;

    /**
     * Builds the HTML element using the configured template, prefix, tag, and suffix.
     *
     * Composes the element by rendering the prefix, main tag, and suffix using the provided or default template.
     *
     * @param string|Stringable $content Content to be rendered inside the tag.
     * @param array $tokenValues Additional template token values.
     *
     * @return string Rendered HTML element.
     *
     * @phpstan-param mixed[] $tokenValues
     * @phpstan-return string
     */
    protected function buildElement(string|Stringable $content = '', array $tokenValues = []): string
    {
        $tokenTemplateValues = [
            '{prefix}' => $this->renderTag($this->prefixTag, $this->prefix, $this->prefixAttributes),
            '{tag}' => $this->renderTag($this->getTag(), (string) $content, $this->attributes),
            '{suffix}' => $this->renderTag($this->suffixTag, $this->suffix, $this->suffixAttributes),
        ];

        $tokenTemplateValues += $tokenValues;
        $template = $this->template;

        if ($template === '') {
            $template = '{prefix}\n{tag}\n{suffix}';
        }

        return Template::render($template, $tokenTemplateValues);
    }

    /**
     * Renders the tag based on the provided tag type, content, and attributes.
     *
     * Handles inline, void, and boolean tag types according to HTML specification.
     *
     * @param bool|Inline|Voids $inlineTag Tag type to render.
     * @param string $content Content to be rendered inside the tag.
     * @param array $attributes HTML attributes for the tag.
     *
     * @return string Rendered tag string.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-return string
     */
    private function renderTag(bool|Inline|Voids $inlineTag, string $content, array $attributes = []): string
    {
        if ($inlineTag === false || $inlineTag === true) {
            return $content;
        }

        if ($inlineTag instanceof Voids) {
            return Html::void($inlineTag, $attributes);
        }

        return Html::inline($inlineTag, $content, $attributes);
    }
}
