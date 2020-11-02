<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Educationlevel;

class Position extends Model
{
    public function maTrinhDo() {
        return $this->belongsTo(Educationlevel::class);
    }
}
