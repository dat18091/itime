<?php

namespace App\Http\Controllers\Attendances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Attendance;

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
        $maCongTy = Session::get('maCongTy');
        $listAttendances = 
        // Attendance::select('a.*','b.*', 'c.*')
        // ->from('attendances as b')
        // ->join('employees as a', 'b.ma_nhan_vien', '=', 'a.ma_nhan_vien')
        // ->join('companies as c', 'b.ma_cong_ty', '=', 'c.ma_cong_ty')
		// ->get();
        Attendance::
        join('employees', 'employees.ma_nhan_vien', '=', 'attendances.ma_nhan_vien')->
        join('areas', 'areas.ma_vung', '=', 'attendances.ma_vung')->
        join('branches', 'branches.ma_chi_nhanh', '=', 'attendances.ma_chi_nhanh')->
        join('departments', 'departments.ma_phong_ban', '=', 'attendances.ma_phong_ban')->
        join('positions', 'positions.ma_chuc_danh', '=', 'attendances.ma_chuc_danh')
        ->whereDate('attendances.check_in_time', '=',Carbon::now()->toDateString())
        ->where('employees.ma_cong_ty', $maCongTy)->get();
        return view('admin.attendances.list-attendances')->with('attendances', $listAttendances);
    }

    public function delete_attendances($id) {
        $this->AuthLogin();
        Attendance::where('id', $id)->delete();
        return Redirect::to('/admin/list-attendances'); 
    }

    public function list_attendances_history() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $listAttendances = 
        // Attendance::select('a.*','b.*', 'c.*')
        // ->from('attendances as b')
        // ->join('employees as a', 'b.ma_nhan_vien', '=', 'a.ma_nhan_vien')
        // ->join('companies as c', 'b.ma_cong_ty', '=', 'c.ma_cong_ty')
		// ->get();
        Attendance::
        join('employees', 'employees.ma_nhan_vien', '=', 'attendances.ma_nhan_vien')->
        join('areas', 'areas.ma_vung', '=', 'attendances.ma_vung')->
        join('branches', 'branches.ma_chi_nhanh', '=', 'attendances.ma_chi_nhanh')->
        join('departments', 'departments.ma_phong_ban', '=', 'attendances.ma_phong_ban')->
        join('positions', 'positions.ma_chuc_danh', '=', 'attendances.ma_chuc_danh')
        ->where('employees.ma_cong_ty', $maCongTy)->get();
        return view('admin.attendances.list-attendances-history')->with('attendances', $listAttendances);
    }
}
