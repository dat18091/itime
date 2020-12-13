<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * This function to redirect register page
     * created by : DateNQ
     * created at : 30/10/2020
     */
    public function register() { 
        $getDistricts = DB::table('districts')->get();
        $getProvinces = DB::table('provinces')->get();
        return view("auth.register")->with("getDistricts", $getDistricts)->with("getProvinces", $getProvinces);
    } 

    /**
     * This function to register handle data by post method
     * created by : DateNQ
     * created at : 30/10/2020
     */
    public function sign_up(Request $request) {
        $data = array();

        $name = $request->name;
        $username = $request->username;
        $password = $request->password;
        $type_of_business = $request->type_of_business;
        $email = $request->email;
        $phone = $request->phone;
        $district_id = $request->district_id;
        $province_id = $request->province_id;
        $website = $request->website;
        $establish_date = $request->establish_date;
        $note = $request->note;

        if($name == "" || $username == "" || $password == "" || $email == "" || $website == "" ||
            $phone == "" || $district_id == "" || $province_id == "" || $establish_date == "") {
            Session::flash("message", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if(strlen($name) > 100 || strlen($username) > 100 || strlen($password) > 100 || 
                strlen($email) > 100 || strlen($phone) > 100 || strlen($type_of_business) > 100) {
            Session::flash("message", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if(strlen($name) < 5 || strlen($username) < 5 || strlen($password) < 5 || 
            strlen($email) < 5 || strlen($phone) < 5 || strlen($type_of_business) < 5) {
            Session::flash("message", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if(strpos($password, "OR") === 0 || strpos($password, "or") === 0 || strpos($password, "1=1") === 0 || 
            strpos($password, ";") === 0 || strpos($password, "--") === 0) {
            # === dùng để so sánh giá trị giữa các biến và hằng đúng theo giá trị và kiểu dữ liệu của nó
            Session::flash("message", "Mật khẩu của bạn không hợp lệ.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash("message", "Email của bạn không hợp lệ.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            Session::flash("message", "Website của bạn không hợp lệ.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if(!preg_match('/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', $phone,  $matches ) ) {
            Session::flash("message", "Số điện thoại của bạn không hợp lệ.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if($password == $username) {
            Session::flash('message', "Tên đăng nhập không được trùng với tên truy cập");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if($this->checkEmail($email) > 0) {
            Session::flash('message', "Email này đã tồn tại");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if($this->checkPhone($phone) > 0) {
            Session::flash('message', "Số điện thoại này đã tồn tại");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if($this->checkWebsite($website) > 0) {
            Session::flash('message', "Website này đã tồn tại");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else if($this->checkCompanyName($name)) {
            Session::flash('message', "Tên công ty này đã tồn tại, vui lòng liên hệ với admin.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/register');
        } else {
            $data['name'] = $name;
            $data['username'] = $username;
            $data['password'] = md5($password);
            $data['type_of_business'] = $type_of_business;
            $data['email'] = $email;
            $data['phone'] = $phone;
            $data['province_id'] = $province_id;
            $data['district_id'] = $district_id;
            $data['website'] = $website;
            $data['establish_date'] = date('Y-m-d', strtotime($establish_date));
            $data['note'] = $note;
            $data['roles_id'] = 2;
            $data['created_at'] = Carbon::now();
            Company::insert($data);
            Session::flash('message', 'Bạn đã đăng ký thành công.');
            Session::flash("alert-type", "success");
            return Redirect::to('/login');
        }
    }

    public function checkEmail($email) {
        return Company::where('email', $email)->count();
    }

    public function checkPhone($phone) {
        return Company::where('phone', $phone)->count();
    }

    public function checkWebsite($website) {
        return Company::where('website', $website)->count();
    }

    public function checkCompanyName($name) {
        return Company::where('name', $name)->count();
    }
}
