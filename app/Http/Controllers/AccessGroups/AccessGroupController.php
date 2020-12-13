<?php

namespace App\Http\Controllers\AccessGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Accessgroup;

class AccessGroupController extends Controller
{
    /**
     * This function to check accesses from outside
     * created by : DatNQ
     * created at : 05/11/2020
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
     * This function is used to get list accessgroups by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function list_access_groups() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = Accessgroup::where('trang_thai_nhom_truy_cap', '1')
        ->orWhere('trang_thai_nhom_truy_cap', '0')
        ->where('ma_cong_ty', $maCongTy)->get();
        return view('admin.accessgroups.list-access-groups')->with('nhomTruyCap', $danhSach);
    }

    /**
     * This function is used to show add accessgroups page by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function add_access_groups() {
        $this->AuthLogin();
        return view('admin.accessgroups.add-access-groups');
    }

    /**
     * This function is used to save data accessgroups by POST method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function save_access_groups(Request $request) {
        $this->AuthLogin();
        $data = array();
        $tenNhomTruyCap = $request->ten_nhom_truy_cap;
        $tuKhoaNhomTruyCap = $request->tu_khoa_nhom_truy_cap;
        $trangThaiNhomTruyCap = $request->trang_thai_nhom_truy_cap;
        $ghiChuNhomTruyCap = $request->ghi_chu_nhom_truy_cap;
        $maCongTy = Session::get('maCongTy');
        if($tenNhomTruyCap == "" || $tuKhoaNhomTruyCap == "" || $trangThaiNhomTruyCap == "") {
            Session::flash("failure", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-access-groups');
        } else if(strlen($tenNhomTruyCap) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-access-groups');
        } else if(strlen($tenNhomTruyCap) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-access-groups');
        } else {
            $data['ten_nhom_truy_cap'] = $tenNhomTruyCap;
            $data['tu_khoa_nhom_truy_cap'] = $tuKhoaNhomTruyCap;
            $data['trang_thai_nhom_truy_cap'] = $trangThaiNhomTruyCap;
            $data['ghi_chu_nhom_truy_cap'] = $ghiChuNhomTruyCap;
            $data['ma_cong_ty'] = $maCongTy;
            $data['created_at'] = Carbon::now();
            Accessgroup::insert($data);
            Session::flash("message", "Thêm nhóm truy cập thành công.");
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-access-groups');
        }
    }

    /**
     * This function is used to hide data accessgroups by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function hide_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->update(['trang_thai_nhom_truy_cap' => 1]);
        Session::flash('message', 'Ẩn nhóm truy cập thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-access-groups');
    }

    /**
     * This function is used to show data accessgroups by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function show_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->update(['trang_thai_nhom_truy_cap' => 0]);
        Session::flash('message', 'Ẩn nhóm truy cập thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-access-groups');
    }

    /**
     * This function is used to show edit accessgroups page by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function edit_access_groups($id) {
        $this->AuthLogin();
        $chinhSua = Accessgroup::where('ma_nhom_truy_cap', $id)->get();
        return view('admin.accessgroups.edit-access-groups')->with('nhomTruyCap', $chinhSua);
    }

    /**
     * This function is used to update data accessgroups by POST method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function update_access_groups(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $tenNhomTruyCap = $request->ten_nhom_truy_cap;
        $tuKhoaNhomTruyCap = $request->tu_khoa_nhom_truy_cap;
        $ghiChuNhomTruyCap = $request->ghi_chu_nhom_truy_cap;
        $maCongTy = Session::get('maCongTy');
        if($tenNhomTruyCap == "" || $tuKhoaNhomTruyCap == "") {
            Session::flash("failure", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else if(strlen($tenNhomTruyCap) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else if(strlen($tenNhomTruyCap) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else {
            $data['ten_nhom_truy_cap'] = $tenNhomTruyCap;
            $data['tu_khoa_nhom_truy_cap'] = $tuKhoaNhomTruyCap;
            $data['ghi_chu_nhom_truy_cap'] = $ghiChuNhomTruyCap;
            $data['ma_cong_ty'] = $maCongTy;
            $data['updated_at'] = Carbon::now();
            Accessgroup::where('ma_nhom_truy_cap', $id)->update($data);
            Session::flash("message", "Chỉnh sửa nhóm truy cập thành công.");
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-access-groups');
        }
    }

    /**
     * This function is used to delete data accessgroups by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function delete_access_groups($id) {
        $this->AuthLogin();
        Accessgroup::where('ma_nhom_truy_cap', $id)->delete();
        Session::flash('message', 'Xóa nhóm truy cập thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-access-groups');
    }

    /**
     * This function is used to get list trash accessgroups by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function list_access_groups_trash() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = Accessgroup::where('trang_thai_nhom_truy_cap', '2')
        ->where('ma_cong_ty', $maCongTy)->get();
        return view('admin.accessgroups.list-access-groups-trash')->with('nhomTruyCap', $danhSach);
    }

    public function trash_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->update(['trang_thai_nhom_truy_cap' => 2]);
        Session::flash('message', 'Xóa nhóm truy cập thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-access-groups');
    }

    public function restore_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->update(['trang_thai_nhom_truy_cap' => 0]);
        Session::flash('message', 'Hiển thị nhóm truy cập thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-access-groups');
    }
}
