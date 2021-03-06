@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Danh sách ca làm việc</title>
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
            <h4 class="page-title">DANH SÁCH CA LÀM</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">CÀI ĐẶT HỆ THỐNG</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ca Làm</li>
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
                        <div class="space"><a href="" data-toggle="modal" data-target="#themCaLam" data-whatever="@mdo" class="btn btn-success ">Tạo mới</a></div>
                        <div class="space"><a href="{{URL::to('/admin/list-shifts-trash')}}" class="btn btn-primary ">Thùng rác</a></div>
                        <div class="space"><a href="{{URL::to('/admin/list-shifts')}}" class="btn btn-danger ">Danh sách</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên ca</th>
                                    <th>Ghi chú</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($caLam as $key => $shift)
                                <tr>
                                    <td>{{ $shift->name }}</td>
                                    <td>{{ $shift->note }}</td>
                                    <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="{{URL::to('/admin/restore-shifts/'.$shift->id)}}" class="btn btn-success waves-effect waves-light">Restore</a>
                                            <a type="button" href="{{URL::to('/admin/delete-shifts/'.$shift->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa vùng này vĩnh viễn?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tên ca</th>
                                    <th>Ghi chú</th>
                                    <th>Thao tác</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADD AREA -->
        <div class="modal fade bd-example-modal-lg" id="themCaLam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content animated fadeInUp">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm Vùng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{URL::to('/admin/save-shifts')}}">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="input-14" class="col-sm-2 col-form-label">Tên ca làm <span class="focus">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ten_ca_lam" name="ten_ca_lam" onkeyup="changeToKeyword();">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input-15" class="col-sm-2 col-form-label">Từ khóa <span class="focus">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" id="tu_khoa_ca_lam" name="tu_khoa_ca_lam">
                                </div>
                            </div>
                            <script type="text/javascript">
                                function changeToKeyword() {
                                    var tenCaLam, tuKhoa;

                                    //Lấy text từ thẻ input categoryName 
                                    tenCaLam = document.getElementById("ten_ca_lam").value;

                                    //Đổi chữ hoa thành chữ thường
                                    tuKhoa = tenCaLam.toLowerCase();

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
                                    document.getElementById('tu_khoa_ca_lam').value = tuKhoa;
                                }
                            </script>
                            <div class="form-group row">
                                <label for="input-15" class="col-sm-2 col-form-label">Trạng thái <span class="focus">*</span></label>
                                <div class="col-sm-10">
                                    <select name="trang_thai_ca_lam" class="form-control" id="basic-select">
                                        <option value="1">Ẩn</option>
                                        <option value="0">Hiển thị</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="resize:none;" rows="4" id="input-17" name="ghi_chu_ca_lam"></textarea>
                                </div>
                            </div>
                            <div class="form-footer">
                                <a type="button" name="danh_sach_ca_lam" class="btn btn-danger"><i class="fa fa-times"></i> Hủy Bỏ</a>
                                <button name="add_areas" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Thêm Ca Làm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ADD AREA -->

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