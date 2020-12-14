<?php

namespace App\Http\Controllers\Positions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Position;
use App\Educationlevel;

class PositionController extends Controller
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
     * This function to show add positions page by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function add_positions() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $educationLevel = Educationlevel::where('status', '=', '0')
        ->where('company_id',$idCompany)->orderby('id', 'asc')->get();
        return view('admin.positions.add-positions')->with('educationLevel', $educationLevel);
    }

    /**
     * This function to handle data and save positions by POST method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function save_positions(Request $request) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $keyword = $request->keyword;
        $experience = $request->experience;
        $educationlevel_id = $request->educationlevel_id;
        $display_order = $request->display_order;
        $status = $request->status;
        $note = $request->note;
        $idCompany = Session::get('maCongTy');
        if($name == "" ||$keyword =="" || $experience =="" || $educationlevel_id == "" || 
            $status == "") {
            Session::flash("failure", "Các trường không được để trống.");
            Session::flash("alert-type", "success");
            return Redirect::to("/admin/add-positions");
        } else if(strlen($name) > 100) {
            Session::flash("failure", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/add-positions');
        } else if(strlen($name) < 5) {
            Session::flash("failure", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/add-positions');
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['experience'] = $experience;
            $data['educationlevel_id'] = $educationlevel_id;
            $data['display_order'] = $display_order;
            $data['status'] = $status;
            $data['note'] = $note;
            $data['company_id'] = $idCompany;
            $data['created_at'] = Carbon::now();
            Position::insert($data);
            Session::flash('message', 'Thêm chức danh thành công.');
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-positions');
        }
    }

    /**
     * This function to show list data of positions by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function list_positions() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dataPosition = Position::join('educationlevels', 'educationlevels.id' , '=', 'positions.educationlevel_id')
        ->select(['positions.*', 'educationlevels.id as idEducationLevel'])
        ->where('positions.status', '1')->orWhere('positions.status', '0')
        ->where('positions.company_id', $idCompany)->get();
        $educationLevel = Educationlevel::where('status', '0')->where('company_id',$idCompany)->get();
        $positionCountOnl = Position::where('status', '2')->count();
        return view('admin.positions.list-positions')->with('dataPosition', $dataPosition)->with('educationLevel', $educationLevel)
        ->with('positionCountOnl', $positionCountOnl);
    }

    /**
     * This function to hide a positions by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function hide_positions($id) {
        $this->AuthLogin();
        Position::where('id', $id)->update(['status' => 1]);
        Session::flash('message', 'Ẩn chức danh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-positions');
    }

    /**
     * This function to show a positions by GET method
     * created by : DatNQ
     * created at : 01/11/2020
     */
    public function show_positions($id) {
        $this->AuthLogin();
        Position::where('id', $id)->distinct()->update(['status' => 0]);
        Session::flash('message', 'Hiển thị chức danh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-positions');
    }

    /**
     * This function to show edit-positions page by GET method
     * created by : DatNQ
     * created at : 03/11/2020
     */
    public function edit_positions($id) {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $educationLevel = Educationlevel::where('company_id',$idCompany)->get();
        $dataPosition = Position::where('company_id',$idCompany)->where('id', $id)->get(); 
        return view('admin.positions.edit-positions')->with('educationLevel', $educationLevel)->with('dataPosition',$dataPosition);
    }

    /**
     * This function to handle data positions page by POST method
     * created by : DatNQ
     * created at : 03/11/2020
     */
    public function update_positions(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $keyword = $request->keyword;
        $experience = $request->experience;
        $educationlevel_id = $request->educationlevel_id;
        $display_order = $request->display_order;
        $note = $request->note;
        if($name == "" ||$keyword =="" || $experience =="" || $educationlevel_id == "") {
            Session::flash("message", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to("/admin/edit-positions/".$id);
        } else if(strlen($name) > 100) {
            Session::flash("message", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-positions/'.$id);
        } else if(strlen($name) < 5) {
            Session::flash("message", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-positions/'.$id);
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['experience'] = $experience;
            $data['educationlevel_id'] = $educationlevel_id;
            $data['display_order'] = $display_order;
            $data['note'] = $note;
            $data['updated_at'] = Carbon::now();
            Position::where('id', $id)->update($data);
            Session::flash('message', 'Chỉnh sửa chức danh thành công.');
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-positions');
        }
    }

    /**
     * This function to delete data positions page by GET method
     * created by : DatNQ
     * created at : 03/11/2020
     */
    public function delete_positions($id) {
        $this->AuthLogin();
        Position::where('id', $id)->delete();
        Session::flash('message', 'Xóa chức danh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-positions');
    }

    /**
     * This function to get data from trash positions by GET method
     * created by : DatNQ
     * created at : 23/11/2020
     */
    public function list_positions_trash() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dataPosition = Position::join('educationlevels', 'educationlevels.id' , '=', 'positions.educationlevel_id')
        ->select(['positions.*', 'educationlevels.id as idEducationLevel'])
        ->where('positions.status', '2')->where('positions.company_id', $idCompany)->get();
        $educationLevel = Educationlevel::get();
        $positionCount = Position::where('status', '2')->where('company_id', $idCompany)->count("*");
        $positionCountAllOnl = Position::where('status', '0')->orWhere('status', '1')->where('company_id', $idCompany)->count();
        return view('admin.positions.list-positions-trash')->with('dataPosition', $dataPosition)->with('educationLevel', $educationLevel)
        ->with('positionCount', $positionCount)->with('positionCountAllOnl', $positionCountAllOnl);
    }

    public function trash_positions($id) {
        $this->AuthLogin();
        Position::where('id', $id)->update(['status' => 2]);
        Session::flash('message', 'Xóa chức danh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-positions');
    }

    public function restore_positions($id) {
        $this->AuthLogin();
        Position::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Khôi phục chức danh thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-positions');
    }
}
