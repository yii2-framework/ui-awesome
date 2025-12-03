<?php

declare(strict_types=1);

namespace yii\ui\tests\tag;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use yii\ui\html\Html;
use yii\ui\tag\{BaseTag, Inline};

/**
 * Test suite for {@see BaseTag} element functionality and behavior.
 *
 * Validates the management and rendering of the base HTML tag element according to the HTML Living Standard
 * specification.
 *
 * Ensures correct handling of the `beforeRun()` lifecycle method and its effect on rendering.
 *
 * {@see BaseTag} for element implementation details.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('tag')]
final class BaseTagTest extends TestCase
{
    public function testBeforeRunReturnFalse(): void
    {
        $tag = new class() extends BaseTag {
            protected function getTag(): Inline
            {
                return Inline::SPAN;
            }

            protected function beforeRun(): bool
            {
                return false;
            }

            protected function run(): string
            {
                return Html::inline($this->getTag(), '', $this->attributes);
            }
        };

        self::assertEmpty(
            $tag->render(),
            "Expected empty output when 'beforeRun()' method returns 'false'.",
        );
    }
}
