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
        $quanHuyen = DB::table('district')->get();
        $tinhThanh = DB::table('province')->get();
        return view("auth.register")->with("quanhuyen", $quanHuyen)->with("tinhthanh", $tinhThanh);
        #with(key, value)
    } 

    /**
     * This function to register handle data by post method
     * created by : DateNQ
     * created at : 30/10/2020
     */
    public function sign_up(Request $request) {
        #tao mang de luu tat ca cac phan tu
        $data = array();
        #lay request tren web tao ra bien de map vao
        $tenCongTy = $request->ten_cong_ty;
        $tenTruyCap = $request->ten_truy_cap;
        $matKhau = $request->mat_khau;
        $loaiHinhDoanhNghiep = $request->loai_hinh_doanh_nghiep;
        $emailCongTy = $request->email_cong_ty;
        $soDienThoaiCongTy = $request->so_dien_thoai_cong_ty;
        $quanHuyen = $request->district_id;
        $tinhThanh = $request->province_id;
        $websiteCongTy = $request->website_cong_ty;
        $ngayThanhLap = $request->ngay_thanh_lap;
        $ghiChuCongTy = $request->ghi_chu_cong_ty;
        #dieu kien validate
        if($tenCongTy == "" || $tenTruyCap == "" || $matKhau == "" || $emailCongTy == "" ||
            $soDienThoaiCongTy == "" || $quanHuyen == "" || $tinhThanh == "" || $ngayThanhLap == "") {
            Session::put("message", "Các trường không được để rỗng.");
            return Redirect::to('/register');
        } else if(strlen($tenCongTy) > 100 || strlen($tenTruyCap) > 100 || strlen($matKhau) > 100 || 
                strlen($emailCongTy) > 100 || strlen($soDienThoaiCongTy) > 100 || strlen($loaiHinhDoanhNghiep) > 100) {
            Session::put("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/register');
        } else if(strlen($tenCongTy) < 5 || strlen($tenTruyCap) < 5 || strlen($matKhau) < 5 || 
            strlen($emailCongTy) < 5 || strlen($soDienThoaiCongTy) < 5 || strlen($loaiHinhDoanhNghiep) < 5) {
            Session::put("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/register');
        } else if(strpos($matKhau, "OR") === 0 || strpos($matKhau, "or") === 0 || strpos($matKhau, "1=1") === 0 || 
            strpos($matKhau, ";") === 0 || strpos($matKhau, "--") === 0) {
            # === dùng để so sánh giá trị giữa các biến và hằng đúng theo giá trị và kiểu dữ liệu của nó
            Session::put("message", "Mật khẩu của bạn chứa ký tự nguy hiểm.");
            return Redirect::to('/register');
        } else if (!filter_var($emailCongTy, FILTER_VALIDATE_EMAIL)) {
            Session::put("message", "Email của bạn không hợp lệ.");
            return Redirect::to('/register');
        } else if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$websiteCongTy)) {
            Session::put("message", "Website của bạn không hợp lệ.");
            return Redirect::to('/register');
        } else if(!preg_match('/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', $soDienThoaiCongTy,  $matches ) ) {
            Session::put("message", "Số điện thoại của bạn không hợp lệ.");
            return Redirect::to('/register');
        } else {
            $data['ten_cong_ty'] = $tenCongTy;
            $data['ten_truy_cap'] = $tenTruyCap;
            $data['mat_khau'] = md5($matKhau);
            $data['loai_hinh_doanh_nghiep'] = $loaiHinhDoanhNghiep;
            $data['email_cong_ty'] = $emailCongTy;
            $data['so_dien_thoai_cong_ty'] = $soDienThoaiCongTy;
            $data['province_id'] = $tinhThanh;
            $data['district_id'] = $quanHuyen;
            $data['website_cong_ty'] = $websiteCongTy;
            $data['ngay_thanh_lap'] = date('Y-m-d', strtotime($ngayThanhLap));
            $data['ghi_chu_cong_ty'] = $ghiChuCongTy;
            $data['roles_id'] = 2;
            $data['created_at'] = Carbon::now();
            DB::table('companies')->insert($data);
            Session::put('message', 'Bạn đã đăng ký thành công.');
            return Redirect::to('/login');
        }
    }
}
