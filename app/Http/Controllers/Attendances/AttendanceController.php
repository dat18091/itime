<?php

namespace App\Http\Controllers\Attendances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * 
     */
    public function AuthLogin() {
        $login_id = Session::get('maCongTy');
        $roles = Session::get('phanQuyen');
        if($login_id && $roles == 1) {
            return Redirect::to('/admin/dashboard');
        } else {
            return Redirect::to('/')->send();
        }
    }
}
