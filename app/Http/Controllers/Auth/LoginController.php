<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
session_start();

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * This function to redirect login page
     * created by : DateNQ
     * created at : 30/10/2020
     */
    public function login() {
        return view('auth.login');
    }

    /**
     * This function to login handle data by post method
     * created by : DateNQ
     * created at : 30/10/2020
     */
    public function sign_in(Request $request) {
        $tenTruyCap = $request->ten_truy_cap;
        $matKhau = md5($request->mat_khau);
        // $maCongTy = $request->ma_cong_ty;
        if($tenTruyCap == "" || $matKhau == "") {
            Session::put("message", "Các trường không được để trống.");
            return Redirect::to('/login');
        } else if(strlen($tenTruyCap) > 100 || strlen($matKhau) > 100) {
            Session::put("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/login');
        } else if(strlen($tenTruyCap) < 5 || strlen($matKhau) < 5) {
            Session::put("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/login');
        } else if(strpos($matKhau, "OR") === 0 || strpos($matKhau, "or") === 0 || strpos($matKhau, "1=1") === 0 || 
            strpos($matKhau, ";") === 0 || strpos($matKhau, "--") === 0) {
            # === dùng để so sánh giá trị giữa các biến và hằng đúng theo giá trị và kiểu dữ liệu của nó
            Session::put("message", "Mật khẩu của bạn chứa ký tự nguy hiểm.");
            return Redirect::to('/login');
        } else {
            $result = DB::table('companies')->where('ten_truy_cap', $tenTruyCap)
                    ->where('mat_khau', $matKhau)->first();
            if($result) {
                Session::put("tenTruyCap", $tenTruyCap);
                // Session::put('maCongTy', $maCongTy);
                Session::put('message', 'Đăng nhập thành công.');
                return Redirect::to("/admin/dashboard");
            } else {
                Session::put('message', 'Tên truy cập hoặc mật khẩu không đúng.');
                return Redirect::to("/login");
            }
        }
    }

    public function logout() {
        Session::put("tenTruyCap", null);
        return Redirect::to('/');
    }
}
