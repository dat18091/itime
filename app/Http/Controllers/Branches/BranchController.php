<?php

namespace App\Http\Controllers\Branches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class BranchController extends Controller
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
     * This function is used to get all branches of company by GET method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function list_branches() {
        $this->AuthLogin();
        $maCongTy = Session::get('branches');
        $danhSach = DB::table('branches')
        ->join('areas', 'areas.id' , '=', 'branches.id')->orderby('branches.created_at', 'DESC')->get();
        $getAreas = DB::table('areas')->get();
        return view('admin.branches.list-branches')->with('chiNhanh', $danhSach)->with('vung', $getAreas);
    }

    /**
     * This function is used to display add branch page by GET method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function add_branches(Request $request) {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');     
        $getAreas = DB::table('areas')->where('trang_thai_vung', '=', '0')->where('ma_cong_ty', $maCongTy)->get();
        $tinhThanh = DB::table('provinces')->get();
        $quanHuyen = DB::table('districts')->get();
        return view('admin.branches.add-branches')->with('vung', $getAreas)->with('tinhThanh', $tinhThanh)->with('quanHuyen', $quanHuyen);
    }

    /**
     * This function is used to handle data branch by POST method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function save_branches(Request $request) {
        $this->AuthLogin();
        $data = array();
        $tenChiNhanh = $request->ten_chi_nhanh;
        $tuKhoaChiNhanh = $request->tu_khoa_chi_nhanh;
        $trangThaiChiNhanh = $request->trang_thai_chi_nhanh;
        $diaChiChiNhanh = $request->dia_chi_chi_nhanh;
        $maVung = $request->ma_vung;
        $tinhThanh = $request->province_id;
        $quanHuyen = $request->district_id;
        $thuTuHienThi = $request->thu_tu_hien_thi_cn;
        $ghiChuChiNhanh = $request->ghi_chu_chi_nhanh;
        $maCongTy = Session::get('maCongTy');
        if($tenChiNhanh == "" || $trangThaiChiNhanh == "" || $diaChiChiNhanh == "" || $maVung == "" ||
            $tinhThanh == "" || $quanHuyen == "") {
            Session::put('message', 'Các trường không được để trống.');
            return Redirect::to('/admin/add-branches');
        } else if(strlen($tenChiNhanh) > 100 || strlen($diaChiChiNhanh) > 200) {
            Session::put('message', 'Bạn đã nhập quá ký tự cho phép.');
            return Redirect::to('/admin/add-branches');
        } else if(strlen($tenChiNhanh) < 5 || strlen($diaChiChiNhanh) < 5) {
            Session::put('message', 'Bạn đã nhập không đủ ký tự.');
            return Redirect::to('/admin/add-branches');
        } else {
            $data['ten_chi_nhanh'] = $tenChiNhanh;
            $data['tu_khoa_chi_nhanh'] = $tuKhoaChiNhanh;
            $data['trang_thai_chi_nhanh'] = $trangThaiChiNhanh;
            $data['dia_chi_chi_nhanh'] = $diaChiChiNhanh;
            $data['ma_vung'] = $maVung;
            $data['province_id'] = $tinhThanh;
            $data['district_id'] = $quanHuyen;
            $data['thu_tu_hien_thi_cn'] = $thuTuHienThi;
            $data['ghi_chu_chi_nhanh'] = $ghiChuChiNhanh;
            $data['ma_cong_ty'] = $maCongTy;
            $data['created_at'] = Carbon::now();
            DB::table('branches')->insert($data);
            Session::put('message', 'Thêm chi nhánh thành công.');
            return Redirect::to('/admin/list-branches');
        }
    }

    /**
     * This function is used to hide this branch by GET method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function hide_branches($id) {
        $this->AuthLogin();
        DB::table('branches')->where('id', $id)->update(['trang_thai_chi_nhanh' => 1]);
        Session::put('message', 'Ẩn chi nhánh thành công.');
        return Redirect::to('/admin/list-branches');
    }

    /**
     * This function is used to show this branch by GET method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function show_branches($id) {
        $this->AuthLogin();
        DB::table('branches')->where('id', $id)->update(['trang_thai_chi_nhanh' => 0]);
        Session::put('message', 'Hiển thị chi nhánh thành công.');
        return Redirect::to('/admin/list-branches');
    }

    /**
     * This function is used to show edit branch page by GET method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function edit_branches($id) {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');     
        $getAreas = DB::table('areas')->where('trang_thai_vung', '=', '0')->where('ma_cong_ty', $maCongTy)->get();
        $tinhThanh = DB::table('provinces')->get();
        $quanHuyen = DB::table('districts')->get();
        $chinhSuaChiNhanh = DB::table('branches')->where('id', $id)->get();
        return view('admin.branches.edit-branches')->with('vung', $getAreas)
        ->with('tinhThanh', $tinhThanh)->with('quanHuyen', $quanHuyen)->with('chiNhanh', $chinhSuaChiNhanh);
    }

    /**
     * This function is used to handle data update branch by POST method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function update_branches(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $tenChiNhanh = $request->ten_chi_nhanh;
        $tuKhoaChiNhanh = $request->tu_khoa_chi_nhanh;
        $diaChiChiNhanh = $request->dia_chi_chi_nhanh;
        $maVung = $request->ma_vung;
        $tinhThanh = $request->province_id;
        $quanHuyen = $request->district_id;
        $thuTuHienThi = $request->thu_tu_hien_thi_cn;
        $ghiChuChiNhanh = $request->ghi_chu_chi_nhanh;
        if($tenChiNhanh == "" || $diaChiChiNhanh == "" || $maVung == "" ||
            $tinhThanh == "" || $quanHuyen == "") {
            Session::put('message', 'Các trường không được để trống.');
            return Redirect::to('/admin/edit-branches/'.$id);
        } else if(strlen($tenChiNhanh) > 100 || strlen($diaChiChiNhanh) > 200) {
            Session::put('message', 'Bạn đã nhập quá ký tự cho phép.');
            return Redirect::to('/admin/edit-branches/'.$id);
        } else if(strlen($tenChiNhanh) < 5 || strlen($diaChiChiNhanh) < 5) {
            Session::put('message', 'Bạn đã nhập không đủ ký tự.');
            return Redirect::to('/admin/edit-branches/'.$id);
        } else {
            $data['ten_chi_nhanh'] = $tenChiNhanh;
            $data['tu_khoa_chi_nhanh'] = $tuKhoaChiNhanh;
            $data['dia_chi_chi_nhanh'] = $diaChiChiNhanh;
            $data['ma_vung'] = $maVung;
            $data['province_id'] = $tinhThanh;
            $data['district_id'] = $quanHuyen;
            $data['thu_tu_hien_thi_cn'] = $thuTuHienThi;
            $data['ghi_chu_chi_nhanh'] = $ghiChuChiNhanh;
            $data['updated_at'] = Carbon::now();
            DB::table('branches')->where('id', $id)->update($data);
            Session::put('message', 'Thêm chi nhánh thành công.');
            return Redirect::to('/admin/list-branches');
        }
    }

    /**
     * This function is used to delete data from branch by GET method 
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function delete_branches($id) {
        $this->AuthLogin();
        DB::table('branches')->where('id', $id)->delete();
        Session::put('message', 'Xóa chi nhánh thành công.');
        return Redirect::to('/admin/list-branches');
    }
}
