<?php

namespace App\Http\Controllers\Branches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Branch;
use App\Area;

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
        $idCompany = Session::get('maCongTy');
        $dataBranch = Branch::join('areas', 'branches.area_id' , '=', 'areas.id')
        ->join('districts', 'branches.district_id', '=', 'districts.id')
        ->join('provinces', 'branches.province_id', '=', 'provinces.id')
        ->join('companies', 'branches.company_id', '=', 'companies.id')
        ->select(['branches.*', 'areas.id as idArea', 'districts.id AS idDistrict', 'provinces.id AS idProvince', 'companies.id AS idCompany'])
        ->where('branches.status', '1')->orWhere('branches.status', '0')->where('branches.company_id', $idCompany)
        ->get();
        $getAreas = Area::get();
        $getProvinces = DB::table('provinces')->get();
        $getDistricts = DB::table('districts')->get();
        $branchCountOnl = Branch::where('status', '2')->count();
        return view('admin.branches.list-branches')->with('dataBranch', $dataBranch)->with('branchCountOnl', $branchCountOnl)
        ->with('getAreas', $getAreas)->with('getProvinces', $getProvinces)->with('getDistricts', $getDistricts);
    }

    /**
     * This function is used to display add branch page by GET method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function add_branches(Request $request) {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');     
        $getAreas = Area::where('status', '=', '0')->where('company_id', $maCongTy)->get();
        $getProvinces = DB::table('provinces')->get();
        $getDistricts = DB::table('districts')->get();
        return view('admin.branches.add-branches')->with('getAreas', $getAreas)->with('getProvinces', $getProvinces)->with('getDistricts', $getDistricts);
    }

    /**
     * This function is used to handle data branch by POST method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function save_branches(Request $request) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $keyword = $request->keyword;
        $status = $request->status;
        $address = $request->address;
        $idArea = $request->idArea;
        $idProvince = $request->idProvince;
        $idDistrict = $request->idDistrict;
        $displayOrder = $request->displayOrder;
        $note = $request->note;
        $idCompany = Session::get('maCongTy');
        if($name == "" || $status == "" || $address == "" || $idArea == "" ||
            $idProvince == "" || $idDistrict == "") {
            Session::flash('message', 'Các trường không được để trống.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-branches');
        } else if(strlen($name) > 100 || strlen($address) > 200) {
            Session::flash('message', 'Bạn đã nhập quá ký tự cho phép.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-branches');
        } else if(strlen($name) < 5 || strlen($address) < 5) {
            Session::flash('message', 'Bạn đã nhập không đủ ký tự.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-branches');
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['status'] = $status;
            $data['address'] = $address;
            $data['area_id'] = $idArea;
            $data['province_id'] = $idProvince;
            $data['district_id'] = $idDistrict;
            $data['display_order'] = $displayOrder;
            $data['note'] = $note;
            $data['company_id'] = $idCompany;
            $data['created_at'] = Carbon::now();
            Branch::insert($data);
            Session::flash('message', 'Thêm chi nhánh thành công.');
            Session::flash("alert-type", "success");
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
        Branch::where('id', $id)->update(['status' => 1]);
        Session::flash('message', 'Ẩn chi nhánh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-branches');
    }

    /**
     * This function is used to show this branch by GET method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function show_branches($id) {
        $this->AuthLogin();
        Branch::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị chi nhánh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-branches');
    }

    /**
     * This function is used to list branches trash by GET method 
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function list_branches_trash() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dataBranch = Branch::join('areas', 'branches.area_id' , '=', 'areas.id')
        ->join('districts', 'branches.district_id', '=', 'districts.id')
        ->join('provinces', 'branches.province_id', '=', 'provinces.id')
        ->join('companies', 'branches.company_id', '=', 'companies.id')
        ->select(['branches.*', 'areas.id as idArea', 'districts.id AS idDistrict', 'provinces.id AS idProvince', 'companies.id AS idCompany'])
        ->where('branches.status', '2')->where('branches.company_id', $idCompany)->get();
        $getAreas = Area::get();
        $getProvinces = DB::table('provinces')->get();
        $getDistricts = DB::table('districts')->get();
        $branchCount = Branch::where('status', '2')->where('company_id', $idCompany)->count("*");
        $branchCountAllOnl = Branch::where('status', '0')
        ->orWhere('status', '1')->where('company_id', $idCompany)->count();
        return view('admin.branches.list-branches-trash')->with('dataBranch', $dataBranch)->with('branchCount', $branchCount)
        ->with('getAreas', $getAreas)->with('getProvinces', $getProvinces)->with('getDistricts', $getDistricts)->with('branchCountAllOnl', $branchCountAllOnl);
    }

    /**
     * This function is used to show edit branch page by GET method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function edit_branches($id) {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');     
        $getAreas = Area::where('status', '=', '0')->where('company_id', $maCongTy)->get();
        $getProvinces = DB::table('provinces')->get();
        $getDistricts = DB::table('districts')->get();
        $dataBranch = Branch::where('id', $id)->get();
        return view('admin.branches.edit-branches')->with('getAreas', $getAreas)
        ->with('getProvinces', $getProvinces)->with('getDistricts', $getDistricts)->with('dataBranch', $dataBranch);
    }

    /**
     * This function is used to handle data update branch by POST method
     * created by : DatNQ
     * created at : 04/11/2020
     */
    public function update_branches(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $keyword = $request->keyword;
        $address = $request->address;
        $idArea = $request->idArea;
        $idProvince = $request->idProvince;
        $idDistrict = $request->idDistrict;
        $displayOrder = $request->displayOrder;
        $note = $request->note;
        if($name == "" || $address == "" || $idArea == "" ||
            $idProvince == "" || $idDistrict == "") {
            Session::flash('message', 'Các trường không được để trống.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-branches/'.$id);
        } else if(strlen($name) > 100 || strlen($address) > 200) {
            Session::flash('message', 'Bạn đã nhập quá ký tự cho phép.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-branches/'.$id);
        } else if(strlen($name) < 5 || strlen($address) < 5) {
            Session::flash('message', 'Bạn đã nhập không đủ ký tự.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-branches/'.$id);
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['address'] = $address;
            $data['area_id'] = $idArea;
            $data['province_id'] = $idProvince;
            $data['district_id'] = $idDistrict;
            $data['display_order'] = $displayOrder;
            $data['note'] = $note;
            $data['updated_at'] = Carbon::now();
            Branch::where('id', $id)->update($data);
            Session::flash('message', 'Cập nhật chi nhánh thành công.');
            Session::flash("alert-type", "success");
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
        Branch::where('id', $id)->delete();
        Session::flash('message', 'Xóa chi nhánh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-branches');
    }

    /**
     * This function is used to move data from branch by GET method 
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function trash_branches($id) {
        $this->AuthLogin();
        Branch::where('id', $id)->update(['status' => 2]);
        Session::flash('message', 'Xóa chi nhánh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-branches');
    }

    /**
     * This function is used to restore data from branch by GET method 
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function restore_branches($id) {
        $this->AuthLogin();
        Branch::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị chi nhánh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-branches');
    }
}
