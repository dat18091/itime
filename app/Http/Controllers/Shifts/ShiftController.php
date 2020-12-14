<?php

namespace App\Http\Controllers\Shifts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Shift;

class ShiftController extends Controller
{
    /**
     * This function to check accesses from outside
     * created by : DatNQ
     * created at : 24/11/2020
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
     * This function is used to get list shift by GET method
     * created by : DatNQ
     * created at : 24/11/2020
     */
    public function list_shifts() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = Shift::where('trang_thai_ca_lam', '1')
        ->orWhere('trang_thai_ca_lam', '0')
        ->where('ma_cong_ty', $maCongTy)->get();
        return view('admin.shifts.list-shifts')->with('caLam', $danhSach);
    }

    /**
     * This function is used to show add shift page by GET method
     * created by : DatNQ
     * created at : 24/11/2020
     */
    public function add_shifts() {
        $this->AuthLogin();
        return view('admin.shifts.add-shifts');
    }

    /**
     * This function is used to save data shift by POST method
     * created by : DatNQ
     * created at : 24/11/2020
     */
    public function save_shifts(Request $request) {
        $this->AuthLogin();
        $data = array();
        $tenCaLam = $request->ten_ca_lam;
        $tuKhoaCaLam = $request->tu_khoa_ca_lam;
        $trangThaiCaLam = $request->trang_thai_ca_lam;
        $ghiChuCaLam = $request->ghi_chu_ca_lam;
        $maCongTy = Session::get('maCongTy');
        if($tenCaLam == "" || $tuKhoaCaLam == "" || $trangThaiCaLam == "") {
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/add-shifts');
        } else if(strlen($tenCaLam) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-shifts');
        } else if(strlen($tenCaLam) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-shifts');
        } else {
            $data['ten_ca_lam'] = $tenCaLam;
            $data['tu_khoa_ca_lam'] = $tuKhoaCaLam;
            $data['trang_thai_ca_lam'] = $trangThaiCaLam;
            $data['ghi_chu_ca_lam'] = $ghiChuCaLam;
            $data['ma_cong_ty'] = $maCongTy;
            $data['created_at'] = Carbon::now();
            Shift::insert($data);
            Session::flash("message", "Thêm ca làm thành công.");
            return Redirect::to('/admin/list-shifts');
        }
    }

    /**
     * This function is used to hide data shift by GET method
     * created by : DatNQ
     * created at : 24/11/2020
     */
    public function hide_shifts($id) {
        $this->AuthLogin();
        Shift::where('ma_ca_lam', $id)->update(['trang_thai_ca_lam' => 1]);
        Session::flash('message', 'Ẩn ca làm thành công.');
        return Redirect::to('/admin/list-shifts');
    }

    /**
     * This function is used to show data shift by GET method
     * created by : DatNQ
     * created at : 24/11/2020
     */
    public function show_shifts($id) {
        $this->AuthLogin();
        Shift::where('ma_ca_lam', $id)->update(['trang_thai_ca_lam' => 0]);
        Session::flash('message', 'Ẩn ca làm thành công.');
        return Redirect::to('/admin/list-shifts');
    }

    /**
     * This function is used to show edit shift page by GET method
     * created by : DatNQ
     * created at : 24/11/2020
     */
    public function edit_shifts($id) {
        $this->AuthLogin();
        $chinhSua = Shift::where('ma_ca_lam', $id)->get();
        return view('admin.shifts.edit-shifts')->with('caLam', $chinhSua);
    }

    /**
     * This function is used to update data shift by POST method
     * created by : DatNQ
     * created at : 24/11/2020
     */
    public function update_shifts(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $tenCaLam = $request->ten_ca_lam;
        $tuKhoaCaLam = $request->tu_khoa_ca_lam;
        $ghiChuCaLam = $request->ghi_chu_ca_lam;
        $maCongTy = Session::get('maCongTy');
        if($tenCaLam == "" || $tuKhoaCaLam == "") {
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/edit-shifts/'.$id);
        } else if(strlen($tenCaLam) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/edit-shifts/'.$id);
        } else if(strlen($tenCaLam) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/edit-shifts/'.$id);
        } else {
            $data['ten_ca_lam'] = $tenCaLam;
            $data['tu_khoa_ca_lam'] = $tuKhoaCaLam;
            $data['ghi_chu_ca_lam'] = $ghiChuCaLam;
            $data['ma_cong_ty'] = $maCongTy;
            $data['updated_at'] = Carbon::now();
            Shift::where('ma_ca_lam', $id)->update($data);
            Session::flash("message", "Chỉnh sửa ca làm thành công.");
            return Redirect::to('/admin/list-shifts');
        }
    }

    /**
     * This function is used to delete data shift by GET method
     * created by : DatNQ
     * created at : 24/11/2020
     */
    public function delete_shifts($id) {
        $this->AuthLogin();
        Shift::where('ma_ca_lam', $id)->delete();
        Session::flash('message', 'Xóa ca làm thành công.');
        return Redirect::to('/admin/list-shifts');
    }

    /**
     * This function is used to get list trash shift by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function list_shifts_trash() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = Shift::where('trang_thai_ca_lam', '2')
        ->where('ma_cong_ty', $maCongTy)->get();
        return view('admin.shifts.list-shifts-trash')->with('caLam', $danhSach);
    }

    public function trash_shifts($id) {
        $this->AuthLogin();
        Shift::where('ma_ca_lam', $id)->update(['trang_thai_ca_lam' => 2]);
        Session::flash('message', 'Xóa ca làm thành công.');
        return Redirect::to('/admin/list-shifts');
    }

    public function restore_shifts($id) {
        $this->AuthLogin();
        Shift::where('ma_ca_lam', $id)->update(['trang_thai_ca_lam' => 0]);
        Session::flash('message', 'Hiển thị ca làm thành công.');
        return Redirect::to('/admin/list-shifts');
    }
}
