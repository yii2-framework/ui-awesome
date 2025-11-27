<?php

declare(strict_types=1);

namespace yii\ui\tests\mixin;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use yii\ui\mixin\HasTemplate;

#[Group('mixin')]
final class HasTemplateTest extends TestCase
{
    public function testReturnEmptyStringWhenTemplateNotSet(): void
    {
        $instance = new class {
            use HasTemplate;

            public function getTemplate(): string
            {
                return $this->template;
            }
        };

        self::assertSame(
            '',
            $instance->getTemplate(),
            'Should return an empty string when no template is set.',
        );
    }

    public function testReturnNewInstanceWhenSettingTemplate(): void
    {
        $instance = new class {
            use HasTemplate;

            public function getTemplate(): string
            {
                return $this->template;
            }
        };

        self::assertNotSame(
            $instance,
            $instance->template(''),
            'Should return a new instance when setting the template, ensuring immutability.',
        );
    }

    public function testSetTemplateValue(): void
    {
        $instance = new class {
            use HasTemplate;

            public function getTemplate(): string
            {
                return $this->template;
            }
        };

        $instance = $instance->template('{prefix}\n{tag}\n{suffix}');

        self::assertSame(
            '{prefix}\n{tag}\n{suffix}',
            $instance->getTemplate(),
            'Should return the template value after setting it.',
        );
    }
}
