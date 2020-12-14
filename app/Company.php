<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Province;
use App\District;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class Company extends Model
{
    protected $table = 'companies';

    public function AuthLogin() {
        $login_id = Session::get('maCongTy');
        $roles = Session::get('phanQuyen');
        if($login_id && $roles == 1) {
            return Redirect::to('/admin/dashboard');
        } else {
            return Redirect::to('/')->send();
        }
    }

    public function provinceId() {
        return $this->belongsTo(Province::class);
    }  
    
    public function districtId() {
        return $this->belongsTo(District::class);
    }
}
