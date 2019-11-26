<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    public function elects() {
        return $this->belongsTo("App\Story", "elect_id");
    }
}
