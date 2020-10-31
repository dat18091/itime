<?php

namespace App\Http\Controllers\Areas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
session_start();

class AreaController extends Controller
{
    /**
     * 
     */
    public function list_areas() {
        $danhSachVung = DB::table('areas')->get();
        return view('admin.areas.list-areas')->with('list_area', $danhSachVung);
    }

    /**
     * This function is used to redirect to add area page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function add_areas() {
        return view('admin.areas.add-areas');
    }

    /**
     * This function to handle data area by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function save_areas(Request $request) {
        $data = array();
        $tenVung = $request->ten_vung;
        $tuKhoaVung = $request->tu_khoa_vung;
        $trangThaiVung = $request->trang_thai_vung;
        $ghiChuVung = $request->ghi_chu_vung;
        if($tenVung == "" || $tuKhoaVung == "" || $trangThaiVung == "") {
            Session::put("message", "Các trường không được để rỗng.");
            return Redirect::to('/admin/add-areas');
        } else if(strlen($tenVung) > 100) {
            Session::put("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-areas');
        } else if(strlen($tenVung) < 5) {
            Session::put("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-areas');
        } else {
            $data['ten_vung'] = $tenVung;
            $data['tu_khoa_vung'] = $tuKhoaVung;
            $data['trang_thai_vung'] = $trangThaiVung;
            $data['ghi_chu_vung'] = $ghiChuVung;
            $data['created_at'] = Carbon::now();
            DB::table('areas')->insert($data);
            Session::put("message", "Thêm vùng thành công.");
            return Redirect::to('/admin/list-areas');
        }
    }

    /**
     * This function is used to redirect to hide area
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function hide_areas($id) {
        DB::table('areas')->where('id', $id)->update(['trang_thai_vung' => 1]);
        Session::put('message', 'Ẩn vùng thành công.');
        return Redirect::to('/admin/list-areas');
    }

    /**
     * This function is used to redirect to show area
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function show_areas($id) {
        DB::table('areas')->where('id', $id)->update(['trang_thai_vung' => 0]);
        Session::put('message', 'Hiển thị vùng thành công.');
        return Redirect::to('/admin/list-areas');
    }

    /**
     * This function is used is redirect to edit area page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function edit_areas($id) {
        $capNhatVung = DB::table('areas')->where('id', $id)->get();
        return view('admin.areas.edit-areas')->with('areas', $capNhatVung);
    }

    /**
     * This function is used to handle data by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function update_areas(Request $request, $id) {
        $data = array();
        $tenVung = $request->ten_vung;
        $tuKhoaVung = $request->tu_khoa_vung;
        $ghiChuVung = $request->ghi_chu_vung;
        if($tenVung == "" || $tuKhoaVung == "") {
            Session::put("message", "Các trường không được để rỗng.");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else if(strlen($tenVung) > 100) {
            Session::put("message", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else if(strlen($tenVung) < 5) {
            Session::put("message", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else {
            $data['ten_vung'] = $tenVung;
            $data['tu_khoa_vung'] = $tuKhoaVung;
            $data['ghi_chu_vung'] = $ghiChuVung;
            $data['updated_at'] = Carbon::now();
            DB::table('areas')->where('id', $id)->update($data);
            return Redirect::to('/admin/list-areas');
        }
    }

    /**
     * 
     */
    public function delete_areas($id) {
        DB::table('areas')->where('id', $id)->delete();
        return Redirect::to('/admin/list-areas');
    }
}
