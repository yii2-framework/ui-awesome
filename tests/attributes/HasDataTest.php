<?php

declare(strict_types=1);

namespace yii\ui\tests\attributes;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\attributes\HasData;
use yii\ui\exception\Message;
use yii\ui\tests\providers\attributes\DataProvider;

/**
 * Test suite for {@see HasData} trait functionality and behavior.
 *
 * Validates the management of the global HTML `data-*` attribute according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of the `data-*` attribute in widget and tag rendering,
 * supporting both `string` and `Closure(): string` values for dynamic data attribute assignment.
 *
 * Test coverage.
 * - Accurate retrieval and assignment of `data-*` attributes.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for invalid keys and values.
 * - Immutability of the trait's API when setting or overriding data attributes.
 * - Proper assignment and overriding of data attribute values.
 *
 * {@see DataProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class HasDataTest extends TestCase
{
    public function testReturnNewInstanceWhenSettingDataAttribute(): void
    {
        $instance = new class {
            use HasData;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        self::assertNotSame(
            $instance,
            $instance->dataAttributes(['action' => 'test-action']),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    /**
     * @param array<string, string|\Closure(): string> $input
     * @param array<string, string|\Closure(): string> $expected
     */
    #[DataProviderExternal(DataProvider::class, 'values')]
    public function testSetDataAttributeValue(array $input, array $expected, string $assertion): void
    {
        $instance = new class {
            use HasData;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        $instance = $instance->dataAttributes($input);

        self::assertSame(
            $expected,
            $instance->attributes,
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
            use HasData;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
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
            use HasData;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
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
            use HasData;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        $instance->dataAttributes(['key' => 1]);
    }
}
