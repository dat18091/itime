<?php

namespace App\Http\Controllers\TakeLeaveReasons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\TakeLeaveReason;

class TakeLeaveReasonController extends Controller
{
    /**
     * This function to check accesses from outside
     * created by : DatNQ
     * created at : 25/11/2020
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
     * This function to show list take leave reasons with company id by GET method
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function list_take_leave_reasons() { //done
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $takeLeaveReason = TakeLeaveReason::where('status', '1')
        ->orWhere('status', '0')->where('company_id',$idCompany)->get();
        return view('admin.takeleavereasons.list-take-leave-reasons')
        ->with('list_take_leave_reasons', $takeLeaveReason);
    }

    /**
     * This function to show list trash take leave reason with company id by GET method
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function list_take_leave_reasons_trash() { //done
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $takeLeaveReason = TakeLeaveReason::where('status', '2')
        ->where('company_id',$idCompany)->get();
        return view('admin.takeleavereasons.list-take-leave-reasons-trash')
        ->with('list_take_leave_reasons', $takeLeaveReason);
    }

    /**
     * This function is used to redirect to add area page
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function add_take_leave_reasons() { //done
        $this->AuthLogin();
        return view('admin.takeleavereasons.add-take-leave-reasons');
    }

    /**
     * This function to handle data take leave reason by post method
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function save_take_leave_reasons(Request $request) { //done
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $status = $request->status;
        $note = $request->note;
        $idCompany = Session::get('maCongTy');
        if($name == "" || $status == "") {
            Session::flash("failure", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/list-take-leave-reasons');
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/list-take-leave-reasons');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/list-take-leave-reasons');
        } else {
            $data['name'] = $name;
            $data['status'] = $status;
            $data['note'] = $note;
            $data['company_id'] = $idCompany;
            $data['created_at'] = Carbon::now();
            TakeLeaveReason::insert($data);
            Session::flash("message", "Thêm lý do thành công.");
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-take-leave-reasons');
        }
    }

    /**
     * This function is used to redirect to hide area
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function hide_take_leave_reasons($id) { //done
        $this->AuthLogin();
        TakeLeaveReason::where('id', $id)->update(['status' => 1]);
        Session::flash('message', 'Ẩn lý do thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-take-leave-reasons');
    }

    /**
     * This function is used to redirect to show area
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function show_take_leave_reasons($id) { //done
        $this->AuthLogin();
        TakeLeaveReason::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị lý do thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-take-leave-reasons');
    }

    /**
     * This function is used to move field on trash take leave reasons
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function trash_take_leave_reasons($id) { //done
        $this->AuthLogin();
        TakeLeaveReason::where('id', $id)->update(['status' => 2]);
        Session::flash('message', 'Xóa lý do thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-take-leave-reasons');
    }

    /**
     * This function is used to restore field on trash take leave reasons
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function restore_take_leave_reasons($id) { //done
        $this->AuthLogin();
        TakeLeaveReason::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Restore lý do thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-take-leave-reasons');
    }
    

    /**
     * This function is used is redirect to edit area page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function edit_take_leave_reasons($id) {
        $this->AuthLogin();
        $capNhatLyDo = TakeLeaveReason::where('id', $id)->get();
        return view('admin.takeleavereasons.edit-take-leave-reasons')->with('takeleavereasons', $capNhatLyDo);
    }

    /**
     * This function is used to handle data by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function update_take_leave_reasons(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $note = $request->note;
        if($name == "") {
            Session::flash("failure", "Các trường không được để rỗng.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-take-leave-reasons/'.$id);
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-take-leave-reasons/'.$id);
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-take-leave-reasons/'.$id);
        } else {
            $data['name'] = $name;
            $data['note'] = $note;
            $data['updated_at'] = Carbon::now();
            TakeLeaveReason::where('id', $id)->update($data);
            Session::flash('message', 'Cập nhật lý do thành công.');
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-take-leave-reasons');
        }
    }

    /**
     * This function is used to delete data of take leave reasons by GET method
     * created by : DatNQ
     * created at : 25/11/2020
     */
    public function delete_take_leave_reasons($id) { //done
        $this->AuthLogin();
        TakeLeaveReason::where('id', $id)->delete();
        Session::flash('message', 'Xóa lý do thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-take-leave-reasons');
    }
}
