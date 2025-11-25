<?php

declare(strict_types=1);

namespace yii\ui\tests\attributes;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use yii\ui\attributes\HasId;
use yii\ui\tests\providers\attributes\IdProvider;

/**
 * Test suite for {@see HasId} trait functionality and behavior.
 *
 * Validates the management of the global HTML `id` attribute according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of the `id` attribute in widget and tag rendering, supporting
 * both `string` and `null` values for dynamic identifier assignment.
 *
 * Test coverage.
 * - Accurate retrieval of the current `id` attribute value.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Immutability of the trait's API when setting or overriding the `id` attribute.
 * - Proper assignment and overriding of `id` values.
 *
 * {@see IdProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('attributes')]
final class HasIdTest extends TestCase
{
    public function testReturnEmptyStringWhenIdAttributeNotSet(): void
    {
        $instance =  new class {
            use HasId;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        self::assertEmpty(
            $instance->attributes,
            'Should return an empty string when no attribute is set.',
        );
    }

    public function testReturnNewInstanceWhenSettingIdAttribute(): void
    {
        $instance = new class {
            use HasId;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        self::assertNotSame(
            $instance,
            $instance->id(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    /**
     * @phpstan-param mixed[] $attributes
     */
    #[DataProviderExternal(IdProvider::class, 'values')]
    public function testSetIdAttributeValue(
        string|null $id,
        array $attributes,
        string|null $expected,
        string $message,
    ): void {
        $instance = new class {
            use HasId;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        $instance->attributes = $attributes;

        $instance = $instance->id($id);

        self::assertSame(
            $expected,
            $instance->attributes['id'] ?? '',
            $message,
        );
    }
}
