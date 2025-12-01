<?php

declare(strict_types=1);

namespace yii\ui\tests\html\phrasing;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use yii\ui\factory\SimpleFactory;
use yii\ui\html\phrasing\Span;
use yii\ui\tests\support\stub\{DefaultProvider, DefaultThemeProvider};
use yii\ui\tests\support\TestSupport;

/**
 * Test suite for {@see Span} element functionality and behavior.
 *
 * Validates the management and rendering of the HTML `<span>` element according to the HTML Living Standard
 * specification.
 *
 * Ensures correct handling, immutability, and validation of the `Span` tag rendering, supporting all global HTML
 * attributes, content, and provider-based configuration.
 *
 * Test coverage:
 * - Accurate rendering of attributes and content for the `<span>` element.
 * - Application of default and theme providers.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Immutability of the API when setting or overriding attributes.
 * - Precedence of user-defined attributes over global defaults.
 * - Proper assignment and overriding of attribute values, including `class`, `id`, `lang`, `style`, `title`, and
 *   `data-*`.
 *
 * {@see Span} for element implementation details.
 * {@see SimpleFactory} for default configuration management.
 * {@see TestSupport} for assertion utilities.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('phrasing')]
final class SpanTest extends TestCase
{
    use TestSupport;

    public function testRenderWithAttributes(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span class="test-class"></span>
            HTML,
            Span::tag()->attributes(['class' => 'test-class'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span class="test-class"></span>
            HTML,
            Span::tag()->class('test-class')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span>Content</span>
            HTML,
            Span::tag()->content('Content')->render(),
            "Failed asserting that element renders correctly with 'content()' method.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span data-value="test-value"></span>
            HTML,
            Span::tag()->dataAttributes(['value' => 'test-value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span class="default-provider"></span>
            HTML,
            Span::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        $instance = Span::tag();

        self::equalsWithoutLE(
            <<<HTML
            <span></span>
            HTML,
            $instance->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Span::class, ['class' => 'from-global']);

        self::equalsWithoutLE(
            <<<HTML
            <span class="from-global"></span>
            HTML,
            Span::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Span::class, []);
    }

    public function testRenderWithId(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span id="test-id"></span>
            HTML,
            Span::tag()->id('test-id')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span lang="es"></span>
            HTML,
            Span::tag()->lang('es')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span style="test-value"></span>
            HTML,
            Span::tag()->style('test-value')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span class="text-muted"></span>
            HTML,
            Span::tag()->addThemeProvider('muted', DefaultThemeProvider::class)->render(),
            'Failed asserting that theme provider is applied correctly.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span title="test-value"></span>
            HTML,
            Span::tag()->title('test-value')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Span::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::equalsWithoutLE(
            <<<HTML
            <span class="from-global" id="id-user"></span>
            HTML,
            Span::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Span::class, []);
    }
}
