<?php

namespace App\Http\Controllers\AccessGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

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
     * 
     */
    public function list_access_groups() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = DB::table('accessgroups')->where('ma_cong_ty', $maCongTy)->get();
        return view('admin.accessgroups.list-access-groups')->with('nhomTruyCap', $danhSach);
    }

    /**
     * 
     */
    public function add_access_groups() {
        $this->AuthLogin();
        return view('admin.accessgroups.add-access-groups');
    }

    /**
     * 
     */
    public function save_access_groups(Request $request) {
        $this->AuthLogin();
        $data = array();
        $tenNhomTruyCap = $request->ten_nhom_truy_cap;
        $tuKhoaNhomTruyCap = $request->tu_khoa_nhom_truy_cap;
        $trangThaiNhomTruyCap = $request->trang_thai_nhom_truy_cap;
        $ghiChuNhomTruyCap = $request->ghi_chu_nhom_truy_cap;
        $maCongTy = Session::get('maCongTy');
        // dd($ghiChuNhomTruyCap);
        if($tenNhomTruyCap == "" || $tuKhoaNhomTruyCap == "" || $trangThaiNhomTruyCap == "") {
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/add-access-groups');
        } else if(strlen($tenNhomTruyCap) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-access-groups');
        } else if(strlen($tenNhomTruyCap) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-access-groups');
        } else {
            $data['ten_nhom_truy_cap'] = $tenNhomTruyCap;
            $data['tu_khoa_nhom_truy_cap'] = $tuKhoaNhomTruyCap;
            $data['trang_thai_nhom_truy_cap'] = $trangThaiNhomTruyCap;
            $data['ghi_chu_nhom_truy_cap'] = $ghiChuNhomTruyCap;
            $data['ma_cong_ty'] = $maCongTy;
            $data['created_at'] = Carbon::now();
            DB::table('accessgroups')->insert($data);
            Session::flash("message", "Thêm nhóm truy cập thành công.");
            return Redirect::to('/admin/list-access-groups');
        }
    }

    /**
     * 
     */
    public function hide_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->update(['trang_thai_nhom_truy_cap' => 1]);
        Session::flash('message', 'Ẩn nhóm truy cập thành công.');
        return Redirect::to('/admin/list-access-groups');
    }

    /**
     * 
     */
    public function show_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->update(['trang_thai_nhom_truy_cap' => 0]);
        Session::flash('message', 'Ẩn nhóm truy cập thành công.');
        return Redirect::to('/admin/list-access-groups');
    }

    /**
     * 
     */
    public function edit_access_groups($id) {
        $this->AuthLogin();
        $chinhSua = DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->get();
        return view('admin.accessgroups.edit-access-groups')->with('nhomTruyCap', $chinhSua);
    }

    /**
     * 
     */
    public function update_access_groups(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $tenNhomTruyCap = $request->ten_nhom_truy_cap;
        $tuKhoaNhomTruyCap = $request->tu_khoa_nhom_truy_cap;
        $ghiChuNhomTruyCap = $request->ghi_chu_nhom_truy_cap;
        $maCongTy = Session::get('maCongTy');
        // dd($ghiChuNhomTruyCap);
        if($tenNhomTruyCap == "" || $tuKhoaNhomTruyCap == "") {
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else if(strlen($tenNhomTruyCap) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else if(strlen($tenNhomTruyCap) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else {
            $data['ten_nhom_truy_cap'] = $tenNhomTruyCap;
            $data['tu_khoa_nhom_truy_cap'] = $tuKhoaNhomTruyCap;
            $data['ghi_chu_nhom_truy_cap'] = $ghiChuNhomTruyCap;
            $data['ma_cong_ty'] = $maCongTy;
            $data['updated_at'] = Carbon::now();
            DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->update($data);
            Session::flash("message", "Chỉnh sửa nhóm truy cập thành công.");
            return Redirect::to('/admin/list-access-groups');
        }
    }

    /**
     * 
     */
    public function delete_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('ma_nhom_truy_cap', $id)->delete();
        Session::flash('message', 'Xóa nhóm truy cập thành công.');
        return Redirect::to('/admin/list-access-groups');
    }
}
