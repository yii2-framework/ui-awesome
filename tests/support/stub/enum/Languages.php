<?php

declare(strict_types=1);

namespace yii\ui\tests\support\stub\enum;

/**
 * Enum type representing language codes for HTML helper and UI component testing.
 *
 * Provides a standardized set of language values for use in test scenarios involving localization, attribute
 * generation, and component rendering.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Languages: string
{
    /**
     * Language code for English.
     */
    case ENGLISH = 'en';

    /**
     * Language code for French.
     */
    case FRENCH = 'fr';

    /**
     * Language code for German.
     */
    case GERMAN = 'de';

    /**
     * Language code for Spanish.
     */
    case SPANISH = 'es';
}
