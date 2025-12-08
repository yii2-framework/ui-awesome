<?php

declare(strict_types=1);

namespace yii\ui\attributes;

use UnitEnum;

trait HasDir
{
    public function dir(string|UnitEnum|null $value): static
    {
        $new = clone $this;

        if ($value === null) {
            unset($new->attributes['dir']);
        } else {
            $new->attributes['dir'] = $value;
        }

        return $new;
    }
}
