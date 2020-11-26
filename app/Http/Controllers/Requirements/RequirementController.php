<?php

namespace App\Http\Controllers\Requirements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class RequirementController extends Controller
{
    /**
     * This function to check accesses from outside
     * created by : DatNQ
     * created at : 02/11/2020
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

    public function list_requirements_takeleave() {
        $this->AuthLogin();
        return view('admin.requirements.list-requirements-takeleave');
    }

    public function list_requirements_soon() {
        $this->AuthLogin();
        return view('admin.requirements.list-requirements-soon');
    }

    public function list_requirements_late() {
        $this->AuthLogin();
        return view('admin.requirements.list-requirements-late');
    }
}
