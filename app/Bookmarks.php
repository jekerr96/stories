<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model
{
    public function story() {
        return $this->belongsTo("App\Story");
    }
}
