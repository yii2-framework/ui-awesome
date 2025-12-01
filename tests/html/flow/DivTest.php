<?php

declare(strict_types=1);

namespace yii\ui\tests\html\flow;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use yii\ui\factory\SimpleFactory;
use yii\ui\html\flow\Div;
use yii\ui\tests\support\stub\{DefaultProvider, DefaultThemeProvider};
use yii\ui\tests\support\TestSupport;

/**
 * Test suite for {@see Div} element functionality and behavior.
 *
 * Validates the management and rendering of the HTML `<div>` element according to the HTML Living Standard
 * specification.
 *
 * Ensures correct handling, immutability, and validation of the `Div` widget and tag rendering, supporting all global
 * HTML attributes, content, and provider-based configuration.
 *
 * Test coverage:
 * - Accurate rendering of attributes and content for the `<div>` element.
 * - Application of default and theme providers.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Immutability of the API when setting or overriding attributes.
 * - Nested rendering using `begin()` and `end()` methods.
 * - Precedence of user-defined attributes over global defaults.
 * - Proper assignment and overriding of attribute values, including `class`, `id`, `lang`, `style`, `title`, and
 *   `data-*`.
 *
 * {@see Div} for element implementation details.
 * {@see SimpleFactory} for default configuration management.
 * {@see TestSupport} for assertion utilities.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
#[Group('flow')]
final class DivTest extends TestCase
{
    use TestSupport;

    public function testRenderWithAttributes(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div class="test-class">
            </div>
            HTML,
            Div::tag()->attributes(['class' => 'test-class'])->render(),
            "Failed asserting that element renders correctly with 'attributes()' method.",
        );
    }

    public function testRenderWithBeginEnd(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div>
            Content
            </div>
            HTML,
            Div::tag()->begin() . 'Content' . Div::end(),
            "Failed asserting that element renders correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithClass(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div class="test-class">
            </div>
            HTML,
            Div::tag()->class('test-class')->render(),
            "Failed asserting that element renders correctly with 'class' attribute.",
        );
    }

    public function testRenderWithContent(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div>
            Content
            </div>
            HTML,
            Div::tag()->content('Content')->render(),
            "Failed asserting that element renders correctly with 'content()' method.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div data-value="test-value">
            </div>
            HTML,
            Div::tag()->dataAttributes(['value' => 'test-value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes()' method.",
        );
    }

    public function testRenderWithDefaultProvider(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div class="default-provider">
            </div>
            HTML,
            Div::tag()->addDefaultProvider(DefaultProvider::class)->render(),
            'Failed asserting that default provider is applied correctly.',
        );
    }

    public function testRenderWithDefaultValues(): void
    {
        $instance = Div::tag();

        self::equalsWithoutLE(
            <<<HTML
            <div>
            </div>
            HTML,
            $instance->render(),
            'Failed asserting that element renders correctly with default values.',
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Div::class, ['class()' => 'from-global']);

        self::equalsWithoutLE(
            <<<HTML
            <div class="from-global">
            </div>
            HTML,
            Div::tag()->render(),
            'Failed asserting that global defaults are applied correctly.',
        );

        SimpleFactory::setDefaults(Div::class, []);
    }

    public function testRenderWithId(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div id="test-id">
            </div>
            HTML,
            Div::tag()->id('test-id')->render(),
            "Failed asserting that element renders correctly with 'id' attribute.",
        );
    }

    public function testRenderWithLang(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div lang="es">
            </div>
            HTML,
            Div::tag()->lang('es')->render(),
            "Failed asserting that element renders correctly with 'lang' attribute.",
        );
    }

    public function testRenderWithNestedBeginEnd(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            Nested Content
            </div>
            </div>
            HTML,
            Div::tag()->begin() . Div::tag()->begin() . 'Nested Content' . Div::end() . Div::end(),
            "Failed asserting that nested elements render correctly with 'begin()' and 'end()' methods.",
        );
    }

    public function testRenderWithStyle(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div style="test-value">
            </div>
            HTML,
            Div::tag()->style('test-value')->render(),
            "Failed asserting that element renders correctly with 'style' attribute.",
        );
    }

    public function testRenderWithThemeProvider(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div class="tag-primary">
            </div>
            HTML,
            Div::tag()->addThemeProvider('primary', DefaultThemeProvider::class)->render(),
            'Failed asserting that theme provider is applied correctly.',
        );
    }

    public function testRenderWithTitle(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div title="test-value">
            </div>
            HTML,
            Div::tag()->title('test-value')->render(),
            "Failed asserting that element renders correctly with 'title' attribute.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Div::class, ['class()' => 'from-global', 'id()' => 'id-global']);

        self::equalsWithoutLE(
            <<<HTML
            <div class="from-global" id="id-user">
            </div>
            HTML,
            Div::tag(['id()' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Div::class, []);
    }
}
