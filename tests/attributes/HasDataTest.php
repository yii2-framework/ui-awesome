<?php

declare(strict_types=1);

namespace yii\ui\tests\attributes;

use Closure;
use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\attributes\HasData;
use yii\ui\exception\Message;
use yii\ui\helpers\Attributes;
use yii\ui\mixin\HasAttributes;
use yii\ui\tests\providers\tag\attributes\DataProvider;

/**
 * Test suite for {@see HasData} trait functionality and behavior.
 *
 * Validates the management of the global HTML `data-*` attributes according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of `data-*` attributes in widget and tag rendering, supporting
 * both `string` and `\Closure` values for dynamic data assignment.
 *
 * Test coverage.
 * - Accurate rendering of attributes with `data-*` attributes.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for invalid keys and values.
 * - Immutability of the trait's API when setting or overriding `data-*` attributes.
 * - Proper assignment and overriding of `data-*` values.
 *
 * {@see DataProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('attributes')]
final class HasDataTest extends TestCase
{
    /**
     * @param array<string, string|Closure(): mixed> $data
     * @phpstan-param mixed[] $attributes
     */
    #[DataProviderExternal(DataProvider::class, 'renderAttribute')]
    public function testRenderAttributesWithDataAttribute(
        array $data,
        array $attributes,
        string $expected,
        string $message,
    ): void {
        $instance = new class {
            use HasAttributes;
            use HasData;
        };

        $instance = $instance->attributes($attributes)->dataAttributes($data);

        self::assertSame(
            $expected,
            Attributes::render($instance->getAttributes()),
            $message,
        );
    }

    public function testReturnNewInstanceWhenSettingDataAttribute(): void
    {
        $instance = new class {
            use HasAttributes;
            use HasData;
        };

        self::assertNotSame(
            $instance,
            $instance->dataAttributes(['action' => 'test-action']),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    /**
     * @param array<string, string|Closure(): mixed> $data
     * @param array<string, string|Closure(): mixed> $expected
     */
    #[DataProviderExternal(DataProvider::class, 'values')]
    public function testSetDataAttributeValue(array $data, array $expected, string $assertion): void
    {
        $instance = new class {
            use HasAttributes;
            use HasData;
        };

        $instance = $instance->dataAttributes($data);

        self::assertSame(
            $expected,
            $instance->getAttributes(),
            $assertion,
        );
    }

    public function testThrowInvalidArgumentExceptionWhenKeyIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::DATA_ATTRIBUTE_KEY_NOT_EMPTY->getMessage(),
        );

        $instance = new class {
            use HasAttributes;
            use HasData;
        };

        $instance->dataAttributes(['' => 'value']);
    }

    public function testThrowInvalidArgumentExceptionWhenKeyIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::DATA_ATTRIBUTE_KEY_MUST_BE_STRING->getMessage('integer'),
        );

        $instance = new class {
            use HasAttributes;
            use HasData;
        };

        $instance->dataAttributes([1 => '']);
    }

    public function testThrowInvalidArgumentExceptionWhenValueIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::DATA_ATTRIBUTE_VALUE_MUST_BE_STRING_OR_CLOSURE->getMessage('integer'),
        );

        $instance = new class {
            use HasAttributes;
            use HasData;
        };

        $instance->dataAttributes(['key' => 1]);
    }
}
