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
     * This function to show add positions page by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function add_positions() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $trinhDo = DB::table('educationlevels')
        ->where('trang_thai_trinh_do', '=', '0')
        ->where('ma_cong_ty',$idCompany)->orderby('ma_trinh_do', 'asc')->get();
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
        $maCongTy = Session::get('maCongTy');
        if($tenChucDanh == "" ||$tuKhoaChucDanh =="" || $kinhNghiem =="" || $trinhDo == "" || 
            $trangThaiChucDanh == "") {
            Session::push("failure", "Các trường không được để trống.");
            return Redirect::to("/admin/add-positions");
        } else if(strlen($tenChucDanh) > 100) {
            Session::push("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-positions');
        } else if(strlen($tenChucDanh) < 5) {
            Session::push("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-positions');
        } else {
            $data['ten_chuc_danh'] = $tenChucDanh;
            $data['tu_khoa_chuc_danh'] = $tuKhoaChucDanh;
            $data['kinh_nghiem'] = $kinhNghiem;
            $data['ma_trinh_do'] = $trinhDo;
            $data['thu_tu_hien_thi_cd'] = $thuTuHienThi;
            $data['trang_thai_chuc_danh'] = $trangThaiChucDanh;
            $data['ghi_chu_chuc_danh'] = $ghiChuChucDanh;
            $data['ma_cong_ty'] = $maCongTy;
            $data['created_at'] = Carbon::now();
            DB::table('positions')->insert($data);
            Session::push('message', 'Thêm chức danh thành công.');
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
        $maCongTy = Session::get('maCongTy');
        $danhSach = DB::table('positions')
        ->join('educationlevels', 'educationlevels.ma_trinh_do' , '=', 'positions.ma_trinh_do')
        ->where('positions.trang_thai_chuc_danh', '1')
        ->orWhere('positions.trang_thai_chuc_danh', '0')
        ->where('positions.ma_cong_ty', $maCongTy)->get();
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
        DB::table('positions')->where('positions.ma_chuc_danh', $id)->update(['trang_thai_chuc_danh' => 1]);
        Session::push('message', 'Ẩn chức danh thành công.');
        return Redirect::to('/admin/list-positions');
    }

    /**
     * This function to show a positions by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function show_positions($id) {
        $this->AuthLogin();
        DB::table('positions')->where('positions.ma_chuc_danh', $id)->distinct()->update(['trang_thai_chuc_danh' => 0]);
        Session::push('message', 'Hiển thị chức danh thành công.');
        return Redirect::to('/admin/list-positions');
    }

    /**
     * This function to show edit-positions page by GET method
     * created by : DatNQ
     * created at : 03/11/2020
     */
    public function edit_positions($id) {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $trinhDo = DB::table('educationlevels')->where('ma_cong_ty',$maCongTy)->get();
        $chinhSua = DB::table('positions')->where('ma_cong_ty',$maCongTy)->where('positions.ma_chuc_danh', $id)->get(); 
        return view('admin.positions.edit-positions')->with('trinhDo', $trinhDo)->with('chucDanh',$chinhSua);
    }

    /**
     * This function to handle data positions page by POST method
     * created by : DatNQ
     * created at : 03/11/2020
     */
    public function update_positions(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $tenChucDanh = $request->ten_chuc_danh;
        $tuKhoaChucDanh = $request->tu_khoa_chuc_danh;
        $kinhNghiem = $request->kinh_nghiem;
        $trinhDo = $request->ma_trinh_do;
        $thuTuHienThi = $request->thu_tu_hien_thi;
        // $trangThaiChucDanh = $request->trang_thai_chuc_danh;
        $ghiChuChucDanh = $request->ghi_chu_chuc_danh;
        if($tenChucDanh == "" ||$tuKhoaChucDanh =="" || $kinhNghiem =="" || $trinhDo == "") {
            Session::push("message", "Các trường không được để trống.");
            return Redirect::to("/admin/edit-positions/".$id);
        } else if(strlen($tenChucDanh) > 100) {
            Session::push("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/edit-positions/'.$id);
        } else if(strlen($tenChucDanh) < 5) {
            Session::push("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/edit-positions/'.$id);
        } else {
            $data['ten_chuc_danh'] = $tenChucDanh;
            $data['tu_khoa_chuc_danh'] = $tuKhoaChucDanh;
            $data['kinh_nghiem'] = $kinhNghiem;
            $data['ma_trinh_do'] = $trinhDo;
            $data['thu_tu_hien_thi_cd'] = $thuTuHienThi;
            $data['ghi_chu_chuc_danh'] = $ghiChuChucDanh;
            $data['updated_at'] = Carbon::now();
            DB::table('positions')->where('ma_chuc_danh', $id)->update($data);
            Session::push('message', 'Chỉnh sửa chức danh thành công.');
            return Redirect::to('/admin/list-positions');
        }
    }

    /**
     * This function to delete data positions page by GET method
     * created by : DatNQ
     * created at : 03/11/2020
     */
    public function delete_positions($id) {
        $this->AuthLogin();
        DB::table('positions')->where('ma_chuc_danh', $id)->delete();
        Session::push('message', 'Xóa chức danh thành công.');
        return Redirect::to('/admin/list-positions');
    }

    /**
     * This function to get data from trash positions by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function list_positions_trash() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = DB::table('positions')
        ->join('educationlevels', 'educationlevels.ma_trinh_do' , '=', 'positions.ma_trinh_do')
        ->where('positions.trang_thai_chuc_danh', '2')
        ->where('positions.ma_cong_ty', $maCongTy)->get();
        $trinhDo = DB::table('educationlevels')->get();
        return view('admin.positions.list-positions-trash')->with('positions', $danhSach)->with('trinhDo', $trinhDo);
    }

    public function trash_positions($id) {
        $this->AuthLogin();
        DB::table('positions')->where('positions.ma_chuc_danh', $id)->update(['trang_thai_chuc_danh' => 2]);
        Session::push('message', 'Xóa chức danh thành công.');
        return Redirect::to('/admin/list-positions');
    }

    public function restore_positions($id) {
        $this->AuthLogin();
        DB::table('positions')->where('positions.ma_chuc_danh', $id)->update(['trang_thai_chuc_danh' => 0]);
        Session::push('message', 'Khôi phục chức danh thành công.');
        return Redirect::to('/admin/list-positions');
    }
}
