<?php

declare(strict_types=1);

namespace yii\ui\tag;

use Fiber;
use LogicException;
use RuntimeException;
use Stringable;
use yii\ui\event\{HasAfterRun, HasBeforeRun};
use yii\ui\factory\SimpleFactory;
use yii\ui\mixin\HasAttributes;

/**
 * Base class for advanced HTML tag rendering and management.
 *
 * Provides a robust, extensible, and immutable API for creating, configuring, and rendering HTML tags in a
 * standards-compliant, type-safe manner for modern web applications and UI systems.
 *
 * Designed as a foundation for concrete tag implementations, this class enables consistent and secure HTML output
 * across complex UI systems, supporting event hooks, theming, and stack-based rendering for nested structures.
 *
 * Key features:
 * - Fiber-aware stack management ensures isolation in async environments (Swoole, RoadRunner, FrankenPHP).
 * - Immutable configuration and theme support for flexible tag customization.
 * - Integration-ready with before/after run event hooks for extensible rendering.
 * - Stack-based begin/end rendering for managing nested tag structures.
 * - Strict type safety and PHPStan compatibility for modern PHP development.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
abstract class BaseTag implements DefaultsProviderInterface, ThemeProviderInterface, Stringable
{
    use HasAfterRun;
    use HasAttributes;
    use HasBeforeRun;

    /**
     * Main thread context identifier for stack management.
     */
    private const MAIN_THREAD_CONTEXT = 0;

    /**
     * Indicates whether the `begin()` method has been executed for this tag instance.
     *
     * Used internally to manage the tag rendering lifecycle and stack integrity.
     */
    private bool $beginExecuted = false;

    /**
     * Stack of tag instances for managing nested begin/end rendering.
     *
     * @phpstan-var static[][]
     */
    private static array $stack = [];

    /**
     * Initializes a new tag instance.
     *
     * The constructor is final to enforce immutability and consistent instantiation via factory methods.
     */
    final public function __construct() {}

    /**
     * Renders the tag as a string.
     *
     * Invokes the `render()` method to produce the HTML representation of the tag.
     *
     * @return string Rendered HTML tag string.
     *
     * Usage example:
     * ```php
     * <?= $element ?>
     * ```
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * Renders the core HTML output for the tag.
     *
     * Must be implemented by concrete subclasses to generate the tag's HTML representation.
     *
     * @return string Rendered HTML tag string.
     */
    abstract protected function run(): string;

    /**
     * Adds one or more default providers to the tag instance.
     *
     * Applies configuration defaults from the specified provider classes to the tag.
     *
     * @param string ...$providers List of default provider class names.
     *
     * @return static Tag instance with applied default providers.
     *
     * @phpstan-param class-string<DefaultsProviderInterface> ...$providers
     */
    public function addDefaultProvider(string ...$providers): static
    {
        $tag = $this;

        foreach ($providers as $provider) {
            $provider = new $provider();

            $definitions = $provider->getDefaults($tag);

            if ($definitions !== []) {
                /** @phpstan-var static $tag */
                $tag = SimpleFactory::configure($tag, $definitions);
            }
        }

        return $tag;
    }

    /**
     * Adds one or more theme providers to the tag instance.
     *
     * Applies theme configuration from the specified provider classes to the tag.
     *
     * @param string $name Theme name to apply.
     * @param string ...$themeProviders List of theme provider class names.
     *
     * @return static Tag instance with applied theme providers.
     *
     * @phpstan-param class-string<ThemeProviderInterface> ...$themeProviders
     */
    public function addThemeProvider(string $name, string ...$themeProviders): static
    {
        $tag = $this;

        foreach ($themeProviders as $providerClass) {
            $provider = new $providerClass();

            $definitions = $provider->apply($tag, $name);

            if ($definitions !== []) {
                /** @phpstan-var static $tag */
                $tag = SimpleFactory::configure($tag, $definitions);
            }
        }

        return $tag;
    }

    /**
     * Applies a theme configuration to the tag instance.
     *
     * Returns an array of configuration values for the given tag and theme.
     *
     * @param BaseTag $tag Tag instance being configured.
     * @param string $theme Theme name to apply.
     *
     * @return array Configuration array for the theme.
     *
     * @phpstan-return mixed[]
     */
    public function apply(BaseTag $tag, string $theme): array
    {
        return [];
    }

    /**
     * Begins a tag rendering block and pushes the instance onto the context-specific stack.
     *
     * Identifies the current execution context (Fiber or Main Thread) and stores the tag instance in the corresponding
     * stack, ensuring safe nesting even in concurrent environments.
     *
     * Marks the tag as begun and prepares it for the paired `end()` call.
     *
     * @return string Empty string for output buffering compatibility.
     *
     * Usage example:
     * ```php
     * <?= Element::tag()->begin() ?>
     * Content inside the tag.
     * <?= Element::end() ?>
     * ```
     */
    public function begin(): string
    {
        $this->beginExecuted = true;

        $contextId = self::getContextId();

        self::$stack[$contextId][] = $this;

        return '';
    }

    /**
     * Ends the most recently begun tag rendering block.
     *
     * Pops the tag instance from the stack and renders its HTML output.
     *
     * @throws LogicException if no matching `begin()` call is found.
     * @throws RuntimeException if the tag class does not match the expected type.
     *
     * @return string Rendered HTML tag string.
     *
     * Usage example:
     * ```php
     * <?= Element::end() ?>
     * ```
     */
    final public static function end(): string
    {
        $id = self::getContextId();

        if (isset(self::$stack[$id]) === false || self::$stack[$id] === []) {

            throw new LogicException(
                sprintf('Unexpected %s::end() call. A matching begin() is not found.', static::class),
            );
        }

        $tag = array_pop(self::$stack[$id]);

        if (self::$stack[$id] === []) {
            unset(self::$stack[$id]);
        }

        $tagClass = $tag::class;

        if ($tagClass !== static::class) {
            throw new RuntimeException(
                sprintf('Expecting end() of %s found %s.', $tagClass, static::class),
            );
        }

        return $tag->render();
    }

    /**
     * Returns configuration defaults for the given tag instance.
     *
     * @param BaseTag $tag Tag instance being configured.
     *
     * @return array<string, mixed> Cookbook-style configuration array.
     *
     * @phpstan-return mixed[]
     */
    public function getDefaults(BaseTag $tag): array
    {
        return [];
    }

    /**
     * Renders the tag, applying before and after run event hooks.
     *
     * Executes the `beforeRun()` and `afterRun()` hooks around the core `run()` rendering logic.
     *
     * @return string Rendered HTML tag string, or empty string if rendering is skipped.
     *
     * Usage example:
     * ```php
     * <?= $tag->render() ?>
     * ```
     */
    final public function render(): string
    {
        if ($this->beforeRun() === false) {
            return '';
        }

        return $this->afterRun($this->run());
    }

    /**
     * Creates and configures a new tag instance.
     *
     * Configuration priority (from weakest to strongest):
     * - Global defaults defined via {@see SimpleFactory::setDefaults()}.
     * - Defaults passed directly by the user to {@see tag()}.
     *
     * After construction, additional user modifications (via setter methods like `class()`, `id()`, `data()`, etc.) and
     * theme overrides will always have the highest priority.
     *
     * @param array ...$defaults Configuration cookbook arrays. Each array maps "methodName()" → arguments, and will be
     * applied in order.
     *
     * @return static Fully configured tag instance.
     *
     * @phpstan-param mixed[] ...$defaults
     */
    public static function tag(array ...$defaults): static
    {
        /** @phpstan-var static $tag */
        $tag = SimpleFactory::create(static::class);

        $pipeline = [
            SimpleFactory::getDefaults(static::class),
            ...$defaults,
        ];

        foreach ($pipeline as $definition) {
            if ($definition !== []) {
                /** @phpstan-var static $tag */
                $tag = SimpleFactory::configure($tag, $definition);
            }
        }

        return $tag;
    }

    /**
     * Indicates whether the `begin()` method has been executed for this tag instance.
     *
     * Used internally for stack and lifecycle management.
     *
     * @return bool Returns `true` if `begin()` was executed, `false` otherwise.
     */
    protected function isBeginExecuted(): bool
    {
        return $this->beginExecuted;
    }

    /**
     * Retrieves the unique identifier for the current execution context.
     *
     * Determines whether the code is running inside a Fiber (asynchronous context) or the Main Thread (synchronous
     * context).
     *
     * - In a Fiber: Returns the unique object ID of the current Fiber.
     * - In Main Thread: Returns the constant `MAIN_THREAD_CONTEXT`.
     *
     * This ensures that the tag stack is correctly scoped per request in environments like Swoole, RoadRunner or
     * FrankenPHP.
     *
     * @return int Unique context identifier.
     */
    private static function getContextId(): int
    {
        return ($fiber = Fiber::getCurrent()) !== null ? spl_object_id($fiber) : self::MAIN_THREAD_CONTEXT;
    }
}
