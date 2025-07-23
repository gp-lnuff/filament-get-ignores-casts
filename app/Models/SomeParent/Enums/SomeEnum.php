<?php

namespace App\Models\SomeParent\Enums;

use Filament\Support\Contracts\HasLabel;

enum SomeEnum: int implements HasLabel {
    case First = 0;
    case Second = 1;
    case Third = 2;
    case Fourth = 3;

    public function getLabel(): ?string {
        return match ($this) {
            self::First => 'Enable',
            self::Second => 'Disable',
            self::Third => 'Filler',
            self::Fourth => 'Filler 2',
        };
    }
}
