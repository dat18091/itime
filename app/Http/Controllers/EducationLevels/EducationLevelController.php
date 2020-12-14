<?php

namespace App\Http\Controllers\EducationLevels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Educationlevel;

class EducationLevelController extends Controller
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
        $name = $request->name;
        $keyword = $request->keyword;
        $status = $request->status;
        $note = $request->note;
        $idCompany = Session::get('maCongTy');
        if($name == "" || $keyword == "" || $status == "") {
            Session::flash("failure", "Các trường không được để rỗng.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-education-levels');
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-education-levels');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-education-levels');
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['status'] = $status;
            $data['note'] = $note;
            $data['company_id'] = $idCompany;
            $data['created_at'] = Carbon::now();
            Educationlevel::insert($data);
            Session::flash('message', 'Thêm trình độ thành công.');
            Session::flash("alert-type", "success");
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
        $idCompany = Session::get('maCongTy');
        $dataLevels = Educationlevel::where('status', '1')->orWhere('status', '0')->where('company_id', $idCompany)->get();
        $levelCountOnl = Educationlevel::where('status', '2')->where('company_id', $idCompany)->count();
        return view('admin.educationlevels.list-education-levels')->with('dataLevels', $dataLevels)
        ->with('levelCountOnl', $levelCountOnl);
    }

    /**
     * This function hide education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function hide_education_levels($id) {
        $this->AuthLogin();
        Educationlevel::where('id', $id)->update(['status' => 1]);
        Session::flash('message', 'Ẩn trình độ thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-education-levels');
    }

    /**
     * This function show education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function show_education_levels($id) {
        $this->AuthLogin();
        Educationlevel::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị trình độ thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-education-levels');
    }

    /**
     * This function show edit education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function edit_education_levels($id) {
        $this->AuthLogin();
        $chinhSuaTrinhDo = Educationlevel::where('id', $id)->get();
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
        $name = $request->name;
        $keyword = $request->keyword;
        $note = $request->note;
        if($name == "" || $keyword == "") {
            Session::flash("failure", "Các trường không được để rỗng.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-education-levels');
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-education-levels');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-education-levels');
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['note'] = $note;
            $data['updated_at'] = Carbon::now();
            Educationlevel::where('id', $id)->update($data);
            Session::flash('message', 'Chỉnh sửa trình độ thành công.');
            Session::flash("alert-type", "success");
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
        Educationlevel::where('id', $id)->delete();
        Session::flash('message', 'Xóa trình độ thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-education-levels');
    }

    /**
     * This function show list data education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function list_education_levels_trash() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dataLevels = Educationlevel::where('status', '2')->where('company_id', $idCompany)->get();
        $levelCount = Educationlevel::where('status', '2')->where('company_id', $idCompany)->count("*");
        $levelCountAllOnl = Educationlevel::where('status', '0')->orWhere('status', '1')->where('company_id', $idCompany)->count();
        return view('admin.educationlevels.list-education-levels-trash')->with('dataLevels', $dataLevels)
        ->with('levelCount', $levelCount)->with('levelCountAllOnl', $levelCountAllOnl);
    }

    /**
     * This function move trash data education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function trash_education_levels($id) {
        $this->AuthLogin();
        Educationlevel::where('id', $id)->update(['status' => 2]);
        Session::flash('message', 'Xóa trình độ thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-education-levels');
    }

    /**
     * This function restore trash data education level by GET method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function restore_education_levels($id) {
        $this->AuthLogin();
        Educationlevel::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Restore trình độ thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-education-levels');
    }
}
