<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Educationlevel;

class Position extends Model
{
    protected $table = 'positions';
    
    public function maTrinhDo() {
        return $this->belongsTo(Educationlevel::class);
    }
}
