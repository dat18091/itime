<?php

namespace App\Http\Controllers\EducationLevels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class EducationLevelController extends Controller
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
     * This function show add education level page by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function add_education_levels() {
        $this->AuthLogin();
        return view('admin.educationlevels.add-education-levels');
    }

    /**
     * This function handle data save education level page by POST method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function save_education_levels(Request $request) {
        $this->AuthLogin();
        $data = array();
        $tenTrinhDo = $request->ten_trinh_do;
        $tuKhoaTrinhDo = $request->tu_khoa_trinh_do;
        $trangThaiTrinhDo = $request->trang_thai_trinh_do;
        $ghiChuTrinhDo = $request->ghi_chu_trinh_do;
        if($tenTrinhDo == "" || $tuKhoaTrinhDo == "" || $trangThaiTrinhDo == "") {
            Session::put("message", "Các trường không được để rỗng.");
            return Redirect::to('/admin/add-education-levels');
        } else if(strlen($tenTrinhDo) > 100) {
            Session::put("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-education-levels');
        } else if(strlen($tenTrinhDo) < 5) {
            Session::put("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-education-levels');
        } else {
            $data['ten_trinh_do'] = $tenTrinhDo;
            $data['tu_khoa_trinh_do'] = $tuKhoaTrinhDo;
            $data['trang_thai_trinh_do'] = $trangThaiTrinhDo;
            $data['ghi_chu_trinh_do'] = $ghiChuTrinhDo;
            $data['created_at'] = Carbon::now();
            DB::table('educationlevels')->insert($data);
            Session::put('message', 'Thêm trình độ thành công.');
            return Redirect::to('/admin/list-education-levels');
        }
    }

    /**
     * This function show data education level page by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function list_education_levels() {
        $this->AuthLogin();
        $danhSachTrinhDo = DB::table('educationlevels')->orderBy('id', 'asc')->get();
        return view('admin.educationlevels.list-education-levels')->with('educationlevels', $danhSachTrinhDo);
    }

    /**
     * This function hide education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function hide_education_levels($id) {
        $this->AuthLogin();
        DB::table('educationlevels')->where('id', $id)->update(['trang_thai_trinh_do' => 1]);
        Session::put('message', 'Ẩn trình độ thành công.');
        return Redirect::to('/admin/list-education-levels');
    }

    /**
     * This function show education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function show_education_levels($id) {
        $this->AuthLogin();
        DB::table('educationlevels')->where('id', $id)->update(['trang_thai_trinh_do' => 0]);
        Session::put('message', 'Hiển thị trình độ thành công.');
        return Redirect::to('/admin/list-education-levels');
    }

    /**
     * This function show edit education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function edit_education_levels($id) {
        $this->AuthLogin();
        $chinhSuaTrinhDo = DB::table('educationlevels')->where('id', $id)->get();
        return view('admin.educationlevels.edit-education-levels')->with('educationlevels', $chinhSuaTrinhDo);
    }

    /**
     * This function handle data to update education level by POST method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function update_education_levels(Request $request , $id) {
        $this->AuthLogin();
        $data = array();
        $tenTrinhDo = $request->ten_trinh_do;
        $tuKhoaTrinhDo = $request->tu_khoa_trinh_do;
        $ghiChuTrinhDo = $request->ghi_chu_trinh_do;
        if($tenTrinhDo == "" || $tuKhoaTrinhDo == "") {
            Session::put("message", "Các trường không được để rỗng.");
            return Redirect::to('/admin/add-education-levels');
        } else if(strlen($tenTrinhDo) > 100) {
            Session::put("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-education-levels');
        } else if(strlen($tenTrinhDo) < 5) {
            Session::put("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-education-levels');
        } else {
            $data['ten_trinh_do'] = $tenTrinhDo;
            $data['tu_khoa_trinh_do'] = $tuKhoaTrinhDo;
            $data['ghi_chu_trinh_do'] = $ghiChuTrinhDo;
            $data['updated_at'] = Carbon::now();
            DB::table('educationlevels')->where('id', $id)->update($data);
            Session::put('message', 'Chỉnh sửa trình độ thành công.');
            return Redirect::to('/admin/list-education-levels');
        }
    }

    /**
     * This function delete data education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function delete_education_levels($id) {
        $this->AuthLogin();
        DB::table('educationlevels')->where('id', $id)->delete();
        return Redirect::to('/admin/list-education-levels');
    }
}
