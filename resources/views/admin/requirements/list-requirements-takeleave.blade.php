@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Danh sách yêu cầu nghỉ phép</title>
@stop
@section('css')
<!--Data Tables -->
<link href="{{asset('public/backend/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/backend/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">

<!-- notifications css -->
<link rel="stylesheet" href="{{asset('public/backend/assets/plugins/notifications/css/lobibox.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('node_modules/sweetalert/dist/sweetalert.css')}}">
@stop
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">DANH SÁCH YÊU CẦU NGHỈ PHÉP</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">DANH MỤC QUẢN LÝ</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Yêu Cầu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Yêu Cầu Xin Nghỉ Phép</li>
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
                        <div class="space"><a href="" data-toggle="modal" data-target="#themChucDanh" data-whatever="@mdo" class="btn btn-success ">Tạo mới</a></div>
                        <div class="space"><a href="{{URL::to('/admin/list-positions-trash')}}" class="btn btn-primary ">Chấp nhận <span class="badge badge-warning badge-pill">12</span></a></div>
                        <div class="space"><a href="{{URL::to('/admin/list-positions')}}" class="btn btn-warning ">Từ chối <span class="badge badge-success badge-pill">12</span></a></div>
                        <div class="space"><a href="{{URL::to('/admin/list-positions')}}" class="btn btn-danger ">Xóa <span class="badge badge-primary badge-pill">12</span></a></div>
                        <div class="space"><a href="{{URL::to('/admin/list-positions')}}" class="btn btn-light ">Thùng rác <span class="badge badge-secondary badge-pill">12</span></a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên nhân viên</th>
                                    <th>Công ty</th>
                                    <th>Loại ngày nghỉ</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Ngày nghỉ</th>
                                    <th>Loại nghỉ phép</th>
                                    <th>Ca làm</th>
                                    <th>Lý do</th>
                                    <th>Nội dung</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nguyễn Quang Đạt</td>
                                    <td>Izisoft</td>
                                    <td>Nghỉ một ngày</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>14/11/2020</td>
                                    <td>Nghỉ nguyên ngày</td>
                                    <td>0</td>
                                    <td>Nghỉ sinh lý</td>
                                    <td>Nội dung</td>
                                    <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="" class="btn btn-primary waves-effect waves-light">Chấp nhận</a>
                                            <a type="button" href="" class="btn btn-warning custom waves-effect waves-light">Từ chối</a>
                                            <a type="button" href="" onclick="return confirm('Bạn có chắc chắn muốn xóa yêu cầu này?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nguyễn Quang Đạt</td>
                                    <td>Izisoft</td>
                                    <td>Nghỉ một ngày</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>14/11/2020</td>
                                    <td>Nghỉ nguyên ngày</td>
                                    <td>0</td>
                                    <td>Nghỉ sinh lý</td>
                                    <td>Nội dung</td>
                                    <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="" class="btn btn-primary waves-effect waves-light">Chấp nhận</a>
                                            <a type="button" href="" class="btn btn-warning custom waves-effect waves-light">Từ chối</a>
                                            <a type="button" href="" onclick="return confirm('Bạn có chắc chắn muốn xóa yêu cầu này?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tên nhân viên</th>
                                    <th>Công ty</th>
                                    <th>Loại ngày nghỉ</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Ngày nghỉ</th>
                                    <th>Loại nghỉ phép</th>
                                    <th>Ca làm</th>
                                    <th>Lý do</th>
                                    <th>Nội dung</th>
                                    <th>Thao tác</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End Row-->
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
<!--notification js -->
<script src="{{asset('public/backend/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/notifications/js/notifications.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
<!--Sweet Alerts -->
<script src="{{asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
@stop