<?php

declare(strict_types=1);

namespace yii\ui\tests\html;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\ui\html\Html;
use yii\ui\tag\{Block, Inline, Lists, Root, Table, Voids};
use yii\ui\tests\providers\tag\{
    BlockProvider,
    InlineProvider,
    ListsProvider,
    RootProvider,
    TableProvider,
    VoidProvider,
};
use yii\ui\tests\support\TestSupport;

/**
 * Test suite for {@see Html} rendering logic and tag validation.
 *
 * Validates the correct handling and output of HTML tags according to the HTML Living Standard specification.
 *
 * Ensures proper rendering, immutability, and validation of block, inline, list, root, table and void elements,
 * supporting `UnitEnum` tag names.
 *
 * Test coverage:
 * - Accurate rendering of block, inline, list, root, table and void HTML tags.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for invalid tag names and element types.
 * - Immutability of the API when rendering or validating tags.
 * - Proper assignment and normalization of tag names.
 *
 * {@see BlockProvider}, {@see InlineProvider}, {@see ListsProvider}, {@see RootProvider}, {@see TableProvider},
 * {@see VoidProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('html')]
final class HtmlTest extends TestCase
{
    use TestSupport;

    #[DataProviderExternal(BlockProvider::class, 'blockTags')]
    public function testRenderBeginWithBlockTag(Block $tag, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "<{$expectedTagName}>",
            Html::begin($tag),
            "Html begin '<{$expectedTagName}>' block tag should match expected output.",
        );
    }

    #[DataProviderExternal(ListsProvider::class, 'listTags')]
    public function testRenderBeginWithListTag(Lists $tag, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "<{$expectedTagName}>",
            Html::begin($tag),
            "Html begin '<{$expectedTagName}>' list tag should match expected output.",
        );
    }

    #[DataProviderExternal(RootProvider::class, 'rootTags')]
    public function testRenderBeginWithRootTag(Root $tag, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "<{$expectedTagName}>",
            Html::begin($tag),
            "Html begin '<{$expectedTagName}>' root tag should match expected output.",
        );
    }

    #[DataProviderExternal(TableProvider::class, 'tableTags')]
    public function testRenderBeginWithTableTag(Table $tag, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "<{$expectedTagName}>",
            Html::begin($tag),
            "Html begin '<{$expectedTagName}>' table tag should match expected output.",
        );
    }

    #[DataProviderExternal(BlockProvider::class, 'blockTags')]
    public function testRenderEndWithBlockTag(Block $tag, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "</{$expectedTagName}>",
            Html::end($tag),
            "Html end '</{$expectedTagName}>' block tag should match expected output.",
        );
    }

    #[DataProviderExternal(ListsProvider::class, 'listTags')]
    public function testRenderEndWithListTag(Lists $tag, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "</{$expectedTagName}>",
            Html::end($tag),
            "Html end '</{$expectedTagName}>' list tag should match expected output.",
        );
    }

    #[DataProviderExternal(RootProvider::class, 'rootTags')]
    public function testRenderEndWithRootTag(Root $tag, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "</{$expectedTagName}>",
            Html::end($tag),
            "Html end '</{$expectedTagName}>' root tag should match expected output.",
        );
    }

    #[DataProviderExternal(TableProvider::class, 'tableTags')]
    public function testRenderEndWithTableTag(Table $tag, string $expectedTagName): void
    {
        self::equalsWithoutLE(
            "</{$expectedTagName}>",
            Html::end($tag),
            "Html end '</{$expectedTagName}>' table tag should match expected output.",
        );
    }

    #[DataProviderExternal(InlineProvider::class, 'inlineTags')]
    public function testRenderInline(Inline $tag, string $expectedTagName): void
    {
        $content = '<mark>inline</mark>';
        $attributes = ['id' => 'inline'];

        self::equalsWithoutLE(
            "<{$expectedTagName} id=\"inline\">{$content}</{$expectedTagName}>",
            Html::inline($tag, $content, $attributes),
            "Html inline '<{$expectedTagName}>' tag without encoding should match expected output.",
        );
        self::equalsWithoutLE(
            "<{$expectedTagName} id=\"inline\">&lt;mark&gt;inline&lt;/mark&gt;</{$expectedTagName}>",
            Html::inline($tag, $content, $attributes, true),
            "Html inline '<{$expectedTagName}>' tag with encoding should match expected output.",
        );
    }

    #[DataProviderExternal(VoidProvider::class, 'voidTags')]
    public function testRenderVoid(Voids $tag, string $expectedTagName): void
    {
        $attributes = [
            'class' => ['void'],
            'data' => ['role' => 'presentation'],
        ];

        self::equalsWithoutLE(
            "<{$expectedTagName} class=\"void\" data-role=\"presentation\">",
            Html::void($tag, $attributes),
            "Html void '<{$expectedTagName}>' tag should match expected output.",
        );
    }
}
