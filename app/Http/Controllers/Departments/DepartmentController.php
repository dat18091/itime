<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Department;

class DepartmentController extends Controller
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
     * This function is used to get all data from department database by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function list_departments() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dataDepartments = Department::where('status', '1')
        ->orWhere('status', '0')
        ->where('company_id', $idCompany)->get();
        $departmentCountOnl = Department::where('status', '2')->count();
        return view('admin.departments.list-departments')->with('dataDepartments', $dataDepartments)
        ->with('departmentCountOnl', $departmentCountOnl);
    }
    
    /**
     * This function is used to get all data from department database by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function add_departments() {
        $this->AuthLogin();
        return view('admin.departments.add-departments');
    }

    /**
     * This function is used to save data from department database by POST method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function save_departments(Request $request) {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $data = array();
        $name = $request->name;
        $keyword = $request->keyword;
        $status = $request->status;
        $display_order = $request->display_order;
        $head_department = $request->head_department;
        $note = $request->note;
        if($name == "" || $status == "" || $head_department == "") {
            Session::flash("failure", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-departments');
        } else {
            $data["name"] = $name;
            $data["keyword"] = $keyword;
            $data["status"] = $status;
            $data["display_order"] = $display_order;
            $data["head_department"] = $head_department;
            $data["note"] = $note;
            $data["company_id"] = $idCompany;
            $data["created_at"] = Carbon::now();
            Department::insert($data);
            Session::flash('message', 'Thêm phòng ban thành công.');
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-departments'); 
        }
    }

    /**
     * This function is used to hide data from department by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function hide_departments($id) {
        $this->AuthLogin();
        Department::where('id', $id)->update(['status' => 1]);
        Session::flash('message', 'Ẩn phòng ban thành công');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to show data from department by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function show_departments($id) {
        $this->AuthLogin();
        Department::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị phòng ban thành công');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to hide head department data from department by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function second_departments($id) {
        $this->AuthLogin();
        Department::where('id', $id)->update(['head_department' => 1]);
        Session::flash('message', 'Tắt hiển thị phòng ban đứng đầu thành công');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to show head department data from department by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function first_departments($id) {
        $this->AuthLogin();
        Department::where('id', $id)->update(['head_department' => 0]);
        Session::flash('message', 'Hiển thị phòng ban đứng đầu thành công');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to show edit department page by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function edit_departments($id) {
        $this->AuthLogin();
        $dataDepartments = Department::where('id', $id)->get();
        return view('admin.departments.edit-departments')->with('dataDepartments', $dataDepartments);
    }

    /**
     * This function is used to update data from department database by POST method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function update_departments(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $keyword = $request->keyword;
        $display_order = $request->display_order;
        $note = $request->note;
        if($name == "") {
            Session::flash("failure", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-departments');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-departments');
        } else {
            $data["name"] = $name;
            $data["keyword"] = $keyword;
            $data["display_order"] = $display_order;
            $data["note"] = $note;
            $data["updated_at"] = Carbon::now();
            Department::where('id', $id)->update($data);
            Session::flash('message', 'Cập nhật phòng ban thành công.');
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-departments'); 
        }
    }

    /**
     * This function is used to delete data from department database by GET method
     * created by : DatNQ
     * created at : 05/11/2020
     */
    public function delete_departments($id) {
        $this->AuthLogin();
        Department::where('id', $id)->delete();
        Session::flash('message', 'Xóa phòng ban thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to show list department by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function list_departments_trash() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dataDepartments = Department::where('status', '2')->where('company_id', $idCompany)->get();
        $departmentCount = Department::where('status', '2')->where('company_id', $idCompany)->count("*");
        $departmentCountAllOnl = Department::where('status', '0')->orWhere('status', '1')->where('company_id', $idCompany)->count("*");
        return view('admin.departments.list-departments-trash')->with('dataDepartments', $dataDepartments)
        ->with('departmentCount', $departmentCount)->with('departmentCountAllOnl', $departmentCountAllOnl);
    }

    /**
     * This function is used to move data department trash by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function trash_departments($id) {
        $this->AuthLogin();
        Department::where('id', $id)->update(['status' => 2]);
        Session::flash('message', 'Xóa phòng ban thành công');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-departments');
    }

    /**
     * This function is used to restore data department trash by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function restore_departments($id) {
        $this->AuthLogin();
        Department::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị phòng ban thành công');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-departments');
    }
}
