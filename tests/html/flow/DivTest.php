<?php

declare(strict_types=1);

namespace yii\ui\tests\html\flow;

use LogicException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use yii\ui\element\BaseBlockElement;
use yii\ui\exception\Message;
use yii\ui\factory\SimpleFactory;
use yii\ui\html\flow\Div;
use yii\ui\html\phrasing\Span;
use yii\ui\tag\Block;
use yii\ui\tests\support\stub\{DefaultProvider, DefaultThemeProvider};
use yii\ui\tests\support\TestSupport;
use yii\ui\values\{ContentEditable, Direction, Draggable};

use function get_class;

/**
 * Test suite for {@see Div} element functionality and behavior.
 *
 * Validates the management and rendering of the HTML `<div>` element according to the HTML Living Standard
 * specification.
 *
 * Ensures correct handling, immutability, and validation of the `Div` tag rendering, supporting all global HTML
 * attributes, content, and provider-based configuration.
 *
 * Test coverage.
 * - Accurate rendering of attributes and content for the `<div>` element.
 * - Application of default and theme providers.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Immutability of the API when setting or overriding attributes.
 * - Nested rendering using `begin()` and `end()` methods.
 * - Precedence of user-defined attributes over global defaults.
 * - Proper assignment and overriding of attribute values, including `class`, `id`, `lang`, `style`, `title`, and
 *   `data-*`.
 * - Stack integrity during nested `begin()` and `end()` calls.
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

    public function testRenderWithAutofocus(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div autofocus>
            </div>
            HTML,
            Div::tag()->autofocus(true)->render(),
            "Failed asserting that element renders correctly with 'autofocus' attribute.",
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

    public function testRenderWithContentEditable(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div contenteditable="true">
            </div>
            HTML,
            Div::tag()->contentEditable(ContentEditable::TRUE)->render(),
            "Failed asserting that element renders correctly with 'contentEditable' attribute.",
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
            "Failed asserting that element renders correctly with 'dataAttributes' attribute.",
        );
    }

    public function testRenderWithDefaultConfigurationValues(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div class="default-class" title="default-title">
            </div>
            HTML,
            Div::tag(['class' => 'default-class', 'title' => 'default-title'])->render(),
            'Failed asserting that default configuration values are applied correctly.',
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

    public function testRenderWithDir(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div dir="rtl">
            </div>
            HTML,
            Div::tag()->dir(Direction::RTL)->render(),
            "Failed asserting that element renders correctly with 'dir' attribute.",
        );
    }

    public function testRenderWithDraggable(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div draggable="true">
            </div>
            HTML,
            Div::tag()->draggable(Draggable::TRUE)->render(),
            "Failed asserting that element renders correctly with 'draggable' attribute.",
        );
    }

    public function testRenderWithGlobalDefaultsAreApplied(): void
    {
        SimpleFactory::setDefaults(Div::class, ['class' => 'from-global']);

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

    public function testRenderWithHidden(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div hidden>
            </div>
            HTML,
            Div::tag()->hidden(true)->render(),
            "Failed asserting that element renders correctly with 'hidden' attribute.",
        );
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

    public function testRenderWithItemId(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div itemid="http://example.com/item">
            </div>
            HTML,
            Div::tag()->itemId('http://example.com/item')->render(),
            "Failed asserting that element renders correctly with 'itemId' attribute.",
        );
    }

    public function testRenderWithItemProp(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div itemprop="name">
            </div>
            HTML,
            Div::tag()->itemProp('name')->render(),
            "Failed asserting that element renders correctly with 'itemProp' attribute.",
        );
    }

    public function testRenderWithItemRef(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div itemref="additional-info">
            </div>
            HTML,
            Div::tag()->itemRef('additional-info')->render(),
            "Failed asserting that element renders correctly with 'itemRef' attribute.",
        );
    }

    public function testRenderWithItemScope(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div itemscope>
            </div>
            HTML,
            Div::tag()->itemScope(true)->render(),
            "Failed asserting that element renders correctly with 'itemScope' attribute.",
        );
    }

    public function testRenderWithItemType(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div itemtype="http://schema.org/Person">
            </div>
            HTML,
            Div::tag()->itemType('http://schema.org/Person')->render(),
            "Failed asserting that element renders correctly with 'itemType' attribute.",
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

    public function testRenderWithNestedDifferentTagsEnsuresStackUpdate(): void
    {
        $html = Div::tag()->begin() . Span::tag()->content('Content')->render() . Div::end();

        self::equalsWithoutLE(
            <<<HTML
            <div>
            <span>Content</span>
            </div>
            HTML,
            $html,
            'Failed asserting that nested different tags render correctly and stack is updated.',
        );
    }

    public function testRenderWithSpellcheck(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div spellcheck="true">
            </div>
            HTML,
            Div::tag()->spellcheck(true)->render(),
            "Failed asserting that element renders correctly with 'spellcheck' attribute.",
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

    public function testRenderWithTabindex(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div tabindex="3">
            </div>
            HTML,
            Div::tag()->tabIndex(3)->render(),
            "Failed asserting that element renders correctly with 'tabindex' attribute.",
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

    public function testRenderWithToString(): void
    {
        self::equalsWithoutLE(
            <<<HTML
            <div>
            </div>
            HTML,
            (string) Div::tag(),
            "Failed asserting that '__toString()' method renders correctly.",
        );
    }

    public function testRenderWithUserOverridesGlobalDefaults(): void
    {
        SimpleFactory::setDefaults(Div::class, ['class' => 'from-global', 'id' => 'id-global']);

        self::equalsWithoutLE(
            <<<HTML
            <div class="from-global" id="id-user">
            </div>
            HTML,
            Div::tag(['id' => 'id-user'])->render(),
            'Failed asserting that user-defined attributes override global defaults correctly.',
        );

        SimpleFactory::setDefaults(Div::class, []);
    }

    public function testReturnEmptyArrayWhenApplyThemeAndUndefinedTheme(): void
    {
        $tag = Div::tag();

        self::assertEmpty(
            $tag->apply($tag, ''),
            'Failed asserting that applying an undefined theme returns an empty array.',
        );
    }

    public function testReturnEmptyArrayWhenGetDefaultsAndNoDefaultsSet(): void
    {
        $tag = Div::tag();

        self::assertEmpty(
            $tag->getDefaults($tag),
            'Failed asserting that getting defaults returns an empty array when no defaults are set.',
        );
    }

    public function testThrowExceptionWhenEndWithMismatchedTag(): void
    {
        $tag = new class extends BaseBlockElement {
            /**
             * Returns the tag enumeration for the `<article>` element.
             *
             * @return Block Tag enumeration instance for `<article>`.
             */
            protected function getTag(): Block
            {
                return Block::ARTICLE;
            }
        };

        $tagClass = get_class($tag);
        Div::tag()->begin();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            Message::TAG_CLASS_MISMATCH_ON_END->getMessage(Div::class, $tagClass),
        );

        $tag::end();
    }

    public function testThrowExceptionWhenEndWithoutBegin(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            Message::UNEXPECTED_END_CALL_NO_BEGIN->getMessage(Div::class),
        );

        Div::end();
    }
}
