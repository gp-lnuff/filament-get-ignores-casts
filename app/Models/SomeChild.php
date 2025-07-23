<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SomeChild extends Model {

    public function someParent() {
        return $this->belongsTo(SomeParent::class);
    }
}
