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
                <div class="card-header"><i class="fa fa-table"></i> DANH SÁCH CHI NHÁNH</div>
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
                                    <th><a href="{{URL::to('/admin/add-branches')}}" class="btn btn-success">Tạo mới</a></th>
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
                                            <a href="{{URL::to('/admin/hide-branches/'.$branch->id)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/admin/show-branches/'.$branch->id)}}"><span class="fa-styling fa fa-thumbs-down"></span></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{substr($branch->dia_chi_chi_nhanh, 0, 15)."..."}}</td>
                                    <td>
                                        @foreach($vung as $key => $area)
                                        @if($branch->ma_vung == $area->id)
                                        {{$area->ten_vung}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="{{URL::to('/admin/edit-branches/'.$branch->id)}}" class="btn btn-success waves-effect waves-light">Sửa</a>
                                            <a type="button" href="{{URL::to('/admin/delete-branches/'.$branch->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa chi nhánh này?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                        </div>
                                    </td>
                                    <td></td>
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
                                    <th></th>
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
        if (strpos($message, "Thêm chi nhánh")) {
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "Đăng ký thành công",
                    type: "success",
                    showConfirmButton: true
                    },);
                }, 1000);
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