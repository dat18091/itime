<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Province;
use App\District;

class Company extends Model
{
    public function provinceId() {
        return $this->belongsTo(Province::class);
    }  
    
    public function districtId() {
        return $this->belongsTo(District::class);
    }
}
