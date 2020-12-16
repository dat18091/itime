<?php

namespace App\Http\Controllers\DateTakeLeaveTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Datetakeleavetype;

class DateTakeLeaveTypeController extends Controller
{
    /**
     * This function to check accesses from outside
     * created by : DatNQ
     * created at : 28/11/2020
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
     * This function to show list date take leave types with company id by GET method
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function list_date_take_leave_types() { 
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dateTakeLeaveType = Datetakeleavetype::where('status', '1')->orWhere('status', '0')->where('company_id',$idCompany)->get();
        return view('admin.datetakeleavetypes.list-date-take-leave-types')->with('list_date_take_leave_types', $dateTakeLeaveType);
    }

    /**
     * This function to show list trash date take leave type with company id by GET method
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function list_date_take_leave_types_trash() { 
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dateTakeLeaveType = Datetakeleavetype::where('status', '2')->where('company_id',$idCompany)->get();
        return view('admin.datetakeleavetypes.list-date-take-leave-types-trash')->with('list_date_take_leave_types', $dateTakeLeaveType);
    }

    /**
     * This function is used to redirect to add area page
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function add_date_take_leave_types() { 
        $this->AuthLogin();
        return view('admin.datetakeleavetypes.add-date-take-leave-types');
    }

    /**
     * This function to handle data date take leave type by post method
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function save_date_take_leave_types(Request $request) { 
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $status = $request->status;
        $note = $request->note;
        $idCompany = Session::get('maCongTy');
        if($name == "" || $status == "") {
            Session::flash("failure", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/list-date-take-leave-types');
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/list-date-take-leave-types');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/list-date-take-leave-types');
        } else {
            $data['name'] = $name;
            $data['status'] = $status;
            $data['note'] = $note;
            $data['company_id'] = $idCompany;
            $data['created_at'] = Carbon::now();
            Datetakeleavetype::insert($data);
            Session::flash("message", "Thêm lý do thành công.");
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-date-take-leave-types');
        }
    }

    /**
     * This function is used to redirect to hide area
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function hide_date_take_leave_types($id) { 
        $this->AuthLogin();
        Datetakeleavetype::where('id', $id)->update(['status' => 1]);
        Session::put('message', 'Ẩn loại ngày nghỉ thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-date-take-leave-types');
    }

    /**
     * This function is used to redirect to show area
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function show_date_take_leave_types($id) { 
        $this->AuthLogin();
        Datetakeleavetype::where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Hiển thị loại ngày nghỉ thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-date-take-leave-types');
    }

    /**
     * This function is used to move field on trash date take leave types
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function trash_date_take_leave_types($id) { 
        $this->AuthLogin();
        Datetakeleavetype::where('id', $id)->update(['status' => 2]);
        Session::put('message', 'Xóa lý do thành công.');
        return Redirect::to('/admin/list-date-take-leave-types');
    }

    /**
     * This function is used to restore field on trash date take leave types
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function restore_date_take_leave_types($id) { 
        $this->AuthLogin();
        Datetakeleavetype::where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Restore lý do thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-date-take-leave-types');
    }
    

    /**
     * This function is used is redirect to edit area page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function edit_date_take_leave_types($id) {
        $this->AuthLogin();
        $capNhatLyDo = Datetakeleavetype::where('id', $id)->get();
        return view('admin.datetakeleavetypes.edit-date-take-leave-types')->with('datetakeleavetypes', $capNhatLyDo);
    }

    /**
     * This function is used to handle data by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function update_date_take_leave_types(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $note = $request->note;
        if($name == "") {
            Session::push("failure", "Các trường không được để rỗng.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-date-take-leave-types/'.$id);
        } else if(strlen($name) > 100) {
            Session::push("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-date-take-leave-types/'.$id);
        } else if(strlen($name) < 5) {
            Session::push("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-date-take-leave-types/'.$id);
        } else {
            $data['name'] = $name;
            $data['note'] = $note;
            $data['updated_at'] = Carbon::now();
            Datetakeleavetype::where('id', $id)->update($data);
            Session::put('message', 'Cập nhật lý do thành công.');
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-date-take-leave-types');
        }
    }

    /**
     * This function is used to delete data of date take leave types by GET method
     * created by : DatNQ
     * created at : 28/11/2020
     */
    public function delete_date_take_leave_types($id) { 
        $this->AuthLogin();
        Datetakeleavetype::where('id', $id)->delete();
        Session::put('message', 'Xóa lý do thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-date-take-leave-types');
    }

}
