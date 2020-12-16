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
        // ->join('branches', 'employees.branch_id' , '=', 'branches.id')
        // ->join('departments', 'employees.department_id' , '=', 'departments.id')
        // ->join('positions', 'employees.position_id', '=', 'positions.id')
        // ->join('accessgroups', 'employees.accessgroup_id', '=', 'accessgroups.id')
        // ->join('companies', 'employees.company_id', '=', 'companies.id')
        // ->select(['employees.*', 'areas.id as idArea', 'branches.id AS idBranch', 'departments.id AS idDepartment', 
        // 'companies.id AS idCompany', 'positions.id AS idPosition', 'accessgroups.id as idAccessGroup'])
        // ->where('employees.active', '1')->orWhere('employees.active', '0')->where('employees.company_id', $idCompany)->get();
        // $dataArea = DB::table('areas')->get();
        // $dataBranch = DB::table('branches')->get();
        // $dataDepartment = DB::table('departments')->get();
        // $dataPosition = DB::table('positions')->get();
        // $dataAccessGroup = DB::table('accessgroups')->get();
        // return view('admin.employees.list-employees')->with('dataEmployee', $dataEmployee)->with('dataArea', $dataArea)
        // ->with('dataBranch', $dataBranch)->with('dataDepartment', $dataDepartment)->with('dataPosition', $dataPosition)->with('dataAccessGroup', $dataAccessGroup);
    }

    /**
     * This function to show add employee page by GET method
     * created by : DatNQ
     * created at : 02/11/2020
     */
    public function add_employees() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $vung = DB::table('areas')->where('trang_thai_vung', 0)->where('ma_cong_ty', $maCongTy)->orderby('ma_vung', 'DESC')->get();
        $chiNhanh = DB::table('branches')->where('trang_thai_chi_nhanh', 0)->where('ma_cong_ty', $maCongTy)->orderby('ma_chi_nhanh', 'DESC')->get();
        $phongBan = DB::table('departments')->where('trang_thai_phong_ban', 0)->where('ma_cong_ty', $maCongTy)->orderby('ma_phong_ban', 'DESC')->get();
        $nhomTruyCap = DB::table('accessgroups')->where('trang_thai_nhom_truy_cap', 0)->where('ma_cong_ty', $maCongTy)->orderby('ma_nhom_truy_cap', 'DESC')->get();
        $chucDanh = DB::table('positions')->where('trang_thai_chuc_danh', 0)->where('ma_cong_ty', $maCongTy)->orderby('ma_chuc_Danh', 'DESC')->get();
        $tinhThanh = DB::table('provinces')->get();
        $quanHuyen = DB::table('districts')->get();
        return view('admin.employees.add-employees')->with('vung', $vung)->with('chiNhanh', $chiNhanh)
        ->with('phongBan', $phongBan)->with('nhomTruyCap', $nhomTruyCap)->with('chucDanh', $chucDanh)
        ->with('tinhThanh', $tinhThanh)->with('quanHuyen', $quanHuyen);
    }

    /**
     * This function to save data employee by POST method
     * created by : DatNQ
     * created at : 02/11/2020
     */
    public function save_employees(Request $request) {
        $this->AuthLogin();
        $data = array();
        $tenNhanVien = $request->ten_nhan_vien;
        $soDienThoaiNhanVien = $request->so_dien_thoai_nhan_vien;
        $emailNhanVien = $request->email_nhan_vien;
        $ngaySinhNhanVien = $request->ngay_sinh_nhan_vien;
        $gioiTinhNhanVien = $request->gioi_tinh_nhan_vien;
        $thuTuHienThiNV = $request->thu_tu_hien_thi_nv;
        $soCMND = $request->so_cmnd;
        $ngayCapCMND = $request->ngay_cap_cmnd;
        $noiCapCMND = $request->noi_cap_cmnd;
        $soHoChieu = $request->so_ho_chieu;
        $ngayCapHoChieu = $request->ngay_cap_ho_chieu;
        $ngayHetHanHoChieu = $request->ngay_het_han_ho_chieu;
        $noiCapHoChieu = $request->noi_cap_ho_chieu;
        $maCongTy = Session::get('maCongTy');
        $ghiChuNhanVien = $request->ghi_chu_nhan_vien;
        $maVung = $request->ma_vung;
        $maChiNhanh = $request->ma_chi_nhanh;
        $maPhongBan = $request->ma_phong_ban;
        $maNhomTruyCap = $request->ma_nhom_truy_cap;
        $maChucDanh = $request->ma_chuc_danh;
        $hoatDong = $request->hoat_dong;
        $quyenTruongPhong = $request->quyen_truong_phong;
        $chuTaiKhoanNganHang = $request->chu_tai_khoan_ngan_hang;
        $soTaiKhoanNganHang = $request->so_tai_khoan_ngan_hang;
        $tenNganHang = $request->ten_ngan_hang;
        $chiNhanhNganHang = $request->chi_nhanh_ngan_hang;
        $tinhThanh = $request->province_id;
        $quanHuyen = $request->district_id;
        $diaChiHienTai = $request->dia_chi_hien_tai;
        $get_image = $request->file('hinh_anh_nhan_vien');
        if($tenNhanVien == '' || $soDienThoaiNhanVien == '' || $emailNhanVien == '' || $ngaySinhNhanVien == '' || 
            $gioiTinhNhanVien == '' || $soCMND == '' || $ngayCapCMND == '' || $noiCapCMND == '' || $maVung == '' ||
            $maChiNhanh == '' || $maPhongBan == '' || $maNhomTruyCap == '' || $maChucDanh == '' || $hoatDong == '' ||
            $quyenTruongPhong == '' || $tinhThanh == '' || $quanHuyen == '' || $diaChiHienTai == '') {
            Session::flash('failure', 'Các trường không được để trống.');
            return Redirect::to('/admin/add-employees');
        } else if(strlen($tenNhanVien) > 100 || strlen($soDienThoaiNhanVien) > 20 || strlen($emailNhanVien) > 100 ||
            strlen($soCMND) > 100 || strlen($soHoChieu) > 100 || strlen($chuTaiKhoanNganHang) > 100 || 
            strlen($soTaiKhoanNganHang) > 100 || strlen($tenNganHang) > 100 || strlen($chiNhanhNganHang) > 100) {
            Session::flash('failure', 'Bạn đã nhập quá ký tự cho phép.');
            return Redirect::to('/admin/add-employees');
        } else if(strlen($tenNhanVien) < 5 || strlen($soDienThoaiNhanVien) < 5 || strlen($emailNhanVien) < 5 ||
            strlen($soCMND) < 5 || strlen($chuTaiKhoanNganHang) < 5 || strlen($soTaiKhoanNganHang) < 5 || 
            strlen($tenNganHang) < 5 || strlen($chiNhanhNganHang) < 5) {
            Session::flash('failure', 'Bạn nhập không đủ ký tự.');
            return Redirect::to('/admin/add-employees');
        } else if(!filter_var($emailNhanVien, FILTER_VALIDATE_EMAIL)) { 
            Session::flash("failure", "Email của bạn không hợp lệ.");
            return Redirect::to('/admin/add-employees');
        } else if(!preg_match('/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', $soDienThoaiNhanVien,  $matches ) ) {
            Session::flash("failure", "Số điện thoại của bạn không hợp lệ.");
            return Redirect::to('/admin/add-employees');
        } else {
            $data['ten_nhan_vien'] = $tenNhanVien;//
            $data['so_dien_thoai_nhan_vien'] = $soDienThoaiNhanVien;//
            $data['email_nhan_vien'] = $emailNhanVien;//
            $data['ngay_sinh_nhan_vien'] = date('Y-m-d', strtotime($ngaySinhNhanVien));//
            $data['gioi_tinh_nhan_vien'] = $gioiTinhNhanVien;//
            $data['thu_tu_hien_thi_nv'] = $thuTuHienThiNV;
            $data['so_cmnd'] = $soCMND;
            $data['ngay_cap_cmnd'] = date('Y-m-d', strtotime($ngayCapCMND));
            $data['noi_cap_cmnd'] = $noiCapCMND;
            $data['so_ho_chieu'] = $soHoChieu;
            $data['ngay_cap_ho_chieu'] = date('Y-m-d', strtotime($ngayCapHoChieu));
            $data['ngay_het_han_ho_chieu'] = date('Y-m-d', strtotime($ngayHetHanHoChieu));
            $data['noi_cap_ho_chieu'] = $noiCapHoChieu;
            $data['ma_cong_ty'] = $maCongTy;
            $data['ghi_chu_nhan_vien'] = $ghiChuNhanVien;
            $data['ma_vung'] = $maVung;
            $data['ma_chi_nhanh'] = $maChiNhanh;
            $data['ma_phong_ban'] = $maPhongBan;
            $data['ma_nhom_truy_cap'] = $maNhomTruyCap;
            $data['ma_chuc_danh'] = $maChucDanh;
            $data['hoat_dong'] = $hoatDong;
            $data['quyen_truong_phong'] = $quyenTruongPhong;
            $data['chu_tai_khoan_ngan_hang'] = $chuTaiKhoanNganHang;
            $data['so_tai_khoan_ngan_hang'] = $soTaiKhoanNganHang;
            $data['ten_ngan_hang'] = $tenNganHang;
            $data['chi_nhanh_ngan_hang'] = $chiNhanhNganHang;
            $data['province_id'] = $tinhThanh;
            $data['district_id'] = $quanHuyen;
            $data['dia_chi_hien_tai'] = $diaChiHienTai;
            $data['created_at'] = Carbon::now();
            if($get_image) {//
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/employees',$new_image);
                // $get_image->move('https://eglobalsoft.000webhostapp.com/Uploads/', $new_image);
                $data['hinh_anh_nhan_vien'] = $new_image;
                DB::table('employees')->insert($data);
                Session::flash('message', 'Thêm nhân viên thành công');
                return Redirect::to('/admin/list-employees');
            }
            $data['hinh_anh_nhan_vien'] = '';
            DB::table('employees')->insert($data);
            Session::flash('message', 'Thêm nhân viên thành công');
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
        $tenNhanVien = $request->ten_nhan_vien;
        $soDienThoaiNhanVien = $request->so_dien_thoai_nhan_vien;
        $emailNhanVien = $request->email_nhan_vien;
        $ngaySinhNhanVien = $request->ngay_sinh_nhan_vien;
        $gioiTinhNhanVien = $request->gioi_tinh_nhan_vien;
        $thuTuHienThiNV = $request->thu_tu_hien_thi_nv;
        $soCMND = $request->so_cmnd;
        $ngayCapCMND = $request->ngay_cap_cmnd;
        $noiCapCMND = $request->noi_cap_cmnd;
        $soHoChieu = $request->so_ho_chieu;
        $ngayCapHoChieu = $request->ngay_cap_ho_chieu;
        $ngayHetHanHoChieu = $request->ngay_het_han_ho_chieu;
        $noiCapHoChieu = $request->noi_cap_ho_chieu;
        $ghiChuNhanVien = $request->ghi_chu_nhan_vien;
        $maVung = $request->ma_vung;
        $maChiNhanh = $request->ma_chi_nhanh;
        $maPhongBan = $request->ma_phong_ban;
        $maNhomTruyCap = $request->ma_nhom_truy_cap;
        $maChucDanh = $request->ma_chuc_danh;
        $chuTaiKhoanNganHang = $request->chu_tai_khoan_ngan_hang;
        $soTaiKhoanNganHang = $request->so_tai_khoan_ngan_hang;
        $tenNganHang = $request->ten_ngan_hang;
        $chiNhanhNganHang = $request->chi_nhanh_ngan_hang;
        $tinhThanh = $request->province_id;
        $quanHuyen = $request->district_id;
        $diaChiHienTai = $request->dia_chi_hien_tai;
        $get_image = $request->file('hinh_anh_nhan_vien');
        if($tenNhanVien == '' || $soDienThoaiNhanVien == '' || $emailNhanVien == '' || $ngaySinhNhanVien == '' || 
            $gioiTinhNhanVien == '' || $soCMND == '' || $ngayCapCMND == '' || $noiCapCMND == '' || $maVung == '' ||
            $maChiNhanh == '' || $maPhongBan == '' || $maNhomTruyCap == '' || $maChucDanh == '' ||
            $tinhThanh == '' || $quanHuyen == '' || $diaChiHienTai == '') {
            Session::flash("message", 'Các trường không được để trống.');
            return Redirect::to('/admin/edit-employees/'.$id);
        } else if(strlen($tenNhanVien) > 100 || strlen($soDienThoaiNhanVien) > 20 || strlen($emailNhanVien) > 100 ||
            strlen($soCMND) > 100 || strlen($soHoChieu) > 100 || strlen($chuTaiKhoanNganHang) > 100 || 
            strlen($soTaiKhoanNganHang) > 100 || strlen($tenNganHang) > 100 || strlen($chiNhanhNganHang) > 100) {
            Session::flash("message", 'Bạn đã nhập quá ký tự cho phép.');
            return Redirect::to('/admin/edit-employees/'.$id);
        } else if(strlen($tenNhanVien) < 5 || strlen($soDienThoaiNhanVien) < 5 || strlen($emailNhanVien) < 5 ||
            strlen($soCMND) < 5 || strlen($chuTaiKhoanNganHang) < 5 || strlen($soTaiKhoanNganHang) < 5 || 
            strlen($tenNganHang) < 5 || strlen($chiNhanhNganHang) < 5) {
            Session::flash('message', 'Bạn nhập không đủ ký tự.');
            return Redirect::to('/admin/edit-employees/'.$id);
        } else if(!filter_var($emailNhanVien, FILTER_VALIDATE_EMAIL)) { 
            Session::flash("message", "Email của bạn không hợp lệ.");
            return Redirect::to('/admin/edit-employees/'.$id);
        } else if(!preg_match('/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', $soDienThoaiNhanVien,  $matches ) ) {
            Session::flash("message", "Số điện thoại của bạn không hợp lệ.");
            return Redirect::to('/admin/edit-employees/'.$id);
        } else {
            $data["ten_nhan_vien"] = $tenNhanVien;
            $data["so_dien_thoai_nhan_vien"] = $soDienThoaiNhanVien;
            $data["email_nhan_vien"] = $emailNhanVien;
            $data["ngay_sinh_nhan_vien"] = date('Y-m-d', strtotime($ngaySinhNhanVien));
            $data["gioi_tinh_nhan_vien"] = $gioiTinhNhanVien;
            $data["thu_tu_hien_thi_nv"] = $thuTuHienThiNV;
            $data["so_cmnd"] = $soCMND;
            $data["ngay_cap_cmnd"] = date('Y-m-d', strtotime($ngayCapCMND));
            $data["noi_cap_cmnd"] = $noiCapCMND;
            $data["so_ho_chieu"] = $soHoChieu;
            $data["ngay_cap_ho_chieu"] = date('Y-m-d', strtotime($ngayCapHoChieu));
            $data["ngay_het_han_ho_chieu"] = date('Y-m-d', strtotime($ngayHetHanHoChieu));
            $data["noi_cap_ho_chieu"] = $noiCapHoChieu;
            $data["ghi_chu_nhan_vien"] = $ghiChuNhanVien;
            $data["ma_vung"] = $maVung;
            $data["ma_chi_nhanh"] = $maChiNhanh;
            $data["ma_phong_ban"] = $maPhongBan;
            $data["ma_nhom_truy_cap"] = $maNhomTruyCap;
            $data["ma_chuc_danh"] = $maChucDanh;
            $data["chu_tai_khoan_ngan_hang"] = $chuTaiKhoanNganHang;
            $data["so_tai_khoan_ngan_hang"] = $soTaiKhoanNganHang;
            $data["ten_ngan_hang"] = $tenNganHang;
            $data["chi_nhanh_ngan_hang"] = $chiNhanhNganHang;
            $data["province_id"] = $tinhThanh;
            $data["district_id"] = $quanHuyen;
            $data["dia_chi_hien_tai"] = $diaChiHienTai;
            $data["updated_at"] = Carbon::now();
            if($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/employees',$new_image);
                // $get_image->move('https://eglobalsoft.000webhostapp.com/Uploads/', $new_image);
                $data['hinh_anh_nhan_vien'] = $new_image;
                DB::table('employees')->where('ma_nhan_vien', $id)->update($data);
                Session::flash('message', 'Chỉnh sửa nhân viên thành công');
                return Redirect::to('/admin/list-employees');
            }
            DB::table('employees')->where('ma_nhan_vien', $id)->update($data);
            Session::put('message', 'Chỉnh sửa nhân viên thành công');
            return Redirect::to('/admin/list-employees');
        }
    }
    // 1 đang hoat dong | 0 da nghi 
    public function hide_employees($id) {
        $this->AuthLogin();
        DB::table('employees')->where('ma_nhan_vien', $id)->update(['hoat_dong' => 0]);
        Session::put('message', 'Nhân viên đang hoạt động.');
        return Redirect::to('/admin/list-employees');
    }

    public function show_employees($id) {
        $this->AuthLogin();
        DB::table('employees')->where('ma_nhan_vien', $id)->update(['hoat_dong' => 1]);
        Session::put('message', 'Nhân viên đã nghỉ.');
        return Redirect::to('/admin/list-employees');
    }

    public function renew_permit($id) {
        $this->AuthLogin();
        DB::table('employees')->where('ma_nhan_vien', $id)->update(['quyen_truong_phong' => 1]);
        Session::put('message', 'Tắt quyền thành công.');
        return Redirect::to('/admin/list-employees');
    }

    public function terminate_permit($id) {
        $this->AuthLogin();
        DB::table('employees')->where('ma_nhan_vien', $id)->update(['quyen_truong_phong' => 0]);
        Session::put('message', 'Mở quyền thành công.');
        return Redirect::to('/admin/list-employees');
    }

    public function delete_employees($id) {
        $this->AuthLogin();
        DB::table('employees')->where('ma_nhan_vien', $id)->delete();
        Session::put('message', 'Xóa nhân viên thành công.');
        return Redirect::to('/admin/list-employees');
    }

    public function list_employees_trash() {
        $this->AuthLogin();
        $maCongTy = Session::get('maCongTy');
        $danhSach = DB::table('employees')
        ->where('ma_cong_ty', $maCongTy)->where('hoat_dong', '2')->get();
        $vung = DB::table('areas')->get();
        $chiNhanh = DB::table('branches')->get();
        $phongBan = DB::table('departments')->get();
        $chucDanh = DB::table('positions')->get();
        $nhomTruyCap = DB::table('accessgroups')->get();
        return view('admin.employees.list-employees-trash')->with('nhanVien', $danhSach)->with('vung', $vung)
        ->with('chiNhanh', $chiNhanh)->with('phongBan', $phongBan)->with('chucDanh', $chucDanh)->with('nhomTruyCap', $nhomTruyCap);
    }

    public function trash_employees($id) {
        $this->AuthLogin();
        DB::table('employees')->where('ma_nhan_vien', $id)->update(['hoat_dong' => 2]);
        Session::put('message', 'Xóa nhân viên.');
        return Redirect::to('/admin/list-employees');
    }

    public function restore_employees($id) {
        $this->AuthLogin();
        DB::table('employees')->where('ma_nhan_vien', $id)->update(['hoat_dong' => 0]);
        Session::put('message', 'Xóa nhân viên.');
        return Redirect::to('/admin/list-employees');
    }
}