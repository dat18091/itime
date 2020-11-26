<?php

namespace App\Http\Controllers\Areas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Area;

class AreaController extends Controller
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
     * This function to show list areas with company id by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function list_areas() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $danhSachVung = DB::table('areas')->where('trang_thai_vung', '1')
        ->orWhere('trang_thai_vung', '0')
        ->where('ma_cong_ty',$idCompany)->get();
        $areaCountOnl = Area::where('trang_thai_vung', '2')->count();
        return view('admin.areas.list-areas')
        ->with('list_area', $danhSachVung)->with('areaCountOnl', $areaCountOnl);
    }

    /**
     * This function to show list trash areas with company id by GET method
     * created by : DatNQ
     * created at : 20/11/2020
     */
    public function list_areas_trash() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $danhSachVung = DB::table('areas')->where('trang_thai_vung', '2')
        ->where('ma_cong_ty',$idCompany)->get();
        $areaCount = Area::where('trang_thai_vung', '2')->count("*");
        $areaCountAllOnl = Area::where('trang_thai_vung', '0')
        ->orWhere('trang_thai_vung', '1')->count("*");
        return view('admin.areas.list-areas-trash')->with('list_area', $danhSachVung)
        ->with('areaCountAllOnl', $areaCountAllOnl)->with('areaCount', $areaCount);
    }

    /**
     * This function is used to redirect to add area page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function add_areas() {
        $this->AuthLogin();
        return view('admin.areas.add-areas');
    }

    /**
     * This function to handle data area by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function save_areas(Request $request) {
        $this->AuthLogin();
        $data = array();
        $tenVung = $request->ten_vung;
        $tuKhoaVung = $request->tu_khoa_vung;
        $trangThaiVung = $request->trang_thai_vung;
        $ghiChuVung = $request->ghi_chu_vung;
        $maCongTy = Session::get('maCongTy');
        if($tenVung == "" || $tuKhoaVung == "" || $trangThaiVung == "") {
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/add-areas');
        } else if(strlen($tenVung) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/add-areas');
        } else if(strlen($tenVung) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/add-areas');
        } else {
            $data['ten_vung'] = $tenVung;
            $data['tu_khoa_vung'] = $tuKhoaVung;
            $data['trang_thai_vung'] = $trangThaiVung;
            $data['ghi_chu_vung'] = $ghiChuVung;
            $data['ma_cong_ty'] = $maCongTy;
            $data['created_at'] = Carbon::now();
            DB::table('areas')->insert($data);
            Session::flash("message", "Thêm vùng thành công.");
            return Redirect::to('/admin/list-areas');
        }
    }

    /**
     * This function is used to redirect to hide area
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function hide_areas($id) {
        $this->AuthLogin();
        DB::table('areas')->where('ma_vung', $id)->update(['trang_thai_vung' => 1]);
        Session::put('message', 'Ẩn vùng thành công.');
        return Redirect::to('/admin/list-areas');
    }

    /**
     * This function is used to redirect to show area
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function show_areas($id) {
        $this->AuthLogin();
        DB::table('areas')->where('ma_vung', $id)->update(['trang_thai_vung' => 0]);
        Session::put('message', 'Hiển thị vùng thành công.');
        return Redirect::to('/admin/list-areas');
    }

    /**
     * This function is used to move field on trash area
     * created by : DatNQ
     * created at : 20/11/2020
     */
    public function trash_areas($id) {
        $this->AuthLogin();
        DB::table('areas')->where('ma_vung', $id)->update(['trang_thai_vung' => 2]);
        Session::put('message', 'Xóa vùng thành công.');
        return Redirect::to('/admin/list-areas');
    }

    /**
     * This function is used to restore field on trash area
     * created by : DatNQ
     * created at : 20/11/2020
     */
    public function restore_areas($id) {
        $this->AuthLogin();
        DB::table('areas')->where('ma_vung', $id)->update(['trang_thai_vung' => 0]);
        Session::put('message', 'Restore vùng thành công.');
        return Redirect::to('/admin/list-areas');
    }
    

    /**
     * This function is used is redirect to edit area page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function edit_areas($id) {
        $this->AuthLogin();
        $capNhatVung = DB::table('areas')->where('ma_vung', $id)->get();
        return view('admin.areas.edit-areas')->with('areas', $capNhatVung);
    }

    /**
     * This function is used to handle data by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function update_areas(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $tenVung = $request->ten_vung;
        $tuKhoaVung = $request->tu_khoa_vung;
        $ghiChuVung = $request->ghi_chu_vung;
        if($tenVung == "" || $tuKhoaVung == "") {
            Session::push("failure", "Các trường không được để rỗng.");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else if(strlen($tenVung) > 100) {
            Session::push("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else if(strlen($tenVung) < 5) {
            Session::push("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else {
            $data['ten_vung'] = $tenVung;
            $data['tu_khoa_vung'] = $tuKhoaVung;
            $data['ghi_chu_vung'] = $ghiChuVung;
            $data['updated_at'] = Carbon::now();
            DB::table('areas')->where('ma_vung', $id)->update($data);
            Session::put('message', 'Cập nhật vùng thành công.');
            return Redirect::to('/admin/list-areas');
        }
    }

    /**
     * This function is used to delete data of area by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function delete_areas($id) {
        $this->AuthLogin();
        DB::table('areas')->where('ma_vung', $id)->delete();
        Session::put('message', 'Xóa vùng thành công.');
        return Redirect::to('/admin/areas-trash');
    }

    /**
     * 
     */
    public function list_api_areas() {
        // $this->AuthLogin();
        return Area::all();
    }
}