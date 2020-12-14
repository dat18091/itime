<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;
use App\Province;

class Branch extends Model
{
    protected $table = 'branches';

    public function districtId() {
        return $this->belongsTo(District::class);
    }

    public function provinceId() {
        return $this->belongsTo(Province::class);
    }

    public function areaId()
    {
        return $this->belongsTo(Area::class);
    }
}
