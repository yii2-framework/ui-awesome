<?php

declare(strict_types=1);

namespace yii\ui\tag;

use LogicException;
use RuntimeException;
use Stringable;
use yii\ui\event\{HasAfterRun, HasBeforeRun};
use yii\ui\factory\SimpleFactory;
use yii\ui\mixin\HasAttributes;

abstract class BaseTag implements Stringable
{
    use HasAfterRun;
    use HasAttributes;
    use HasBeforeRun;

    private bool $beginExecuted = false;

    /**
     * @phpstan-var list<static>
     */
    private static array $stack = [];

    final public function __construct() {}

    public function __toString(): string
    {
        return $this->render();
    }

    public function begin(): string
    {
        $this->beginExecuted = true;
        self::$stack[] = $this;

        return '';
    }

    final public static function end(): string
    {
        if (self::$stack === []) {
            throw new LogicException(
                sprintf('Unexpected %s::end() call. A matching begin() is not found.', static::class),
            );
        }

        $tag = array_pop(self::$stack);
        $tagClass = $tag::class;

        if ($tagClass !== static::class) {
            throw new RuntimeException(
                sprintf('Expecting end() of %s found %s.', $tagClass, static::class),
            );
        }

        return $tag->render();
    }

    final public function render(): string
    {
        if ($this->beforeRun() === false) {
            return '';
        }

        return $this->afterRun($this->run());
    }

    public static function tag(mixed ...$defaults): static
    {
        /** @phpstan-var static $tag */
        $tag = SimpleFactory::create(static::class);

        $instanceDefaults = $tag->loadDefaults();

        if ($instanceDefaults !== []) {
            array_unshift($defaults, $instanceDefaults);
        }

        foreach ($defaults as $default) {
            if (is_array($default)) {
                /**
                 * @phpstan-var static $tag
                 * @phpstan-var mixed[] $default
                 */
                $tag = SimpleFactory::configure($tag, $default);
            }
        }

        return $tag;
    }

    public function theme(string $name): static
    {
        $definitions = $this->getTheme($name);

        if ($definitions === []) {
            return $this;
        }

        /** @phpstan-var static $configured */
        $configured = SimpleFactory::configure($this, $definitions);

        return $configured;
    }

    /**
     * @phpstan-return mixed[]
     */
    abstract protected function getTheme(string $name): array;

    protected function isBeginExecuted(): bool
    {
        return $this->beginExecuted;
    }

    /**
     * @phpstan-return mixed[]
     */
    abstract protected function loadDefaults(): array;

    abstract protected function run(): string;
}
