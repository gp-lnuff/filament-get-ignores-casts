<?php

namespace App\Models;

use App\Models\SomeParent\Enums\SomeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SomeParent extends Model {

    protected function casts(): array {
        return [
            'some_field' => SomeEnum::class
        ];
    }

    public function someChild(): HasOne {
        return $this->hasOne(SomeChild::class);
    }
}
