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
use App\Company;

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
     * This function to redirect login page
     * created by : DateNQ
     * created at : 30/10/2020
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * This function to login handle data by post method
     * created by : DateNQ
     * created at : 30/10/2020
     */
    public function sign_in(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);
        $client = new \GuzzleHttp\Client();
        if ($username == "" || $password == "") {
            Session::flash("message", "Tên truy cập hoặc mật khẩu không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/login');
        } else if (strlen($username) > 100 || strlen($password) > 100) {
            Session::flash("message", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/login');
        } else if (strlen($username) < 5 || strlen($password) < 5) {
            Session::flash("message", "Bạn đã nhập ký tự quá ngắn.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/login');
        } else if (
            strpos($password, "OR") === 0 || strpos($password, "or") === 0 || strpos($password, "1=1") === 0 ||
            strpos($password, ";") === 0 || strpos($password, "--") === 0
        ) {
            # === dùng để so sánh giá trị giữa các biến và hằng đúng theo giá trị và kiểu dữ liệu của nó
            Session::flash("message", "Mật khẩu của bạn chứa ký tự nguy hiểm.");
            Session::flash("alert-type", "danger");
            return Redirect::to('/login');
        } else {
            $result = Company::where('username', $username)->where('password', $password)->first();
            if ($result) {
                ///////////////////////
                ///////////////////////
                Session::put("tenTruyCap", $username);
                Session::put('maCongTy', $result->id);
                Session::put('phanQuyen', $result->roles_id);
                Session::put('email', $result->email);
                Session::flash("message", "Đăng nhập thành công.");
                Session::flash("alert-type", "success");
                return Redirect::to("/admin/dashboard");
            } else {
                Session::flash('message', 'Tên truy cập hoặc mật khẩu không đúng.');
                Session::flash("alert-type", "warning");
                return Redirect::to("/login");
            }
        }
    }

    public function logout()
    {
        $this->AuthLogin();
        Session::put("tenTruyCap", null);
        Session::put('maCongTy', null);
        Session::put('phanQuyen', null);
        Session::put('email', null);
        Session::put('message', null);
        return Redirect::to('/');
    }
}
