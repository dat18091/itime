@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Danh sách chi nhánh</title>
@stop
@section('css')
<?php

use Illuminate\Support\Facades\Session;
?>
<!--Data Tables -->
<link href="{{asset('public/backend/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/backend/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
@stop
<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">DANH SÁCH CHI NHÁNH</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">CÀI ĐẶT HỆ THỐNG</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi Nhánh</li>
            </ol>
        </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Setting</button>
                <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <div class="dropdown-menu">
                    <a href="javaScript:void();" class="dropdown-item">Action</a>
                    <a href="javaScript:void();" class="dropdown-item">Another action</a>
                    <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb-->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="action-button" style="display:flex;">
                        <div><a href="" data-toggle="modal" data-target="#themChiNhanh" data-whatever="@mdo" class="btn btn-success space">Tạo mới</a></div>
                        <div><a href="{{URL::to('/admin/list-branches-trash')}}" class="btn btn-primary space">Thùng rác</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên chi nhánh</th>
                                    <th>Trạng thái</th>
                                    <th>Địa chỉ</th>
                                    <th>Tên vùng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chiNhanh as $key => $branch)
                                <tr>
                                    <td>{{$branch->ten_chi_nhanh}}</td>
                                    <td>
                                        <?php
                                        if ($branch->trang_thai_chi_nhanh == 0) {
                                        ?>
                                            <a href="{{URL::to('/admin/hide-branches/'.$branch->ma_chi_nhanh)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/admin/show-branches/'.$branch->ma_chi_nhanh)}}"><span class="fa-styling fa fa-thumbs-down"></span></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{substr($branch->dia_chi_chi_nhanh, 0, 20)."..."}}</td>
                                    <td>
                                        @foreach($vung as $key => $area)
                                        @if($branch->ma_vung == $area->ma_vung)
                                        {{$area->ten_vung}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="{{URL::to('/admin/edit-branches/'.$branch->ma_chi_nhanh)}}" class="btn btn-success waves-effect waves-light">Sửa</a>
                                            <a type="button" href="{{URL::to('/admin/trash-branches/'.$branch->ma_chi_nhanh)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa chi nhánh này?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tên chi nhánh</th>
                                    <th>Trạng thái</th>
                                    <th>Địa chỉ</th>
                                    <th>Tên vùng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Row-->
    <!-- ADD BRANCHES -->
    <div class="modal fade bd-example-modal-lg" id="themChiNhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Chi Nhánh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="signupForm" method="post" action="{{URL::to('/admin/save-branches')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Tên chi nhánh <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="ten_chi_nhanh" name="ten_chi_nhanh" onkeyup="changeToKeyword();">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Từ khóa <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control" id="tu_khoa_chi_nhanh" name="tu_khoa_chi_nhanh">
                            </div>
                        </div>
                        <script type="text/javascript">
                            function changeToKeyword() {
                                var tenChucDanh, tuKhoa;

                                //Lấy text từ thẻ input categoryName 
                                tenChucDanh = document.getElementById("ten_chi_nhanh").value;

                                //Đổi chữ hoa thành chữ thường
                                tuKhoa = tenChucDanh.toLowerCase();

                                //Đổi ký tự có dấu thành không dấu
                                tuKhoa = tuKhoa.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                                tuKhoa = tuKhoa.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                                tuKhoa = tuKhoa.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                                tuKhoa = tuKhoa.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                                tuKhoa = tuKhoa.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                                tuKhoa = tuKhoa.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                                tuKhoa = tuKhoa.replace(/đ/gi, 'd');
                                //Xóa các ký tự đặt biệt
                                tuKhoa = tuKhoa.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                                //Đổi khoảng trắng thành ký tự gạch ngang
                                tuKhoa = tuKhoa.replace(/ /gi, "-");
                                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                                tuKhoa = tuKhoa.replace(/\-\-\-\-\-/gi, '-');
                                tuKhoa = tuKhoa.replace(/\-\-\-\-/gi, '-');
                                tuKhoa = tuKhoa.replace(/\-\-\-/gi, '-');
                                tuKhoa = tuKhoa.replace(/\-\-/gi, '-');
                                //Xóa các ký tự gạch ngang ở đầu và cuối
                                tuKhoa = '@' + tuKhoa + '@';
                                tuKhoa = tuKhoa.replace(/\@\-|\-\@|\@/gi, '');
                                //In tuKhoa ra textbox có id tuKhoa
                                document.getElementById('tu_khoa_chi_nhanh').value = tuKhoa;
                            }
                        </script>
                        <div class="form-group row">
                            <label for="input-15" class="col-sm-2 col-form-label">Trạng thái <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="trang_thai_chi_nhanh" class="form-control" id="basic-select">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>
                            <label for="input-14" class="col-sm-2 col-form-label">Địa chỉ <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="dia_chi_chi_nhanh" name="dia_chi_chi_nhanh" onkeyup="changeToKeyword();">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Thứ tự hiển thị <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input class="form-control" type="number" min="0" max="50" value="0" name="thu_tu_hien_thi_cn" id="example-number-input">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Tên vùng <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="ma_vung" class="form-control single-select">
                                    @foreach($vung as $key => $area)
                                    <option value="{{$area->ma_vung}}">{{$area->ten_vung}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-15" class="col-sm-2 col-form-label">Tỉnh/Thành <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="province_id" class="form-control single-select">
                                    @foreach($tinhThanh as $key => $province)
                                    <option value="{{$province->province_id}}">{{$province->province_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Quận/Huyện <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="district_id" class="form-control single-select">
                                    @foreach($quanHuyen as $key => $district)
                                    <option value="{{$district->district_id}}">{{$district->district_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" id="input-17" name="ghi_chu_chi_nhanh"></textarea>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" name="danh_sach_sinh_vien" class="btn btn-danger"><i class="fa fa-times"></i> Hủy bỏ</button>
                            <button name="them_sinh_vien" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Thêm chi nhánh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END ADD BRANCHES -->
    <!--start overlay-->
    <div class="overlay toggle-menu"></div>
    <!--end overlay-->

</div>
<!-- End container-fluid-->
@stop
@section('javascript')
<!--Data Tables js-->
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/jszip.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/pdfmake.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/vfs_fonts.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>

<script>
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>



@stop