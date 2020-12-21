<?php

namespace App\Http\Controllers\Requirements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Takeleave;
use App\Employee;
use App\Area;
use App\Belate;
use App\Branch;
use App\Department;
use App\Position;
use App\Company;
use App\Leavesoon;

class RequirementController extends Controller
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
    #----------------------------------------------TAKE LEAVE
    public function list_requirements_takeleave() {
        $this->AuthLogin();
        $data = Takeleave::join('employees', 'employees.id', '=', 'takeleaves.employee_id')
        ->join('companies', 'companies.id', '=', 'takeleaves.company_id')
        ->join('areas', 'areas.id', '=', 'takeleaves.area_id')
        ->join('branches', 'branches.id', '=', 'takeleaves.branch_id')
        ->join('departments', 'departments.id', '=', 'takeleaves.department_id')
        ->join('positions', 'positions.id', '=', 'takeleaves.position_id')
        ->select(['takeleaves.*','employees.id as idEmployee', 'companies.id as idCompany', 'areas.id as idArea',
        'branches.id as idBranch', 'departments.id as idDepartment', 'positions.id as idPosition'])
        ->where('takeleaves.status', '=', '0')->get();
        $dataEmployee = Employee::get();
        $dataArea = Area::get();
        $dataEmployee = Employee::get();
        $dataBranch = Branch::get();
        $dataDepartment = Department::get();
        $dataPosition = Position::get();
        $dataCompany = Company::get();
        $dateTakeLeaveType = DB::table('datetakeleavetypes')->get();
        $dataTakeLeaveType = DB::table('takeleavetypes')->get();
        $dataShift = DB::table('shifts')->get();
        $dataTakeLeaveReason = DB::table('takeleavereasons')->get();
        $countList = Takeleave::where('status', '0')->count();
        $countApprove = Takeleave::where('status', '1')->count();
        $countDenied = Takeleave::where('status', '2')->count();
        $countDelete = Takeleave::where('status', '3')->count();
        return view('admin.requirements.list-requirements-takeleave')->with('data', $data)
        ->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataCompany', $dataCompany)
        ->with('dateTakeLeaveType', $dateTakeLeaveType)->with('dataTakeLeaveType', $dataTakeLeaveType)
        ->with('dataShift', $dataShift)->with('dataTakeLeaveReason', $dataTakeLeaveReason)
        ->with('countList', $countList)->with('countApprove', $countApprove)->with('countDenied', $countDenied)
        ->with('countDelete', $countDelete);
    }

    public function approve_takeleave($id) {
        $this->AuthLogin();
        Takeleave::where('id', $id)->update(['status' => 1]);
        Session::flash('message', 'Duyệt yêu cầu thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-requirements-takeleave');
    }

    public function list_requirements_takeleave_approve() {
        $this->AuthLogin();
        $data = Takeleave::join('employees', 'employees.id', '=', 'takeleaves.employee_id')
        ->join('companies', 'companies.id', '=', 'takeleaves.company_id')
        ->join('areas', 'areas.id', '=', 'takeleaves.area_id')
        ->join('branches', 'branches.id', '=', 'takeleaves.branch_id')
        ->join('departments', 'departments.id', '=', 'takeleaves.department_id')
        ->join('positions', 'positions.id', '=', 'takeleaves.position_id')
        ->select(['takeleaves.*','employees.id as idEmployee', 'companies.id as idCompany', 'areas.id as idArea',
        'branches.id as idBranch', 'departments.id as idDepartment', 'positions.id as idPosition'])
        ->where('takeleaves.status', '=', '1')->get();
        $dataEmployee = Employee::get();
        $dataArea = Area::get();
        $dataEmployee = Employee::get();
        $dataBranch = Branch::get();
        $dataDepartment = Department::get();
        $dataPosition = Position::get();
        $dataCompany = Company::get();
        $dateTakeLeaveType = DB::table('datetakeleavetypes')->get();
        $dataTakeLeaveType = DB::table('takeleavetypes')->get();
        $dataShift = DB::table('shifts')->get();
        $dataTakeLeaveReason = DB::table('takeleavereasons')->get();
        $countList = Takeleave::where('status', '0')->count();
        $countApprove = Takeleave::where('status', '1')->count();
        $countDenied = Takeleave::where('status', '2')->count();
        $countDelete = Takeleave::where('status', '3')->count();
        return view('admin.requirements.list-requirements-takeleave-approve')->with('data', $data)
        ->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataCompany', $dataCompany)
        ->with('dateTakeLeaveType', $dateTakeLeaveType)->with('dataTakeLeaveType', $dataTakeLeaveType)
        ->with('dataShift', $dataShift)->with('dataTakeLeaveReason', $dataTakeLeaveReason)->with('countList', $countList)
        ->with('countApprove', $countApprove)->with('countDenied', $countDenied)->with('countDelete', $countDelete);
    }

    public function denied_takeleave($id) {
        $this->AuthLogin();
        Takeleave::where('id', $id)->update(['status' => 2]);
        Session::flash('message', 'Từ chối yêu cầu thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-requirements-takeleave');
    }

    
    public function list_requirements_takeleave_denied() {
        $this->AuthLogin();
        $data = Takeleave::join('employees', 'employees.id', '=', 'takeleaves.employee_id')
        ->join('companies', 'companies.id', '=', 'takeleaves.company_id')
        ->join('areas', 'areas.id', '=', 'takeleaves.area_id')
        ->join('branches', 'branches.id', '=', 'takeleaves.branch_id')
        ->join('departments', 'departments.id', '=', 'takeleaves.department_id')
        ->join('positions', 'positions.id', '=', 'takeleaves.position_id')
        ->select(['takeleaves.*','employees.id as idEmployee', 'companies.id as idCompany', 'areas.id as idArea',
        'branches.id as idBranch', 'departments.id as idDepartment', 'positions.id as idPosition'])
        ->where('takeleaves.status', '=', '2')->get();
        $dataEmployee = Employee::get();
        $dataArea = Area::get();
        $dataEmployee = Employee::get();
        $dataBranch = Branch::get();
        $dataDepartment = Department::get();
        $dataPosition = Position::get();
        $dataCompany = Company::get();
        $dateTakeLeaveType = DB::table('datetakeleavetypes')->get();
        $dataTakeLeaveType = DB::table('takeleavetypes')->get();
        $dataShift = DB::table('shifts')->get();
        $dataTakeLeaveReason = DB::table('takeleavereasons')->get();
        $countList = Takeleave::where('status', '0')->count();
        $countApprove = Takeleave::where('status', '1')->count();
        $countDenied = Takeleave::where('status', '2')->count();
        $countDelete = Takeleave::where('status', '3')->count();
        return view('admin.requirements.list-requirements-takeleave-denied')->with('data', $data)
        ->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataCompany', $dataCompany)
        ->with('dateTakeLeaveType', $dateTakeLeaveType)->with('dataTakeLeaveType', $dataTakeLeaveType)
        ->with('dataShift', $dataShift)->with('dataTakeLeaveReason', $dataTakeLeaveReason)
        ->with('countList', $countList)->with('countApprove', $countApprove)->with('countDenied', $countDenied)
        ->with('countDelete', $countDelete);
    }

    public function trash_takeleave($id) {
        $this->AuthLogin();
        Takeleave::where('id', $id)->update(['status' => 3]);
        Session::flash('message', 'Xóa yêu cầu thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-requirements-takeleave');
    }

    public function list_requirements_takeleave_trash() {
        $this->AuthLogin();
        $data = Takeleave::join('employees', 'employees.id', '=', 'takeleaves.employee_id')
        ->join('companies', 'companies.id', '=', 'takeleaves.company_id')
        ->join('areas', 'areas.id', '=', 'takeleaves.area_id')
        ->join('branches', 'branches.id', '=', 'takeleaves.branch_id')
        ->join('departments', 'departments.id', '=', 'takeleaves.department_id')
        ->join('positions', 'positions.id', '=', 'takeleaves.position_id')
        ->select(['takeleaves.*','employees.id as idEmployee', 'companies.id as idCompany', 'areas.id as idArea',
        'branches.id as idBranch', 'departments.id as idDepartment', 'positions.id as idPosition'])
        ->where('takeleaves.status', '=', '3')->get();
        $dataEmployee = Employee::get();
        $dataArea = Area::get();
        $dataEmployee = Employee::get();
        $dataBranch = Branch::get();
        $dataDepartment = Department::get();
        $dataPosition = Position::get();
        $dataCompany = Company::get();
        $dateTakeLeaveType = DB::table('datetakeleavetypes')->get();
        $dataTakeLeaveType = DB::table('takeleavetypes')->get();
        $dataShift = DB::table('shifts')->get();
        $dataTakeLeaveReason = DB::table('takeleavereasons')->get();
        $countList = Takeleave::where('status', '0')->count();
        $countApprove = Takeleave::where('status', '1')->count();
        $countDenied = Takeleave::where('status', '2')->count();
        $countDelete = Takeleave::where('status', '3')->count();
        return view('admin.requirements.list-requirements-takeleave-trash')->with('data', $data)
        ->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataCompany', $dataCompany)
        ->with('dateTakeLeaveType', $dateTakeLeaveType)->with('dataTakeLeaveType', $dataTakeLeaveType)
        ->with('dataShift', $dataShift)->with('dataTakeLeaveReason', $dataTakeLeaveReason)
        ->with('countList', $countList)->with('countApprove', $countApprove)->with('countDenied', $countDenied)
        ->with('countDelete', $countDelete);
    }

    #----------------------------------------------LEAVE SOON
    public function list_requirements_soon() {
        $this->AuthLogin();
        $data = Leavesoon::join('employees', 'employees.id', '=', 'leavesoons.employee_id')
        ->join('companies', 'companies.id', '=', 'leavesoons.company_id')
        ->join('areas', 'areas.id', '=', 'leavesoons.area_id')
        ->join('branches', 'branches.id', '=', 'leavesoons.branch_id')
        ->join('departments', 'departments.id', '=', 'leavesoons.department_id')
        ->join('positions', 'positions.id', '=', 'leavesoons.position_id')
        ->select(['leavesoons.*','employees.id as idEmployee', 'companies.id as idCompany', 'areas.id as idArea',
        'branches.id as idBranch', 'departments.id as idDepartment', 'positions.id as idPosition'])
        ->where('leavesoons.status', '=', '0')->get();
        $dataEmployee = Employee::get();
        $dataArea = Area::get();
        $dataEmployee = Employee::get();
        $dataBranch = Branch::get();
        $dataDepartment = Department::get();
        $dataPosition = Position::get();
        $dataCompany = Company::get();
        $dataShift = DB::table('shifts')->get();
        $dataLeaveSoonReason = DB::table('leavesoonreasons')->get();
        $countList = Leavesoon::where('status', '0')->count();
        $countApprove = Leavesoon::where('status', '1')->count();
        $countDenied = Leavesoon::where('status', '2')->count();
        $countDelete = Leavesoon::where('status', '3')->count();
        return view('admin.requirements.list-requirements-soon')->with('data', $data)
        ->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataCompany', $dataCompany)
        ->with('dataShift', $dataShift)->with('dataLeaveSoonReason', $dataLeaveSoonReason)
        ->with('countList', $countList)->with('countApprove', $countApprove)->with('countDenied', $countDenied)
        ->with('countDelete', $countDelete);
    }

    public function approve_soon($id) {
        $this->AuthLogin();
        Takeleave::where('id', $id)->update(['status' => 1]);
        Session::flash('message', 'Duyệt yêu cầu thành công.');
        Session::flash("alert-type", "success");
        return Redirect::to('/admin/list-requirements-soon');
    }

    #----------------------------------------------BE LATE
    public function list_requirements_late() {
        $this->AuthLogin();
        $data = Belate::join('employees', 'employees.id', '=', 'belates.employee_id')
        ->join('companies', 'companies.id', '=', 'belates.company_id')
        ->join('areas', 'areas.id', '=', 'belates.area_id')
        ->join('branches', 'branches.id', '=', 'belates.branch_id')
        ->join('departments', 'departments.id', '=', 'belates.department_id')
        ->join('positions', 'positions.id', '=', 'belates.position_id')
        ->select(['belates.*','employees.id as idEmployee', 'companies.id as idCompany', 'areas.id as idArea',
        'branches.id as idBranch', 'departments.id as idDepartment', 'positions.id as idPosition'])->get();
        $dataEmployee = Employee::get();
        $dataArea = Area::get();
        $dataEmployee = Employee::get();
        $dataBranch = Branch::get();
        $dataDepartment = Department::get();
        $dataPosition = Position::get();
        $dataCompany = Company::get();
        $dataShift = DB::table('shifts')->get();
        $dataBeLateReason = DB::table('belatereasons')->get();
        return view('admin.requirements.list-requirements-late')->with('data', $data)
        ->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)->with('dataBranch', $dataBranch)
        ->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataCompany', $dataCompany)
        ->with('dataShift', $dataShift)->with('dataBeLateReason', $dataBeLateReason);
    }
}
