<?php

declare(strict_types=1);

namespace yii\ui\tests\attributes;

use PHPUnit\Framework\TestCase;
use yii\ui\attributes\HasClass;

/**
 * Test suite for {@see HasClass} trait functionality and behavior.
 *
 * Verifies the management of the global HTML `class` attribute in widget and tag rendering, ensuring
 * standards-compliant, immutable API for setting and overriding CSS class values.
 *
 * These tests validate correct attribute handling, value merging, and immutability guarantees for dynamic or
 * programmatic manipulation of CSS classes in components.
 *
 * Test coverage.
 * - Accurate retrieval of the current `class` attribute value.
 * - Correct merging and overriding of class values.
 * - Immutability of the trait's API when setting or overriding the `class` attribute.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class HasClassTest extends TestCase
{
    public function testReturnEmptyStringWhenClassAttributeNotSet(): void
    {
        $instance =  new class {
            use HasClass;

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

    public function testReturnNewInstanceWhenSettingClassAttribute(): void
    {
        $instance = new class {
            use HasClass;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        self::assertNotSame(
            $instance,
            $instance->class(''),
            'Should return a new instance when setting the attribute, ensuring immutability.',
        );
    }

    public function testSetClassAttributeValue(): void
    {
        $instance =  new class {
            use HasClass;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        $instance = $instance->class('class-one');

        self::assertSame(
            'class-one',
            $instance->attributes['class'] ?? '',
            'Should return the attribute value after setting it.',
        );

        $instance = $instance->class('class-two');

        self::assertSame(
            'class-one class-two',
            $instance->attributes['class'] ?? '',
            'Should append new attribute value to existing attribute value.',
        );
    }

    public function testSetClassAttributeValueWithOverride(): void
    {
        $instance =  new class {
            use HasClass;

            /**
             * @phpstan-var mixed[]
             */
            public array $attributes = [];
        };

        $instance = $instance->class('class-one');

        self::assertSame(
            'class-one',
            $instance->attributes['class'] ?? '',
            'Should return the attribute value after setting it.',
        );

        $instance = $instance->class('class-override', true);

        self::assertSame(
            'class-override',
            $instance->attributes['class'] ?? '',
            'Should return new attribute value after overriding the existing attribute value.',
        );
    }
}
