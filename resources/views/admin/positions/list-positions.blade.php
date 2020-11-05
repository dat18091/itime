@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Danh sách chức danh</title>
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
            <h4 class="page-title">DANH SÁCH CHỨC DANH</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">CÀI ĐẶT HỆ THỐNG</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chức Danh</li>
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
                <div class="card-header"><i class="fa fa-table"></i> DANH SÁCH CHỨC DANH</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>Mã chức danh</th> -->
                                    <th>Tên chức danh</th>
                                    <th>Trình độ</th>
                                    <th>Kinh nghiệm</th>
                                    <!-- <th>Ghi chú</th> -->
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                    <th><a href="{{URL::to('/admin/add-positions')}}" class="btn btn-success">Tạo mới</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($positions as $key => $position)
                                <tr>
                                    <td>{{ $position->ten_chuc_danh }}</td>
                                    <td>
                                        @foreach($trinhDo as $key => $level)
                                        @if($position->ma_trinh_do == $level->ma_trinh_do)
                                        {{$level->ten_trinh_do}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $position->kinh_nghiem }}</td>
                                    <td>
                                        <?php
                                        if ($position->trang_thai_chuc_danh == 0) {
                                        ?>
                                            <a href="{{URL::to('/admin/hide-positions/'.$position->ma_chuc_danh)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/admin/show-positions/'.$position->ma_chuc_danh)}}"><span class="fa-styling fa fa-thumbs-down"></span></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="{{URL::to('/admin/edit-positions/'.$position->ma_chuc_danh)}}" class="btn btn-success waves-effect waves-light">Sửa</a>
                                            <a type="button" href="{{URL::to('/admin/delete-positions/'.$position->ma_chuc_danh)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa vùng này?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <!-- <th>Mã chức danh</th> -->
                                    <th>Tên vùng</th>
                                    <th>Trình độ</th>
                                    <th>Kinh nghiệm</th>
                                    <!-- <th>Ghi chú</th> -->
                                    <th>Trạng thái</th>
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