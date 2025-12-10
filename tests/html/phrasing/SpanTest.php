<?php

declare(strict_types=1);

namespace yii\ui\tests\html\phrasing;

use LogicException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use yii\ui\exception\Message;
use yii\ui\factory\SimpleFactory;
use yii\ui\html\phrasing\Span;
use yii\ui\tag\Inline;
use yii\ui\tests\support\stub\{DefaultProvider, DefaultThemeProvider};
use yii\ui\tests\support\TestSupport;
use yii\ui\values\Direction;

/**
 * Test suite for {@see Span} element functionality and behavior.
 *
 * Validates the management and rendering of the HTML `<span>` element according to the HTML Living Standard
 * specification.
 *
 * Ensures correct handling, immutability, and validation of the `Span` tag rendering, supporting all global HTML
 * attributes, content, prefix, suffix, and provider-based configuration.
 *
 * Test coverage.
 * - Accurate rendering of attributes and content for the `<span>` element.
 * - Application of default and theme providers.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Immutability of the API when setting or overriding attributes.
 * - Precedence of user-defined attributes over global defaults.
 * - Proper assignment and overriding of attribute values, including `class`, `id`, `lang`, `style`, `title`, and
 *   `data-*`.
 * - Rendering with prefix and suffix content, with and without tag wrappers.
 *
 * {@see SimpleFactory} for default configuration management.
 * {@see Span} for element implementation details.
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

    public function testRenderWithAutofocus(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span autofocus></span>
            HTML,
            Span::tag()->autofocus(true)->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
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

    public function testRenderWithContentEditable(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span contenteditable="true"></span>
            HTML,
            Span::tag()->contentEditable(true)->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
        );
    }

    public function testRenderWithDataAttributes(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span data-value="test-value"></span>
            HTML,
            Span::tag()->dataAttributes(['value' => 'test-value'])->render(),
            "Failed asserting that element renders correctly with 'dataAttributes' attribute.",
        );
    }

    public function testRenderWithDefaultConfigurationMethodValues(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span class="default-class" title="default-title"></span>
            HTML,
            Span::tag(['class' => 'default-class', 'title' => 'default-title'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
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

    public function testRenderWithDir(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span dir="ltr"></span>
            HTML,
            Span::tag()->dir(Direction::LTR)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span draggable="true"></span>
            HTML,
            Span::tag()->draggable(true)->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        $previous = SimpleFactory::getDefaults(Span::class);

        try {
            SimpleFactory::setDefaults(Span::class, ['class' => 'from-global']);

            self::equalsWithoutLE(
                <<<HTML
                <span class="from-global"></span>
                HTML,
                Span::tag()->render(),
                'Failed asserting that global defaults are applied correctly.',
            );
        } finally {
            SimpleFactory::setDefaults(Span::class, $previous);
        }
    }

    public function testRenderwithHidden(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span hidden></span>
            HTML,
            Span::tag()->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
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

    public function testRenderWithItemId(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span itemid="http://example.com/item"></span>
            HTML,
            Span::tag()->itemId('http://example.com/item')->render(),
            "Failed asserting that element renders correctly with 'itemId' attribute.",
        );
    }

    public function testRenderWithItemProp(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span itemprop="name"></span>
            HTML,
            Span::tag()->itemProp('name')->render(),
            "Failed asserting that element renders correctly with 'itemProp' attribute.",
        );
    }

    public function testRenderWithItemRef(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span itemref="additional-info"></span>
            HTML,
            Span::tag()->itemRef('additional-info')->render(),
            "Failed asserting that element renders correctly with 'itemRef' attribute.",
        );
    }

    public function testRenderWithItemScope(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span itemscope></span>
            HTML,
            Span::tag()->itemScope(true)->render(),
            "Failed asserting that element renders correctly with 'itemScope' attribute.",
        );
    }

    public function testRenderWithItemType(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span itemtype="http://schema.org/Person"></span>
            HTML,
            Span::tag()->itemType('http://schema.org/Person')->render(),
            "Failed asserting that element renders correctly with 'itemType' attribute.",
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

    public function testRenderWithPrefixAndSuffix(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <strong>Prefix</strong>
            <span>Content</span>
            <em>Suffix</em>
            HTML,
            Span::tag()
                ->content('Content')
                ->prefix('Prefix')
                ->prefixTag(Inline::STRONG)
                ->suffix('Suffix')
                ->suffixTag(Inline::EM)
                ->render(),
            "Failed asserting that element renders correctly with both 'prefix()' and 'suffix()' methods.",
        );
    }

    public function testRenderWithPrefixSetWithoutPrefixTag(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            Prefix content
            <span class="test"></span>
            HTML,
            Span::tag()->prefix('Prefix content')->class('test')->render(),
            "Failed asserting that element renders correctly with 'prefix()' method.",
        );
    }

    public function testRenderWithPrefixTagWhenPrefixSet(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <strong class="prefix-class" id="prefix-id">Prefix content</strong>
            <span></span>
            HTML,
            Span::tag()->prefix('Prefix content')
                ->prefixAttributes(['id' => 'prefix-id'])
                ->prefixClass('prefix-class')
                ->prefixTag(Inline::STRONG)
                ->render(),
            "Failed asserting that element renders correctly with 'prefixTag()' method.",
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span spellcheck="true"></span>
            HTML,
            Span::tag()->spellcheck(true)->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
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

    public function testRenderWithSuffixSetWithoutSuffixTag(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span class="test"></span>
            Suffix content
            HTML,
            Span::tag()->class('test')->suffix('Suffix content')->render(),
            "Failed asserting that element renders correctly with 'suffix()' method.",
        );
    }

    public function testRenderWithSuffixTagWhenSuffixSet(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span></span>
            <strong class="suffix-class" id="suffix-id">Suffix content</strong>
            HTML,
            Span::tag()
                ->suffix('Suffix content')
                ->suffixAttributes(['id' => 'suffix-id'])
                ->suffixClass('suffix-class')
                ->suffixTag(Inline::STRONG)
                ->render(),
            "Failed asserting that element renders correctly with 'suffixTag()' method.",
        );
    }

    public function testRenderWithTabindex(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span tabindex="3"></span>
            HTML,
            Span::tag()->tabIndex(3)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
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

    public function testRenderWithToString(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <span></span>
            HTML,
            (string) Span::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        $previous = SimpleFactory::getDefaults(Span::class);

        try {
            SimpleFactory::setDefaults(Span::class, ['class' => 'from-global', 'id' => 'id-global']);

            self::equalsWithoutLE(
                <<<HTML
                <span class="from-global" id="id-user"></span>
                HTML,
                Span::tag(['id' => 'id-user'])->render(),
                'Failed asserting that user-defined attributes override global defaults correctly.',
            );
        } finally {
            SimpleFactory::setDefaults(Span::class, $previous);
        }
    }

    public function testReturnEmptyArrayWhenApplyThemeAndUndefinedTheme(): void
    {
        $tag = Span::tag();

        self::assertEmpty(
            $tag->apply($tag, ''),
            'Failed asserting that applying an undefined theme returns an empty array.',
        );
    }

    public function testReturnEmptyArrayWhenGetDefaultsAndNoDefaultsSet(): void
    {
        $tag = Span::tag();

        self::assertEmpty(
            $tag->getDefaults($tag),
            'Failed asserting that getting defaults returns an empty array when no defaults are set.',
        );
    }

    public function testThrowExceptionWhenBeginCalled(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            Message::TAG_DOES_NOT_SUPPORT_BEGIN->getMessage(Span::class),
        );

        Span::tag()->begin();
    }

    public function testThrowExceptionWhenEndCalled(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            Message::UNEXPECTED_END_CALL_NO_BEGIN->getMessage(Span::class),
        );

        Span::end();
    }
}
