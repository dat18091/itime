<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Company;
use App\Employee;
class AdminController extends Controller
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

    /**
     * This function to show the dashboard after login on admin by GET method
     * created by : DatNQ
     * created at : 30/11/2020
    */
    public function dashboard() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $companyCount = Company::count('*');
        $employeeCount = Employee::where('hoat_dong', '1')->orWhere('hoat_dong', '0')
        ->where('ma_cong_ty', $maCongTy)->count('*');
        return view('admin.dashboard')->with('companyCount', $companyCount)->with('employeeCount', $employeeCount);
    }
    
}
