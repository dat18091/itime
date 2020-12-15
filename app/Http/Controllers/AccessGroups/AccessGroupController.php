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
        $idCompany = Session::get('maCongTy');
        $dataAccessGroup = Accessgroup::where('status', '1')->orWhere('status', '0')->where('company_id', $idCompany)->get();
        $accessGroupCountOnl = Accessgroup::where('status', '2')->count();
        return view('admin.accessgroups.list-access-groups')->with('dataAccessGroup', $dataAccessGroup)
        ->with('accessGroupCountOnl', $accessGroupCountOnl);
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
        $name = $request->name;
        $keyword = $request->keyword;
        $status = $request->status;
        $note = $request->note;
        $idCompany = Session::get('maCongTy');
        if($name == "" || $keyword == "" || $status == "") {
            Session::flash("message", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-access-groups');
        } else if(strlen($name) > 100) {
            Session::flash("message", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-access-groups');
        } else if(strlen($name) < 5) {
            Session::flash("message", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-access-groups');
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['status'] = $status;
            $data['note'] = $note;
            $data['company_id'] = $idCompany;
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
        DB::table('accessgroups')->where('id', $id)->update(['status' => 1]);
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
        Accessgroup::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị nhóm truy cập thành công.');
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
        $dataAccessGroup = Accessgroup::where('id', $id)->get();
        return view('admin.accessgroups.edit-access-groups')->with('dataAccessGroup', $dataAccessGroup);
    }

    /**
     * This function is used to update data accessgroups by POST method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function update_access_groups(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $keyword = $request->keyword;
        $note = $request->note;
        $idCompany = Session::get('maCongTy');
        if($name == "" || $keyword == "") {
            Session::flash("message", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else if(strlen($name) > 100) {
            Session::flash("message", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else if(strlen($name) < 5) {
            Session::flash("message", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-access-groups/'.$id);
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['note'] = $note;
            $data['company_id'] = $idCompany;
            $data['updated_at'] = Carbon::now();
            Accessgroup::where('id', $id)->update($data);
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
        Accessgroup::where('id', $id)->delete();
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
        $idCompany = Session::get('maCongTy');
        $dataAccessGroup = Accessgroup::where('status', '2')->where('company_id', $idCompany)->get();
        $accessGroupCount = Accessgroup::where('status', '2')->where('company_id', $idCompany)->count("*");
        $accessGroupCountAllOnl = Accessgroup::where('status', '0')->orWhere('status', '1')->where('company_id', $idCompany)->count();
        return view('admin.accessgroups.list-access-groups-trash')->with('dataAccessGroup', $dataAccessGroup)
        ->with('accessGroupCount', $accessGroupCount)->with('accessGroupCountAllOnl', $accessGroupCountAllOnl);
    }

    public function trash_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('id', $id)->update(['status' => 2]);
        Session::flash('message', 'Xóa nhóm truy cập thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-access-groups');
    }

    public function restore_access_groups($id) {
        $this->AuthLogin();
        DB::table('accessgroups')->where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị nhóm truy cập thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-access-groups');
    }
}
