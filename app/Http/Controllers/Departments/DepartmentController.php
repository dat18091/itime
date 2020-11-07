<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DepartmentController extends Controller
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
     * This function is used to get all data from department database by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function list_departments() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = DB::table('departments')->where('ma_cong_ty', $maCongTy)->get();
        return view('admin.departments.list-departments')->with('phongBan', $danhSach);
    }
    
    /**
     * This function is used to get all data from department database by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function add_departments() {
        $this->AuthLogin();
        return view('admin.departments.add-departments');
    }

    /**
     * This function is used to save data from department database by POST method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function save_departments(Request $request) {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $data = array();
        $tenPhongBan = $request->ten_phong_ban;
        $tuKhoaPhongBan = $request->tu_khoa_phong_ban;
        $trangThaiPhongBan = $request->trang_thai_phong_ban;
        $thuTuHienThi = $request->thu_tu_hien_thi_pb;
        $phongBanDungDau = $request->phong_ban_dung_dau;
        $ghiChuPhongBan = $request->ghi_chu_phong_ban;
        if($tenPhongBan == "" || $trangThaiPhongBan == "" || $phongBanDungDau == "") {
            Session::push("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($tenPhongBan) > 100) {
            Session::push("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($tenPhongBan) < 5) {
            Session::push("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-departments');
        } else {
            $data["ten_phong_ban"] = $tenPhongBan;
            $data["tu_khoa_phong_ban"] = $tuKhoaPhongBan;
            $data["trang_thai_phong_ban"] = $trangThaiPhongBan;
            $data["thu_tu_hien_thi_pb"] = $thuTuHienThi;
            $data["phong_ban_dung_dau"] = $phongBanDungDau;
            $data["ghi_chu_phong_ban"] = $ghiChuPhongBan;
            $data["ma_cong_ty"] = $maCongTy;
            $data["created_at"] = Carbon::now();
            Session::push('message', 'Thêm phòng ban thành công.');
            DB::table('departments')->insert($data);
            return Redirect::to('/admin/list-departments'); 
        }
    }

    /**
     * 
     */
    public function hide_departments($id) {
        $this->AuthLogin();
        DB::table('departments')->where('ma_phong_ban', $id)->update(['trang_thai_phong_ban' => 1]);
        Session::push('message', 'Ẩn phòng ban thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * 
     */
    public function show_departments($id) {
        $this->AuthLogin();
        DB::table('departments')->where('ma_phong_ban', $id)->update(['trang_thai_phong_ban' => 0]);
        Session::push('message', 'Hiển thị phòng ban thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * 
     */
    public function second_departments($id) {
        $this->AuthLogin();
        DB::table('departments')->where('ma_phong_ban', $id)->update(['phong_ban_dung_dau' => 1]);
        Session::push('message', 'Tắt hiển thị phòng ban đứng đầu thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * 
     */
    public function first_departments($id) {
        $this->AuthLogin();
        DB::table('departments')->where('ma_phong_ban', $id)->update(['phong_ban_dung_dau' => 0]);
        Session::push('message', 'Hiển thị phòng ban đứng đầu thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * 
     */
    public function edit_departments($id) {
        $this->AuthLogin();
        $chinhSua = DB::table('departments')->where('ma_phong_ban', $id)->get();
        return view('admin.departments.edit-departments')->with('phongBan', $chinhSua);
    }

    /**
     * 
     */
    public function update_departments(Request $request, $id) {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $data = array();
        $tenPhongBan = $request->ten_phong_ban;
        $tuKhoaPhongBan = $request->tu_khoa_phong_ban;
        $thuTuHienThi = $request->thu_tu_hien_thi_pb;
        $ghiChuPhongBan = $request->ghi_chu_phong_ban;
        // dd($phongBanDungDau);
        if($tenPhongBan == "") {
            Session::push("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($tenPhongBan) > 100) {
            Session::push("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($tenPhongBan) < 5) {
            Session::push("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-departments');
        } else {
            $data["ten_phong_ban"] = $tenPhongBan;
            $data["tu_khoa_phong_ban"] = $tuKhoaPhongBan;
            $data["thu_tu_hien_thi_pb"] = $thuTuHienThi;
            $data["ghi_chu_phong_ban"] = $ghiChuPhongBan;
            // $data["ma_cong_ty"] = $maCongTy;
            $data["updated_at"] = Carbon::now();
            DB::table('departments')->where('ma_phong_ban', $id)->update($data);
            Session::push('message', 'Cập nhật phòng ban thành công.');
            return Redirect::to('/admin/list-departments'); 
        }
    }

    /**
     * 
     * 
     */
    public function delete_departments($id) {
        $this->AuthLogin();
        DB::table('departments')->where('ma_phong_ban', $id)->delete();
        Session::push('message', 'Xóa phòng ban thành công.');
        return Redirect::to('/admin/list-departments');
    }
}
