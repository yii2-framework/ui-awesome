<?php

declare(strict_types=1);

namespace yii\ui\tag;

use yii\base\InvalidArgumentException;
use yii\ui\exception\Message;

use function array_filter;
use function array_values;
use function in_array;

/**
 * Classifier for HTML tag types and semantic roles.
 *
 * Provides static methods for determining the classification of HTML tags as block, inline, or void elements,
 * supporting standards-compliant rendering and validation in widget and tag systems. This class centralizes logic for
 * tag type detection, exclusion mapping, and empty tag name validation, ensuring robust and predictable handling of
 * HTML element semantics.
 *
 * Key features:
 * - Defensive validation for empty tag names.
 * - Exclusion-based filtering for accurate tag groupings.
 * - Integration-ready for advanced HTML rendering and widget systems.
 * - Type-safe classification of tags as block, inline, or void.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class ClassifierTag
{
    /**
     * Returns the list of block-level HTML tags, excluding inline, script-supporting, and void tags.
     *
     * @return array Array of block Tag enum instances.
     *
     * @phpstan-return list<Tag>
     *
     * {@see ContentTag::flow()} for included flow content tags.
     * {@see ContentTag::listing()} for excluded listing tags.
     * {@see ContentTag::scriptSupporting()} for excluded script-supporting tags.
     * {@see ContentTag::table()} for excluded table tags.
     * {@see inlineTags()} for excluded inline tags.
     * {@see Tag::FIGCAPTION} for included figcaption tag.
     * {@see Tag::LEGEND} for included legend tag.
     * {@see Tag::SUMMARY} for included summary tag.
     * {@see Tag::void()} for excluded void tags.
     */
    public static function blockTags(): array
    {
        $excludedTags = [
            ...ContentTag::listing(),
            ...ContentTag::scriptSupporting(),
            ...ContentTag::table(),
            ...self::inlineTags(),
            ...Tag::void(),
        ];

        $blockTags = [
            ...ContentTag::flow(),
            Tag::FIGCAPTION,
            Tag::LEGEND,
            Tag::SUMMARY,
        ];

        $excludedMap = [];

        foreach ($excludedTags as $tag) {
            $excludedMap[$tag->value] = true;
        }

        $filtered = array_filter(
            $blockTags,
            static fn(Tag $tag): bool => isset($excludedMap[$tag->value]) === false,
        );

        return array_values($filtered);
    }

    /**
     * Returns the list of inline HTML tags, excluding embedded, script-supporting, and void tags.
     *
     * @return array Array of inline Tag enum instances.
     *
     * @phpstan-return list<Tag>
     *
     * {@see ContentTag::embedded()} for excluded embedded tags.
     * {@see ContentTag::listing()} for excluded listing tags.
     * {@see ContentTag::phrasing()} for included phrasing tags.
     * {@see ContentTag::scriptSupporting()} for excluded script-supporting tags.
     * {@see ContentTag::table()} for excluded table tags.
     * {@see Tag::OPTGROUP} for included optgroup tag.
     * {@see Tag::OPTION} for included option tag.
     * {@see Tag::void()} for excluded void tags.
     */
    public static function inlineTags(): array
    {
        $excludedTags = [
            ...ContentTag::embedded(),
            ...ContentTag::listing(),
            ...ContentTag::scriptSupporting(),
            ...ContentTag::table(),
            ...Tag::void(),
        ];

        $inlineTags = [
            ...ContentTag::phrasing(),
            Tag::OPTGROUP,
            Tag::OPTION,
        ];

        $excludedMap = [];

        foreach ($excludedTags as $tag) {
            $excludedMap[$tag->value] = true;
        }

        $filtered = array_filter(
            $inlineTags,
            static fn(Tag $tag): bool => isset($excludedMap[$tag->value]) === false,
        );

        return array_values($filtered);
    }
    /**
     * Determines whether the given tag is classified as a block element.
     *
     * Validates the tag name and checks membership in the block tag group.
     *
     * @param string|Tag $tag Tag name or Tag enum instance.
     *
     * @throws InvalidArgumentException if the tag name is empty.
     *
     * @return bool Returns `true` if the tag is a block element, `false` otherwise.
     *
     * {@see blockTags()} for the block tag group.
     */
    public static function isBlock(string|Tag $tag): bool
    {
        self::validateEmptyTagName($tag);

        $enum = $tag instanceof Tag ? $tag : Tag::tryFrom($tag);

        if ($enum === null) {
            return false;
        }

        return in_array($enum, self::blockTags(), true);
    }

    /**
     * Determines whether the given tag is classified as an inline element.
     *
     * Validates the tag name and checks membership in the inline tag group.
     *
     * @param string|Tag $tag Tag name or Tag enum instance.
     *
     * @throws InvalidArgumentException if the tag name is empty.
     *
     * @return bool Returns `true` if the tag is an inline element, `false` otherwise.
     *
     * {@see inlineTags()} for the inline tag group.
     */
    public static function isInline(string|Tag $tag): bool
    {
        self::validateEmptyTagName($tag);

        $enum = $tag instanceof Tag ? $tag : Tag::tryFrom($tag);

        if ($enum === null) {
            return false;
        }

        return in_array($enum, self::inlineTags(), true);
    }

    /**
     * Determines whether the given tag is classified as a void element.
     *
     * Validates the tag name and checks if the tag is a void element.
     *
     * @param string|Tag $tag Tag name or Tag enum instance.
     *
     * @throws InvalidArgumentException if the tag name is empty.
     *
     * @return bool Returns `true` if the tag is a void element, `false` otherwise.
     *
     * {@see Tag::isVoid()} for void tag detection.
     */
    public static function isVoid(string|Tag $tag): bool
    {
        self::validateEmptyTagName($tag);

        $enum = $tag instanceof Tag ? $tag : Tag::tryFrom($tag);

        if ($enum === null) {
            return false;
        }

        return Tag::isVoid($enum);
    }

    /**
     * Validates that the provided tag name is not empty.
     *
     * @param string|Tag $tag Tag name or Tag enum instance.
     *
     * @throws InvalidArgumentException if the tag name is empty.
     *
     * {@see Message::EMPTY_TAG_NAME} for exception message.
     */
    private static function validateEmptyTagName(string|Tag $tag): void
    {
        if ($tag === '') {
            throw new InvalidArgumentException(Message::EMPTY_TAG_NAME->getMessage());
        }
    }
}
