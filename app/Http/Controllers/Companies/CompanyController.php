<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CompanyController extends Controller
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

    /**
     * When point at this URL path then show list of companies
     * created by : DatNQ
     * created at : 30/10/2020
     */
    public function list_companies() {
        $this->AuthLogin();
        $companies = DB::table('companies')->get();
        return view("admin.companies.list_company")->with("companies", $companies);
    }
}
