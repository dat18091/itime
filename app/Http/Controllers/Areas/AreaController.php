<?php

namespace App\Http\Controllers\Areas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Area;
use App\Http\Controllers\PortConnect;

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
        $areasData = Area::where('status', '1')->orWhere('status', '0')->where('company_id',$idCompany)->get();
        $areaCountOnl = Area::where('status', '2')->count();

        // return view('admin.areas.list-areas')
        // ->with('areasData', $areasData)->with('areaCountOnl', $areaCountOnl);
        
        // $collection = User::get();
        // $collection->map(function($item, $key) {
        //     return [
        //         'id' => $item->id,
        //         'name' => $item->name,
        //         'creation_date' => $item->created_at->format('m/d/Y')
        //     ];
        // });
        $parameters = collect(['what' => "107", 'company_id' => "$idCompany"]);
        $input = json_encode($parameters);
        $data = $client->get('http://192.168.0.103:8080/api/izi-timekeeper/Controller/SelectAllByWhat.php?input='.$input.'');
        $res = json_decode($data->getBody(), true);
        return view('admin.areas.list-areas', ['areasData'=>$res])->with('areaCountOnl', $areaCountOnl);

        return view('admin.areas.list-areas')->with('areasData', $areasData)->with('areaCountOnl', $areaCountOnl);
        // $client = new \GuzzleHttp\Client();
        // $parameters = collect(['what' => "107", 'company_id' => "$idCompany"]);
        // $input = json_encode($parameters);
        // $data = $client->get('http://192.168.1.190:8080/api/izi-timekeeper/Controller/GetAllByWhat.php?input='.$input.'');
        // $res = json_decode($data->getBody(), true);
        // return view('admin.areas.list-areas', ['areasData'=>$res])->with('areaCountOnl', $areaCountOnl);

    }

    /**
     * This function to show list trash areas with company id by GET method
     * created by : DatNQ
     * created at : 20/11/2020
     */
    public function list_areas_trash() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $areasData =  Area::where('status', '2')->where('company_id',$idCompany)->get();
        $areaCount = Area::where('status', '2')->where('company_id', $idCompany)->count("*");
        $areaCountAllOnl = Area::where('status', '0')->orWhere('status', '1')->where('company_id', $idCompany)->count();
        return view('admin.areas.list-areas-trash')->with('areasData', $areasData)
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
        $name = $request->name;
        $keyword = $request->keyword;
        $status = $request->status;
        $note = $request->note;
        $idCompany = Session::get('maCongTy');
        if($name == "" || $keyword == "" || $status == "") {
            Session::flash("message", "Các trường không được để trống.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-areas');
        } else if(strlen($name) > 100) {
            Session::flash("message", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-areas');
        } else if(strlen($name) < 5) {
            Session::flash("message", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-areas');
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['status'] = $status;
            $data['note'] = $note;
            $data['company_id'] = $idCompany;
            $data['created_at'] = Carbon::now();
            Area::insert($data);
            Session::flash("message", "Thêm vùng thành công.");
            Session::flash("alert-type", "success");
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
        Area::where('id', $id)->update(['status' => 1]);
        Session::flash('message', 'Ẩn vùng thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-areas');
    }

    /**
     * This function is used to redirect to show area
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function show_areas($id) {
        $this->AuthLogin();
        Area::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Hiển thị vùng thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-areas');
    }

    /**
     * This function is used to move field on trash area
     * created by : DatNQ
     * created at : 20/11/2020
     */
    public function trash_areas($id) {
        $this->AuthLogin();
        Area::where('id', $id)->update(['status' => 2]);
        Session::flash('message', 'Xóa vùng thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-areas');
    }

    /**
     * This function is used to restore field on trash area
     * created by : DatNQ
     * created at : 20/11/2020
     */
    public function restore_areas($id) {
        $this->AuthLogin();
        Area::where('id', $id)->update(['status' => 0]);
        Session::flash('message', 'Restore vùng thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-areas');
    }
    

    /**
     * This function is used is redirect to edit area page
     * created by : DatNQ     
     * created at : 31/10/2020
     */
    public function edit_areas($id) {
        $this->AuthLogin();
        $updateArea = Area::where('id', $id)->get();
        return view('admin.areas.edit-areas')->with('updateArea', $updateArea);
    }

    /**
     * This function is used to handle data by post method
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function update_areas(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $keyword = $request->keyword;
        $note = $request->note;
        if($name == "" || $keyword == "") {
            Session::flash("message", "Các trường không được để rỗng.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else if(strlen($name) > 100) {
            Session::flash("message", "Bạn đã nhập quá ký tự cho phép.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else if(strlen($name) < 5) {
            Session::flash("message", "Bạn nhập không đủ ký tự.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-areas/'.$id);
        } else {
            $data['name'] = $name;
            $data['keyword'] = $keyword;
            $data['note'] = $note;
            $data['updated_at'] = Carbon::now();
            Area::where('id', $id)->update($data);
            Session::flash('message', 'Cập nhật vùng thành công.');
            Session::flash("alert-type", "success");
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
        Area::where('id', $id)->delete();
        Session::flash('message', 'Xóa vùng thành công.');
        Session::flash("alert-type", "success");
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