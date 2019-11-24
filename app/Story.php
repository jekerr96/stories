<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    public function getSrc() {
        return "stories/" . $this->id . "/";
    }

    public function genres() {
        return $this->belongsToMany("App\Genre");
    }
}
