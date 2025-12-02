<?php

declare(strict_types=1);

namespace yii\ui\tests\factory;

use Error;
use LogicException;
use PHPUnit\Framework\TestCase;
use yii\ui\exception\Message;
use yii\ui\factory\SimpleFactory;
use yii\ui\tag\BaseTag;
use yii\ui\tests\support\stub\Tag;

/**
 * Test suite for {@see SimpleFactory} functionality and behavior.
 *
 * Validates the instantiation and configuration management of tag elements using the {@see SimpleFactory} according to
 * the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of tag creation, supporting default configuration properties
 * and exception handling for abstract class instantiation and non-public property assignments.
 *
 * Test coverage.
 * - Accurate creation of tag instances with default configuration property values.
 * - Exception handling when attempting to instantiate abstract classes and setting non-public properties.
 * - Validation of property assignment and immutability of the factory API.
 *
 * {@see BaseTag} for abstract tag base class.
 * {@see Message} for exception message enumeration.
 * {@see Tag} for stub implementation details.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class SimpleFactoryTest extends TestCase
{
    public function testCreateWithDefaultConfigurationPropertiesValues(): void
    {
        $tag = Tag::tag(['flag' => true]);

        self::assertTrue(
            $tag->flag,
            'Failed asserting that factory creates instance with default configuration properties values.',
        );
    }

    public function testsThrowExceptionWhenSetNotPublicProperty(): void
    {
        try {
            Tag::tag(['flagDisabled' => true]);
        } catch (Error $e) {
            self::assertSame(
                'Cannot access private property yii\ui\tests\support\stub\Tag::$flagDisabled',
                $e->getMessage(),
                'Failed asserting that exception is thrown when setting not public property via factory.',
            );
        }
    }

    public function testThrowExceptionWhenInstantiateAbstractClass(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            Message::CANNOT_INSTANTIATE_ABSTRACT_CLASS->getMessage(BaseTag::class),
        );

        SimpleFactory::create(BaseTag::class);
    }
}
