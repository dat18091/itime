<?php

namespace App\Http\Controllers\Positions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class PositionController extends Controller
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
     * This function to show add positions page by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function add_positions() {
        $this->AuthLogin();
        $trinhDo = DB::table('educationlevels')->orderby('id', 'asc')->get();
        return view('admin.positions.add-positions')->with('trinhDo', $trinhDo);
    }

    /**
     * This function to handle data and save positions by POST method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function save_positions(Request $request) {
        $this->AuthLogin();
        $data = array();
        $tenChucDanh = $request->ten_chuc_danh;
        $tuKhoaChucDanh = $request->tu_khoa_chuc_danh;
        $kinhNghiem = $request->kinh_nghiem;
        $trinhDo = $request->ma_trinh_do;
        $thuTuHienThi = $request->thu_tu_hien_thi;
        $trangThaiChucDanh = $request->trang_thai_chuc_danh;
        $ghiChuChucDanh = $request->ghi_chu_chuc_danh;
        if($tenChucDanh == "" ||$tuKhoaChucDanh =="" || $kinhNghiem =="" || $trinhDo == "" || 
            $trangThaiChucDanh == "") {
            Session::put("message", "Các trường không được để trống.");
            return Redirect::to("/admin/add-positions");
        } else if(strlen($tenChucDanh) > 100) {
            Session::put("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-positions');
        } else if(strlen($tenChucDanh) < 5) {
            Session::put("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-positions');
        } else {
            $data['ten_chuc_danh'] = $tenChucDanh;
            $data['tu_khoa_chuc_danh'] = $tuKhoaChucDanh;
            $data['kinh_nghiem'] = $kinhNghiem;
            $data['ma_trinh_do'] = $trinhDo;
            $data['thu_tu_hien_thi_cd'] = $thuTuHienThi;
            $data['trang_thai_chuc_danh'] = $trangThaiChucDanh;
            $data['ghi_chu_chuc_danh'] = $ghiChuChucDanh;
            $data['created_at'] = Carbon::now();
            DB::table('positions')->insert($data);
            return Redirect::to('/admin/list-positions');
        }
    }

    /**
     * This function to show list data of positions by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function list_positions() {
        $this->AuthLogin();
        $danhSach = DB::table('positions')
        ->join('educationlevels', 'educationlevels.id' , '=', 'positions.id')->get();
        $trinhDo = DB::table('educationlevels')->get();
        return view('admin.positions.list-positions')->with('positions', $danhSach)->with('trinhDo', $trinhDo);
    }

    /**
     * This function to hide a positions by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function hide_positions($id) {
        $this->AuthLogin();
        DB::table('positions')->where('positions.id', $id)->update(['trang_thai_chuc_danh' => 1]);
        Session::put('message', 'Ẩn chức danh thành công.');
        return Redirect::to('/admin/list-positions');
    }

    /**
     * This function to show a positions by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function show_positions($id) {
        $this->AuthLogin();
        DB::table('positions')->where('positions.id', $id)->distinct()->update(['trang_thai_chuc_danh' => 0]);
        Session::put('message', 'Hiển thị chức danh thành công.');
        return Redirect::to('/admin/list-positions');
    }

    /**
     * 
     */
    public function edit_positions($id) {
        $this->AuthLogin();
        $trinhDo = DB::table('educationlevels')->get();
        $chinhSua = DB::table('positions')->where('positions.id', $id)->get(); 
        return view('admin.positions.edit-positions')->with('trinhDo', $trinhDo)->with('chucDanh',$chinhSua);
    }

    /**
     * 
     */
    public function update_positions(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $tenChucDanh = $request->ten_chuc_danh;
        $tuKhoaChucDanh = $request->tu_khoa_chuc_danh;
        $kinhNghiem = $request->kinh_nghiem;
        $trinhDo = $request->ma_trinh_do;
        $thuTuHienThi = $request->thu_tu_hien_thi;
        $trangThaiChucDanh = $request->trang_thai_chuc_danh;
        $ghiChuChucDanh = $request->ghi_chu_chuc_danh;
        if($tenChucDanh == "" ||$tuKhoaChucDanh =="" || $kinhNghiem =="" || $trinhDo == "") {
            Session::put("message", "Các trường không được để trống.");
            return Redirect::to("/admin/edit-positions/".$id);
        } else if(strlen($tenChucDanh) > 100) {
            Session::put("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/edit-positions/'.$id);
        } else if(strlen($tenChucDanh) < 5) {
            Session::put("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/edit-positions/'.$id);
        } else {
            $data['ten_chuc_danh'] = $tenChucDanh;
            $data['tu_khoa_chuc_danh'] = $tuKhoaChucDanh;
            $data['kinh_nghiem'] = $kinhNghiem;
            $data['ma_trinh_do'] = $trinhDo;
            $data['thu_tu_hien_thi_cd'] = $thuTuHienThi;
            $data['ghi_chu_chuc_danh'] = $ghiChuChucDanh;
            $data['updated_at'] = Carbon::now();
            DB::table('positions')->where('id', $id)->update($data);
            return Redirect::to('/admin/list-positions');
        }
    }

    /**
     * 
     */
    public function delete_positions($id) {
        $this->AuthLogin();
        DB::table('positions')->where('id', $id)->delete();
        return Redirect::to('/admin/list-positions');
    }
}
