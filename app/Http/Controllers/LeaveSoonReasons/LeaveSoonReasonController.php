<?php

namespace App\Http\Controllers\LeaveSoonReasons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Leavesoonreason;

class LeaveSoonReasonController extends Controller
{
    /**
     * This function to check accesses from outside
     * created by : DatNQ
     * created at : 26/11/2020
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
     * This function to show list leave soon reasons with company id by GET method
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function list_leave_soon_reasons() { 
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $leaveSoonReason = Leavesoonreason::where('status', '1')
        ->orWhere('status', '0')->where('ma_cong_ty',$idCompany)->get();
        return view('admin.leavesoonreasons.list-leave-soon-reasons')
        ->with('list_leave_soon_reasons', $leaveSoonReason);
    }

    /**
     * This function to show list trash leave soon reason with company id by GET method
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function list_leave_soon_reasons_trash() { 
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $leaveSoonReason = Leavesoonreason::where('status', '2')->where('ma_cong_ty',$idCompany)->get();
        return view('admin.leavesoonreasons.list-leave-soon-reasons-trash')
        ->with('list_leave_soon_reasons', $leaveSoonReason);
    }

    /**
     * This function is used to redirect to add area page
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function add_leave_soon_reasons() { 
        $this->AuthLogin();
        return view('admin.leavesoonreasons.add-leave-soon-reasons');
    }

    /**
     * This function to handle data leave soon reason by post method
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function save_leave_soon_reasons(Request $request) { 
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $status = $request->status;
        $note = $request->note;
        $maCongTy = Session::get('maCongTy');
        if($name == "" || $status == "") {
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/list-leave-soon-reasons');
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/list-leave-soon-reasons');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/list-leave-soon-reasons');
        } else {
            $data['name'] = $name;
            $data['status'] = $status;
            $data['note'] = $note;
            $data['ma_cong_ty'] = $maCongTy;
            $data['created_at'] = Carbon::now();
            Leavesoonreason::insert($data);
            Session::flash("message", "Thêm lý do thành công.");
            return Redirect::to('/admin/list-leave-soon-reasons');
        }
    }

    /**
     * This function is used to redirect to hide area
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function hide_leave_soon_reasons($id) { 
        $this->AuthLogin();
        Leavesoonreason::where('id', $id)->update(['status' => 1]);
        Session::put('message', 'Ẩn lý do thành công.');
        return Redirect::to('/admin/list-leave-soon-reasons');
    }

    /**
     * This function is used to redirect to show area
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function show_leave_soon_reasons($id) { 
        $this->AuthLogin();
        Leavesoonreason::where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Hiển thị lý do thành công.');
        return Redirect::to('/admin/list-leave-soon-reasons');
    }

    /**
     * This function is used to move field on trash leave soon reasons
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function trash_leave_soon_reasons($id) { 
        $this->AuthLogin();
        Leavesoonreason::where('id', $id)->update(['status' => 2]);
        Session::put('message', 'Xóa lý do thành công.');
        return Redirect::to('/admin/list-leave-soon-reasons');
    }

    /**
     * This function is used to restore field on trash leave soon reasons
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function restore_leave_soon_reasons($id) { 
        $this->AuthLogin();
        Leavesoonreason::where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Restore lý do thành công.');
        return Redirect::to('/admin/list-leave-soon-reasons');
    }
    

    /**
     * This function is used is redirect to edit area page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function edit_leave_soon_reasons($id) {
        $this->AuthLogin();
        $capNhatLyDo = Leavesoonreason::where('id', $id)->get();
        return view('admin.leavesoonreasons.edit-leave-soon-reasons')->with('leavesoonreasons', $capNhatLyDo);
    }

    /**
     * This function is used to handle data by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function update_leave_soon_reasons(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $note = $request->note;
        if($name == "") {
            Session::push("failure", "Các trường không được để rỗng.");
            return Redirect::to('/admin/edit-leave-soon-reasons/'.$id);
        } else if(strlen($name) > 100) {
            Session::push("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/edit-leave-soon-reasons/'.$id);
        } else if(strlen($name) < 5) {
            Session::push("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/edit-leave-soon-reasons/'.$id);
        } else {
            $data['name'] = $name;
            $data['note'] = $note;
            $data['updated_at'] = Carbon::now();
            Leavesoonreason::where('id', $id)->update($data);
            Session::put('message', 'Cập nhật lý do thành công.');
            return Redirect::to('/admin/list-leave-soon-reasons');
        }
    }

    /**
     * This function is used to delete data of leave soon reasons by GET method
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function delete_leave_soon_reasons($id) { 
        $this->AuthLogin();
        Leavesoonreason::where('id', $id)->delete();
        Session::put('message', 'Xóa lý do thành công.');
        return Redirect::to('/admin/list-leave-soon-reasons');
    }
}
