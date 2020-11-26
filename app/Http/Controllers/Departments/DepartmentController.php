<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Department;

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
        $danhSach = Department::where('trang_thai_phong_ban', '1')
        ->orWhere('trang_thai_phong_ban', '0')
        ->where('ma_cong_ty', $maCongTy)->get();
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
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($tenPhongBan) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($tenPhongBan) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
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
            Session::flash('message', 'Thêm phòng ban thành công.');
            Department::insert($data);
            return Redirect::to('/admin/list-departments'); 
        }
    }

    /**
     * This function is used to hide data from department by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function hide_departments($id) {
        $this->AuthLogin();
        Department::where('ma_phong_ban', $id)->update(['trang_thai_phong_ban' => 1]);
        Session::flash('message', 'Ẩn phòng ban thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to show data from department by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function show_departments($id) {
        $this->AuthLogin();
        Department::where('ma_phong_ban', $id)->update(['trang_thai_phong_ban' => 0]);
        Session::flash('message', 'Hiển thị phòng ban thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to hide head department data from department by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function second_departments($id) {
        $this->AuthLogin();
        Department::where('ma_phong_ban', $id)->update(['phong_ban_dung_dau' => 1]);
        Session::flash('message', 'Tắt hiển thị phòng ban đứng đầu thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to show head department data from department by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function first_departments($id) {
        $this->AuthLogin();
        Department::where('ma_phong_ban', $id)->update(['phong_ban_dung_dau' => 0]);
        Session::flash('message', 'Hiển thị phòng ban đứng đầu thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to show edit department page by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function edit_departments($id) {
        $this->AuthLogin();
        $chinhSua = Department::where('ma_phong_ban', $id)->get();
        return view('admin.departments.edit-departments')->with('phongBan', $chinhSua);
    }

    /**
     * This function is used to update data from department database by POST method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function update_departments(Request $request, $id) {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $data = array();
        $tenPhongBan = $request->ten_phong_ban;
        $tuKhoaPhongBan = $request->tu_khoa_phong_ban;
        $thuTuHienThi = $request->thu_tu_hien_thi_pb;
        $ghiChuPhongBan = $request->ghi_chu_phong_ban;
        if($tenPhongBan == "") {
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($tenPhongBan) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($tenPhongBan) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-departments');
        } else {
            $data["ten_phong_ban"] = $tenPhongBan;
            $data["tu_khoa_phong_ban"] = $tuKhoaPhongBan;
            $data["thu_tu_hien_thi_pb"] = $thuTuHienThi;
            $data["ghi_chu_phong_ban"] = $ghiChuPhongBan;
            $data["updated_at"] = Carbon::now();
            Department::where('ma_phong_ban', $id)->update($data);
            Session::flash('message', 'Cập nhật phòng ban thành công.');
            return Redirect::to('/admin/list-departments'); 
        }
    }

    /**
     * This function is used to delete data from department database by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function delete_departments($id) {
        $this->AuthLogin();
        Department::where('ma_phong_ban', $id)->delete();
        Session::flash('message', 'Xóa phòng ban thành công.');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to show list department by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function list_departments_trash() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = Department::where('trang_thai_phong_ban', '2')
        ->where('ma_cong_ty', $maCongTy)->get();
        return view('admin.departments.list-departments-trash')->with('phongBan', $danhSach);
    }

    /**
     * This function is used to move data department trash by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function trash_departments($id) {
        $this->AuthLogin();
        Department::where('ma_phong_ban', $id)->update(['trang_thai_phong_ban' => 2]);
        Session::flash('message', 'Hiển thị phòng ban thành công');
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to restore data department trash by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function restore_departments($id) {
        $this->AuthLogin();
        Department::where('ma_phong_ban', $id)->update(['trang_thai_phong_ban' => 0]);
        Session::flash('message', 'Hiển thị phòng ban thành công');
        return Redirect::to('/admin/list-departments');
    }
}
