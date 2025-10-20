<?php

declare(strict_types=1);

namespace yii\ui\tests\support\stub\enum;

/**
 * Enum type representing button size categories for HTML helper and UI component testing.
 *
 * Provides a set of standardized button size values for use in test scenarios involving CSS class generation, attribute
 * handling, and component rendering.
 *
 * @copyright Copyright (C) 2025 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum ButtonSize: string
{
    /**
     * Size representing large buttons.
     */
    case LARGE = 'lg';

    /**
     * Size representing medium buttons.
     */
    case MEDIUM = 'md';

    /**
     * Size representing small buttons.
     */
    case SMALL = 'sm';
}
