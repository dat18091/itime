<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Employee;
use App\Area;
use App\Branch;

class EmployeeController extends Controller
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
     * This function to get list employee and show from database by GET method
     * created by : DatNQ
     * created at : 02/11/2020
     */
    public function list_employees() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $dataEmployee = Employee::where('active', '0')->orWhere('active', '1')->where('company_id', $maCongTy)->get();
        $dataArea = Area::get();
        $dataBranch = Branch::get();
        $dataDepartment = DB::table('departments')->get();
        $dataPosition = DB::table('positions')->get();
        $dataAccessGroup = DB::table('accessgroups')->get();
        return view('admin.employees.list-employees')->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)
        ->with('dataBranch', $dataBranch)->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataAccessGroup', $dataAccessGroup);
        // $this->AuthLogin();
        // $idCompany = Session::get('maCongTy');
        // $dataEmployee = Employee::join('areas', 'employees.area_id' , '=', 'areas.id')
        // ->select(['employees.*','areas.id AS idArea'])
        // ->where('employees.active', '1')->orWhere('employees.active', '0')->where('employees.company_id', $idCompany)->get();
        // $dataArea = Area::get();
        // return view('admin.employees.list-employees')->with('dataEmployee' , $dataEmployee)
        // ->with('dataArea' , $dataArea);
    }

    /**
     * This function to show add employee page by GET method
     * created by : DatNQ
     * created at : 02/11/2020
     */
    public function add_employees() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $dataArea = DB::table('areas')->where('status', 0)->where('company_id', $maCongTy)->orderby('id', 'DESC')->get();
        $dataBranch = DB::table('branches')->where('status', 0)->where('company_id', $maCongTy)->orderby('id', 'DESC')->get();
        $dataDepartment = DB::table('departments')->where('status', 0)->where('company_id', $maCongTy)->orderby('id', 'DESC')->get();
        $dataAccessGroup = DB::table('accessgroups')->where('status', 0)->where('company_id', $maCongTy)->orderby('id', 'DESC')->get();
        $dataPosition = DB::table('positions')->where('status', 0)->where('company_id', $maCongTy)->orderby('id', 'DESC')->get();
        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->get();
        return view('admin.employees.add-employees')->with('dataArea', $dataArea)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataAccessGroup', $dataAccessGroup)->with('dataPosition', $dataPosition)
        ->with('provinces', $provinces)->with('districts', $districts);
    }

    /**
     * This function to save data employee by POST method
     * created by : DatNQ
     * created at : 02/11/2020
     */
    public function save_employees(Request $request) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $date_of_birth = $request->date_of_birth;
        $gender = $request->gender;
        $display_order = $request->display_order;
        $identity_card = $request->identity_card;
        $date_release_id = $request->date_release_id;
        $located_release_id = $request->located_release_id;
        $passport = $request->passport;
        $date_release_passport = $request->date_release_passport;
        $date_expired_passport = $request->date_expired_passport;
        $located_release_passport = $request->located_release_passport;
        $note = $request->note;
        $area_id = $request->area_id;
        $branch_id = $request->branch_id;
        $department_id = $request->department_id;
        $accessgroup_id = $request->accessgroup_id;
        $position_id = $request->position_id;
        $bank_name = $request->bank_name;
        $bank_number = $request->bank_number;
        $name_of_bank = $request->name_of_bank;
        $branch_of_bank = $request->branch_of_bank;
        $province_id = $request->province_id;
        $district_id = $request->district_id;
        $acting_chief = $request->acting_chief;
        $current_address = $request->current_address;
        $active = $request->active;
        $idCompany = Session::get('maCongTy');
        $get_image = $request->file('image');
        if($name == '' || $phone == '' || $email == '' || $date_of_birth == '' || 
            $gender == '' || $identity_card == '' || $date_release_id == '' || $located_release_id == '' || $area_id == '' ||
            $branch_id == '' || $department_id == '' || $accessgroup_id == '' || $position_id == '' || $active == '' ||
            $acting_chief == '' || $province_id == '' || $district_id == '' || $current_address == '') {
            Session::flash('failure', 'Các trường không được để trống.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-employees');
        } else if(strlen($name) > 100 || strlen($phone) > 20 || strlen($email) > 100 ||
            strlen($identity_card) > 100 || strlen($passport) > 100 || strlen($bank_name) > 100 || 
            strlen($bank_number) > 100 || strlen($name_of_bank) > 100 || strlen($branch_of_bank) > 100) {
            Session::flash('failure', 'Bạn đã nhập quá ký tự cho phép.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-employees');
        } else if(strlen($name) < 5 || strlen($phone) < 5 || strlen($email) < 5 ||
            strlen($identity_card) < 5 || strlen($bank_name) < 5 || strlen($bank_number) < 5 || 
            strlen($name_of_bank) < 5 || strlen($branch_of_bank) < 5) {
            Session::flash('failure', 'Bạn nhập không đủ ký tự.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-employees');
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            Session::flash("failure", "Email của bạn không hợp lệ.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-employees');
        } else if(!preg_match('/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', $phone,  $matches ) ) {
            Session::flash("failure", "Số điện thoại của bạn không hợp lệ.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/add-employees');
        } else {
            $data['name'] = $name;//
            $data['phone'] = $phone;//
            $data['email'] = $email;//
            $data['date_of_birth'] = date('Y-m-d', strtotime($date_of_birth));//
            $data['gender'] = $gender;//
            $data['display_order'] = $display_order;
            $data['identity_card'] = $identity_card;
            $data['date_release_id'] = date('Y-m-d', strtotime($date_release_id));
            $data['located_release_id'] = $located_release_id;
            $data['passport'] = $passport;
            $data['date_release_passport'] = date('Y-m-d', strtotime($date_release_passport));
            $data['date_expired_passport'] = date('Y-m-d', strtotime($date_expired_passport));
            $data['located_release_passport'] = $located_release_passport;
            $data['idCompany'] = $idCompany;
            $data['note'] = $note;
            $data['area_id'] = $area_id;
            $data['branch_id'] = $branch_id;
            $data['department_id'] = $department_id;
            $data['accessgroup_id'] = $accessgroup_id;
            $data['position_id'] = $position_id;
            $data['active'] = $active;
            $data['acting_chief'] = $acting_chief;
            $data['bank_name'] = $bank_name;
            $data['bank_number'] = $bank_number;
            $data['name_of_bank'] = $name_of_bank;
            $data['branch_of_bank'] = $branch_of_bank;
            $data['province_id'] = $province_id;
            $data['district_id'] = $district_id;
            $data['current_address'] = $current_address;
            $data['created_at'] = Carbon::now();
            if($get_image) {//
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/employees',$new_image);
                // $get_image->move('https://eglobalsoft.000webhostapp.com/Uploads/', $new_image);
                $data['image'] = $new_image;
                DB::table('employees')->insert($data);
                Session::flash('message', 'Thêm nhân viên thành công');
                Session::flash("alert-type", "success");
                return Redirect::to('/admin/list-employees');
            }
            $data['image'] = '';
            DB::table('employees')->insert($data);
            Session::flash('message', 'Thêm nhân viên thành công');
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-employees');
        }
    }

    /**
     * This function to show edit employee page by GET method
     * created by : DatNQ
     * created at : 02/11/2020
     */
    public function edit_employees($id) {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $vung = DB::table('areas')->where('status', 0)->where('company_id', $idCompany)->orderby('id', 'DESC')->get();
        $chiNhanh = DB::table('branches')->where('status', 0)->where('company_id', $idCompany)->orderby('id', 'DESC')->get();
        $phongBan = DB::table('departments')->where('status', 0)->where('company_id', $idCompany)->orderby('id', 'DESC')->get();
        $nhomTruyCap = DB::table('accessgroups')->where('status', 0)->where('company_id', $idCompany)->orderby('id', 'DESC')->get();
        $chucDanh = DB::table('positions')->where('status', 0)->where('company_id', $idCompany)->orderby('id', 'DESC')->get();
        $tinhThanh = DB::table('provinces')->get();
        $quanHuyen = DB::table('districts')->get();
        $nhanVien = DB::table('employees')->where('id', $id)->get();
        return view('admin.employees.edit-employees')->with('vung', $vung)->with('chiNhanh', $chiNhanh)
        ->with('phongBan', $phongBan)->with('nhomTruyCap', $nhomTruyCap)->with('chucDanh', $chucDanh)
        ->with('tinhThanh', $tinhThanh)->with('quanHuyen', $quanHuyen)->with('nhanVien', $nhanVien);
    }

    /**
     * This function to update data employee by POST method
     * created by : DatNQ
     * created at : 02/11/2020
     */
    public function update_employees(Request $request, $id) {
        $this->AuthLogin();
        $data = array();
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $date_of_birth = $request->date_of_birth;
        $gender = $request->gender;
        $display_order = $request->display_order;
        $identity_card = $request->identity_card;
        $date_release_id = $request->date_release_id;
        $located_release_id = $request->located_release_id;
        $passport = $request->passport;
        $date_release_passport = $request->date_release_passport;
        $date_expired_passport = $request->date_expired_passport;
        $located_release_passport = $request->located_release_passport;
        $note = $request->note;
        $area_id = $request->area_id;
        $branch_id = $request->branch_id;
        $department_id = $request->department_id;
        $accessgroup_id = $request->accessgroup_id;
        $position_id = $request->position_id;
        $bank_name = $request->bank_name;
        $bank_number = $request->bank_number;
        $name_of_bank = $request->name_of_bank;
        $branch_of_bank = $request->branch_of_bank;
        $province_id = $request->province_id;
        $district_id = $request->district_id;
        $current_address = $request->current_address;
        $get_image = $request->file('image');
        if($name == '' || $phone == '' || $email == '' || $date_of_birth == '' || $gender == '' || 
            $identity_card == '' || $date_release_id == '' || $located_release_id == '' || $area_id == '' ||
            $branch_id == '' || $department_id == '' || $accessgroup_id == '' || $position_id == '' ||
            $province_id == '' || $district_id == '' || $current_address == '') {
            Session::flash("message", 'Các trường không được để trống.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-employees/'.$id);
        } else if(strlen($name) > 100 || strlen($phone) > 20 || strlen($email) > 100 ||
            strlen($identity_card) > 100 || strlen($passport) > 100 || strlen($bank_name) > 100 || 
            strlen($bank_number) > 100 || strlen($name_of_bank) > 100 || strlen($branch_of_bank) > 100) {
            Session::flash("message", 'Bạn đã nhập quá ký tự cho phép.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-employees/'.$id);
        } else if(strlen($name) < 5 || strlen($phone) < 5 || strlen($email) < 5 ||
            strlen($identity_card) < 5 || strlen($bank_name) < 5 || strlen($bank_number) < 5 || 
            strlen($name_of_bank) < 5 || strlen($branch_of_bank) < 5) {
            Session::flash('message', 'Bạn nhập không đủ ký tự.');
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-employees/'.$id);
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            Session::flash("message", "Email của bạn không hợp lệ.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-employees/'.$id);
        } else if(!preg_match('/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', $phone,  $matches ) ) {
            Session::flash("message", "Số điện thoại của bạn không hợp lệ.");
            Session::flash("alert-type", "warning");
            return Redirect::to('/admin/edit-employees/'.$id);
        } else {
            $data["name"] = $name;
            $data["phone"] = $phone;
            $data["email"] = $email;
            $data["date_of_birth"] = date('Y-m-d', strtotime($date_of_birth));
            $data["gender"] = $gender;
            $data["display_order"] = $display_order;
            $data["identity_card"] = $identity_card;
            $data["date_release_id"] = date('Y-m-d', strtotime($date_release_id));
            $data["located_release_id"] = $located_release_id;
            $data["passport"] = $passport;
            $data["date_release_passport"] = date('Y-m-d', strtotime($date_release_passport));
            $data["date_expired_passport"] = date('Y-m-d', strtotime($date_expired_passport));
            $data["located_release_passport"] = $located_release_passport;
            $data["note"] = $note;
            $data["area_id"] = $area_id;
            $data["branch_id"] = $branch_id;
            $data["department_id"] = $department_id;
            $data["accessgroup_id"] = $accessgroup_id;
            $data["position_id"] = $position_id;
            $data["bank_name"] = $bank_name;
            $data["bank_number"] = $bank_number;
            $data["name_of_bank"] = $name_of_bank;
            $data["branch_of_bank"] = $branch_of_bank;
            $data["province_id"] = $province_id;
            $data["district_id"] = $district_id;
            $data["current_address"] = $current_address;
            $data["updated_at"] = Carbon::now();
            if($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/employees',$new_image);
                // $get_image->move('https://eglobalsoft.000webhostapp.com/Uploads/', $new_image);
                $data['image'] = $new_image;
                Employee::where('id', $id)->update($data);
                Session::flash('message', 'Chỉnh sửa nhân viên thành công');
                Session::flash("alert-type", "success");
                return Redirect::to('/admin/list-employees');
            }
            DB::table('employees')->where('id', $id)->update($data);
            Session::put('message', 'Chỉnh sửa nhân viên thành công');
            Session::flash("alert-type", "success");
            return Redirect::to('/admin/list-employees');
        }
    }
    // 1 đang hoat dong | 0 da nghi 
    public function hide_employees($id) {
        $this->AuthLogin();
        Employee::where('id', $id)->update(['active' => 0]);
        Session::put('message', 'Nhân viên đã nghỉ');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-employees');
    }

    public function show_employees($id) {
        $this->AuthLogin();
        Employee::where('id', $id)->update(['active' => 1]);
        Session::put('message', 'Nhân viên đang hoạt động.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-employees');
    }

    public function renew_permit($id) {
        $this->AuthLogin();
        DB::table('employees')->where('id', $id)->update(['acting_chief' => 1]);
        Session::put('message', 'Tắt quyền thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-employees');
    }

    public function terminate_permit($id) {
        $this->AuthLogin();
        DB::table('employees')->where('id', $id)->update(['acting_chief' => 0]);
        Session::put('message', 'Mở quyền thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-employees');
    }

    public function delete_employees($id) {
        $this->AuthLogin();
        DB::table('employees')->where('ma_nhan_vien', $id)->delete();
        Session::put('message', 'Xóa nhân viên thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-employees');
    }

    public function list_employees_trash() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $dataEmployee = Employee::where('company_id', $idCompany)->where('active', '2')->get();
        $dataArea = DB::table('areas')->get();
        $dataBranch = DB::table('branches')->get();
        $dataDepartment = DB::table('departments')->get();
        $dataPosition = DB::table('positions')->get();
        $dataAccessGroup = DB::table('accessgroups')->get();
        return view('admin.employees.list-employees-trash')->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)
        ->with('dataBranch', $dataBranch)->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataAccessGroup', $dataAccessGroup);
    }

    public function trash_employees($id) {
        $this->AuthLogin();
        Employee::where('id', $id)->update(['active' => 2]);
        Session::put('message', 'Xóa nhân viên.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-employees');
    }

    public function restore_employees($id) {
        $this->AuthLogin();
        Employee::where('ma_nhan_vien', $id)->update(['hoat_dong' => 0]);
        Session::put('message', 'Xóa nhân viên.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-employees');
    }
}