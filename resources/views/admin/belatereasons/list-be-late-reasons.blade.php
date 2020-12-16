@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Danh sách lý do đi trễ</title>
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
            <h4 class="page-title">DANH SÁCH LÝ DO ĐI TRỄ</h4>
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
                        <div><a href="" data-toggle="modal" data-target="#addBeLateReason" data-whatever="@mdo" class="btn btn-success space">Tạo mới</a></div>
                        <div><a href="{{URL::to('/admin/list-be-late-reasons-trash')}}" class="btn btn-primary space">Thùng rác</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên vùng</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_be_late_reasons as $key => $area)
                                <tr>
                                    <td>{{ $area->name }}</td>
                                    <td>{{ $area->note }}</td>
                                    <td>
                                        <?php
                                        if ($area->status == 0) {
                                        ?>
                                            <a href="{{URL::to('/admin/hide-be-late-reasons/'.$area->id)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/admin/show-be-late-reasons/'.$area->id)}}"><span class="fa-styling fa fa-thumbs-down"></span></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="{{URL::to('/admin/edit-be-late-reasons/'.$area->id)}}" class="btn btn-success waves-effect waves-light">Sửa</a>
                                            <a type="button" href="{{URL::to('/admin/trash-be-late-reasons/'.$area->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa vùng này?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tên vùng</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Row-->
    <div class="modal fade bd-example-modal-lg" id="addBeLateReason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Lý Do Đi Trễ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{URL::to('/admin/save-be-late-reasons')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Lý do <span class="focus">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" onkeyup="changeToKeyword();">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-15" class="col-sm-2 col-form-label">Trạng thái <span class="focus">*</span></label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control" id="basic-select">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" style="resize:none;" rows="4" id="input-17" name="note"></textarea>
                            </div>
                        </div>
                        <div class="form-footer">
                            <a type="button" name="danh_sach_vung" class="btn btn-danger"><i class="fa fa-times"></i> Hủy Bỏ</a>
                            <button name="add_areas" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Thêm Lý Do</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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