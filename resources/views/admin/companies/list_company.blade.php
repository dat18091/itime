@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Danh sách các công ty đăng ký</title>
@stop
<?php

use Illuminate\Support\Facades\Session;
?>
@section('css')
<!--Data Tables -->
<link href="{{asset('public/backend/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/backend/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
@stop
<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">DANH SÁCH CÔNG TY</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">DANH MỤC QUẢN LÝ</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thông Tin Công Ty</li>
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
                <div class="card-header"><i class="fa fa-table"></i> DANH SÁCH CÔNG TY ĐĂNG KÝ</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên công ty</th>
                                    <th>Tên truy cập</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $key => $company)
                                <tr>
                                    <td>{{$company->ten_cong_ty}}</td>
                                    <td>{{$company->ten_truy_cap}}</td>
                                    <td>{{$company->so_dien_thoai_cong_ty}}</td>
                                    <td>{{$company->email_cong_ty}}</td>
                                    <!-- <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="" class="btn btn-success waves-effect waves-light">Sửa</a>
                                            <a type="button" href="" class="btn btn-danger waves-effect waves-light">Xem</a>
                                        </div>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tên công ty</th>
                                    <th>Tên truy cập</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
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
    <?php
    $message = Session::get('message');
    $alert_type = Session::get('alert-type');
    if ($message && $alert_type == 'warning') {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "' . $message . '",
                    type: "' . $alert_type . '",
                    showConfirmButton: true
                },);
            }, 1000);
            </script>';
        Session::put('message', null);
    } else if ($message && $alert_type == 'success') {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "' . $message . '",
                    type: "' . $alert_type . '",
                    showConfirmButton: true
                },);
            }, 1000);
            </script>';
        Session::put('message', null);
    } else if ($message && $alert_type == 'danger') {
        echo '<script>
            function success_noti() {
                Lobibox.notify(' . $alert_type . ', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: "top right",
                    icon: "",
                    msg: ' . $message . '
                });
            }
            </script>';
        Session::put('message', null);
    }
    ?>
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