<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reed_later extends Model
{
    public function story() {
        return $this->belongsTo("App\Story");
    }
}
