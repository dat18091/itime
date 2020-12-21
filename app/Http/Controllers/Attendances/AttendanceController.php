<?php

namespace App\Http\Controllers\Attendances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Attendance;
use App\Employee;
use App\Area;
use App\Branch;
use App\Department;
use App\Position;
class AttendanceController extends Controller
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
     * This function is used to get list attendances of employees when they are check in
     * from phone
     * created by : DatNQ
     * created at : 27/11/2020 
     */
    public function list_attendances() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $listAttendances = DB::table('attendances')->join('areas', 'areas.id', '=', 'attendances.area_id')
        ->join('employees', 'employees.id', '=', 'attendances.employee_id')
        ->join('companies', 'companies.id', '=', 'attendances.company_id')
        ->select(['attendances.*', 'areas.id as idArea', 'employees.id as idEmployee', 'companies.id as idCompany'])->whereDate('attendances.check_in_time', '=',Carbon::now()->toDateString())
        ->where('attendances.company_id', $idCompany)
        ->whereDate('attendances.check_in_time', '=',Carbon::now()->toDateString())->orderBy('id', 'DESC')->get();
        $dataArea = Area::get();
        $dataEmployee = Employee::get();
        $dataBranch = Branch::get();
        $dataDepartment = Department::get();
        $dataPosition = Position::get();
        return view('admin.attendances.list-attendances')->with('attendances', $listAttendances)
        ->with('dataArea', $dataArea)->with('dataEmployee', $dataEmployee)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition);
        // Attendance::
        // join('employees', 'employees.id', '=', 'attendances.employee_id')->
        // join('areas', 'areas.id', '=', 'attendances.ma_vung')->
        // join('branches', 'branches.id', '=', 'attendances.ma_chi_nhanh')->
        // join('departments', 'departments.ma_phong_ban', '=', 'attendances.ma_phong_ban')->
        // join('positions', 'positions.ma_chuc_danh', '=', 'attendances.ma_chuc_danh')
        // ->whereDate('attendances.check_in_time', '=',Carbon::now()->toDateString())
        // ->where('employees.ma_cong_ty', $maCongTy)->get();
        // return view('admin.attendances.list-attendances')->with('attendances', $listAttendances);
    }

    public function delete_attendances($id) {
        $this->AuthLogin();
        Attendance::where('id', $id)->delete();
        return Redirect::to('/admin/list-attendances'); 
    }

    public function list_attendances_history() {
        $this->AuthLogin();
        $idCompany = Session::get('maCongTy');
        $listAttendances = DB::table('attendances')->where('company_id', $idCompany)->get();
        $dataArea = Area::get();
        $dataEmployee = Employee::get();
        $dataBranch = Branch::get();
        $dataDepartment = Department::get();
        $dataPosition = Position::get();
        return view('admin.attendances.list-attendances-history')->with('attendances', $listAttendances)
        ->with('dataArea', $dataArea)->with('dataEmployee', $dataEmployee)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition);
    }
}