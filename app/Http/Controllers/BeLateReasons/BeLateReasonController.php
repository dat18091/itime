<?php

namespace App\Http\Controllers\BeLateReasons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Belatereason;

class BeLateReasonController extends Controller
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
     * This function to show list take leave reasons with company id by GET method
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function list_be_late_reasons() { //done
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $beLateReason = Belatereason::where('status', '1')
        ->orWhere('status', '0')->where('ma_cong_ty',$idCompany)->get();
        return view('admin.belatereasons.list-be-late-reasons')
        ->with('list_be_late_reasons', $beLateReason);
    }

    /**
     * This function to show list trash take leave reason with company id by GET method
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function list_be_late_reasons_trash() { //done
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $beLateReason = Belatereason::where('status', '2')->where('ma_cong_ty',$idCompany)->get();
        return view('admin.belatereasons.list-be-late-reasons-trash')
        ->with('list_be_late_reasons', $beLateReason);
    }

    /**
     * This function is used to redirect to add area page
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function add_be_late_reasons() { //done
        $this->AuthLogin();
        return view('admin.belatereasons.add-be-late-reasons');
    }

    /**
     * This function to handle data take leave reason by post method
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function save_be_late_reasons(Request $request) { //done
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $status = $request->status;
        $note = $request->note;
        $maCongTy = Session::get('maCongTy');
        if($name == "" || $status == "") {
            Session::flash("failure", "Các trường không được để trống.");
            return Redirect::to('/admin/list-be-late-reasons');
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/list-be-late-reasons');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/list-be-late-reasons');
        } else {
            $data['name'] = $name;
            $data['status'] = $status;
            $data['note'] = $note;
            $data['ma_cong_ty'] = $maCongTy;
            $data['created_at'] = Carbon::now();
            Belatereason::insert($data);
            Session::flash("message", "Thêm lý do thành công.");
            return Redirect::to('/admin/list-be-late-reasons');
        }
    }

    /**
     * This function is used to redirect to hide area
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function hide_be_late_reasons($id) { //done
        $this->AuthLogin();
        Belatereason::where('id', $id)->update(['status' => 1]);
        Session::put('message', 'Ẩn lý do thành công.');
        return Redirect::to('/admin/list-be-late-reasons');
    }

    /**
     * This function is used to redirect to show area
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function show_be_late_reasons($id) { //done
        $this->AuthLogin();
        Belatereason::where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Hiển thị lý do thành công.');
        return Redirect::to('/admin/list-be-late-reasons');
    }

    /**
     * This function is used to move field on trash take leave reasons
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function trash_be_late_reasons($id) { //done
        $this->AuthLogin();
        Belatereason::where('id', $id)->update(['status' => 2]);
        Session::put('message', 'Xóa lý do thành công.');
        return Redirect::to('/admin/list-be-late-reasons');
    }

    /**
     * This function is used to restore field on trash take leave reasons
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function restore_be_late_reasons($id) { //done
        $this->AuthLogin();
        Belatereason::where('id', $id)->update(['status' => 0]);
        Session::put('message', 'Restore lý do thành công.');
        return Redirect::to('/admin/list-be-late-reasons');
    }
    

    /**
     * This function is used is redirect to edit area page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function edit_be_late_reasons($id) {
        $this->AuthLogin();
        $capNhatLyDo = Belatereason::where('id', $id)->get();
        return view('admin.belatereasons.edit-be-late-reasons')->with('belatereasons', $capNhatLyDo);
    }

    /**
     * This function is used to handle data by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function update_be_late_reasons(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $note = $request->note;
        if($name == "") {
            Session::push("failure", "Các trường không được để rỗng.");
            return Redirect::to('/admin/edit-be-late-reasons/'.$id);
        } else if(strlen($name) > 100) {
            Session::push("failure", "Bạn đã nhập quá ký tự cho phép.");
            return Redirect::to('/admin/edit-be-late-reasons/'.$id);
        } else if(strlen($name) < 5) {
            Session::push("failure", "Bạn nhập không đủ ký tự.");
            return Redirect::to('/admin/edit-be-late-reasons/'.$id);
        } else {
            $data['name'] = $name;
            $data['note'] = $note;
            $data['updated_at'] = Carbon::now();
            Belatereason::where('id', $id)->update($data);
            Session::put('message', 'Cập nhật lý do thành công.');
            return Redirect::to('/admin/list-be-late-reasons');
        }
    }

    /**
     * This function is used to delete data of take leave reasons by GET method
     * created by : DatNQ
     * created at : 26/11/2020
     */
    public function delete_be_late_reasons($id) { //done
        $this->AuthLogin();
        Belatereason::where('id', $id)->delete();
        Session::put('message', 'Xóa lý do thành công.');
        return Redirect::to('/admin/list-be-late-reasons');
    }
}
