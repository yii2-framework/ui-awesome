<?php

declare(strict_types=1);

namespace yii\ui\tests\attributes;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UnitEnum;
use yii\ui\attributes\HasLang;
use yii\ui\helpers\Attributes;
use yii\ui\mixin\HasAttributes;
use yii\ui\tests\providers\attributes\LangProvider;

/**
 * Test suite for {@see HasLang} trait functionality and behavior.
 *
 * Validates the management of the global HTML `lang` attribute according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of the `lang` attribute in widget and tag rendering,
 * supporting `string`, `UnitEnum`, and `null` values for dynamic language assignment.
 *
 * Test coverage:
 * - Accurate rendering of attributes with the `lang` attribute.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Immutability of the trait's API when setting or overriding the `lang` attribute.
 * - Proper assignment and overriding of `lang` values.
 *
 * {@see LangProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('attributes')]
final class HasLangTest extends TestCase
{
    /**
     * @phpstan-param mixed[] $attributes
     */
    #[DataProviderExternal(LangProvider::class, 'renderAttribute')]
    public function testRenderAttributesWithLangAttribute(
        string|UnitEnum|null $lang,
        array $attributes,
        string|UnitEnum $expected,
        string $message,
    ): void {
        $instance = new class {
            use HasAttributes;
            use HasLang;
        };

        $instance = $instance->attributes($attributes)->lang($lang);

        self::assertSame(
            $expected,
            Attributes::render($instance->getAttributes()),
            $message,
        );
    }

    public function testReturnEmptyWhenLangAttributeNotSet(): void
    {
        $instance =  new class {
            use HasAttributes;
            use HasLang;
        };

        self::assertEmpty(
            $instance->getAttributes(),
            'Should have no attributes set when no attribute is provided.',
        );
    }

    public function testReturnNewInstanceWhenSettingLangAttribute(): void
    {
        $instance = new class {
            use HasAttributes;
            use HasLang;
        };

        self::assertNotSame(
            $instance,
            $instance->lang(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    /**
     * @phpstan-param mixed[] $attributes
     */
    #[DataProviderExternal(LangProvider::class, 'values')]
    public function testSetLangAttributeValue(
        string|UnitEnum|null $lang,
        array $attributes,
        string|UnitEnum $expected,
        string $message,
    ): void {
        $instance = new class {
            use HasAttributes;
            use HasLang;
        };

        $instance = $instance->attributes($attributes)->lang($lang);

        self::assertSame(
            $expected,
            $instance->getAttributes()['lang'] ?? '',
            $message,
        );
    }
}
