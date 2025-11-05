<?php

declare(strict_types=1);

namespace yii\ui\tests\attributes;

use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;
use yii\ui\attributes\HasData;
use yii\ui\exception\Message;

/**
 * Test suite for {@see HasData} trait functionality and behavior.
 *
 * Validates the management of the global HTML `data-*` attributes according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of data attributes in widget and tag rendering, supporting
 * both `string` and `Closure` values for dynamic attribute assignment.
 *
 * The tests cover:
 * - Compliance with HTML specification for custom data attributes.
 * - Exception handling for invalid attribute keys and values.
 * - Immutability of the API when setting or overriding data attributes.
 * - Proper assignment and retrieval of `data-*` attributes with `string` and `Closure` values.
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

    public function testSetDataAttributeWithClosureValue(): void
    {
        $instance = new class {
            use HasData;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        $closure = static fn(): string => 'test-action';

        $instance = $instance->dataAttributes(['action' => $closure]);

        self::assertSame(
            ['data-action' => $closure],
            $instance->attributes,
            'Should return the attribute value after setting it.',
        );
    }

    public function testSetDataAttributeWithStringValue(): void
    {
        $instance = new class {
            use HasData;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        $instance = $instance->dataAttributes(['action' => 'test-action']);

        self::assertSame(
            ['data-action' => 'test-action'],
            $instance->attributes,
            'Should return the attribute value after setting it.',
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
