<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function getSrc() {
        return "/?genre" . $this->getAttribute("id");
    }
}
