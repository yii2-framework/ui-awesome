<?php

declare(strict_types=1);

namespace yii\ui\tests\helpers;

use PHPUnit\Framework\Attributes\{DataProviderExternal, Group};
use PHPUnit\Framework\TestCase;
use UnitEnum;
use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;
use yii\ui\helpers\CSSClass;
use yii\ui\tests\providers\CSSClassProvider;
use yii\ui\tests\support\stub\enum\AlertType;

/**
 * Test suite for {@see CSSClass} helper functionality and behavior.
 *
 * Validates the management of the global HTML `class` attribute according to the HTML Living Standard specification.
 *
 * Ensures correct handling, immutability, and validation of the `class` attribute in widget and tag rendering,
 * supporting `string`, `UnitEnum`, and `null` for dynamic CSS class assignment.
 *
 * Test coverage.
 * - Accurate retrieval and assignment of `class` attributes.
 * - Data provider-driven validation for edge cases and expected behaviors.
 * - Exception handling for invalid values.
 * - Immutability of the helper's API when setting or overriding `class` attributes.
 * - Proper assignment and overriding of `class` values.
 *
 * {@see CSSClassProvider} for test case data providers.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
#[Group('helpers')]
final class CSSClassTest extends TestCase
{
    /**
     * @throws InvalidArgumentException for invalid value errors.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-param list<array{classes: mixed[]|string|UnitEnum|null, override?: bool}> $operations
     * @phpstan-param mixed[] $expected
     */
    #[DataProviderExternal(CSSClassProvider::class, 'values')]
    public function testAddClassAttributeValue(
        array $attributes,
        array $operations,
        array $expected,
        string $message,
    ): void {
        foreach ($operations as $operation) {
            $override = $operation['override'] ?? null;

            match ($override) {
                true => CSSClass::add($attributes, $operation['classes'], true),
                default => CSSClass::add($attributes, $operation['classes']),
            };
        }

        self::assertSame(
            $expected,
            $attributes,
            $message,
        );
    }

    public function testThrowExceptionForInvalidClassValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'indigo',
                'class',
                implode('\', \'', ['blue', 'gray', 'green', 'red', 'yellow']),
            ),
        );

        CSSClass::render(
            'indigo',
            'p-4 mb-4 text-sm text-%1$s-800 rounded-lg bg-%1$s-50 dark:bg-gray-800 dark:text-%1$s-400',
            ['blue', 'gray', 'green', 'red', 'yellow'],
        );
    }

    public function testThrowExceptionForInvalidEnum(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            Message::VALUE_NOT_IN_LIST->getMessage(
                'info',
                'class',
                implode('\', \'', ['success', 'warning', 'error']),
            ),
        );

        CSSClass::render(AlertType::INFO, 'alert alert-%s', ['success', 'warning', 'error']);
    }
}
