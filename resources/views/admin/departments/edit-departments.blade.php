@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Cập nhật phòng ban</title>
@stop
@section('css')
<!-- Vector CSS -->
<link href="{{asset('public/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
<!-- notifications css -->
<link rel="stylesheet" href="{{asset('public/backend/assets/plugins/notifications/css/lobibox.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('node_modules/sweetalert/dist/sweetalert.css')}}">
<!--Switchery-->
<link href="{{asset('public/backend/assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" />
@stop
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">CẬP NHẬT PHÒNG BAN</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">CÀI ĐẶT HỆ THỐNG</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập Nhật Phòng Ban</li>
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
                <div class="card-body">
                @foreach($phongBan as $key => $department)
                    <form id="signupForm" method="post" action="{{URL::to('/admin/update-departments/'.$department->ma_phong_ban)}}">
                        {{csrf_field()}}
                        <h4 class="form-header text-uppercase">
                            <i class="fa fa-envelope-o"></i>
                            Cập Nhật Phòng Ban
                        </h4>

                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Tên phòng ban <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{$department->ten_phong_ban}}" id="ten_phong_ban" name="ten_phong_ban" onkeyup="changeToKeyword();">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Từ khóa tên vùng <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control" value="{{$department->tu_khoa_phong_ban}}" id="tu_khoa_phong_ban" name="tu_khoa_phong_ban">
                            </div>
                        </div>
                        <script type="text/javascript">
                            function changeToKeyword() {
                                var tenPhongBan, tuKhoa;

                                //Lấy text từ thẻ input categoryName 
                                tenPhongBan = document.getElementById("ten_phong_ban").value;

                                //Đổi chữ hoa thành chữ thường
                                tuKhoa = tenPhongBan.toLowerCase();

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
                                document.getElementById('tu_khoa_phong_ban').value = tuKhoa;
                            }
                        </script>
                      
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Thứ tự hiển thị <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input class="form-control" type="number" min="0" max="50" value="{{$department->thu_tu_hien_thi_pb}}" name="thu_tu_hien_thi_pb" id="example-number-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" id="input-17" name="ghi_chu_phong_ban">{{$department->ghi_chu_phong_ban}}</textarea>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="button" name="danh_sach_vung" class="btn btn-danger"><i class="fa fa-times"></i> Hủy Bỏ</button>
                            <button name="add_areas" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Cập Nhật Phòng Ban</button>
                        </div>
                    </form>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!--End Row-->
    <!--start overlay-->
    <div class="overlay toggle-menu"></div>
    <!--end overlay-->
    <?php
    $message = Session::get('message');
    if (strpos($message, "Thêm vùng")) {
        echo '<script>
                setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "Thêm vùng thành công",
                    type: "success",
                    showConfirmButton: true
                    },);
                }, 1000);
            </script>';
        Session::put('message', null);
    } else if (strpos($message, "trống")) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "Các trường không được để trống.",
                    type: "error",
                    showConfirmButton: true
                },);
            }, 1000);
            </script>';
        Session::put('message', null);
    } else if (strpos($message, "quá ký tự")) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "Bạn đã nhập quá ký tự cho phép.",
                    type: "error",
                    showConfirmButton: true
                },);
            }, 1000);
            </script>';
        Session::put('message', null);
    } else if (strpos($message, "không đủ ký tự")) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "Bạn đã nhập không đủ ký tự.",
                    type: "error",
                    showConfirmButton: true
                },);
            }, 1000);
            </script>';
        Session::put('message', null);
    } else if (strpos($message, "không hợp lệ")) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "Bạn cần kiểm tra lại mật khẩu, website, email và số điện thoại.",
                    type: "error",
                    showConfirmButton: true
                },);
            }, 1000);
            </script>';
        Session::put('message', null);
    }
    ?>
</div>
<!-- End container-fluid-->

@endsection
@section('javascript')
<!--notification js -->
<script src="{{asset('public/backend/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/notifications/js/notifications.min.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
<!--Sweet Alerts -->
<script src="{{asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

<!--Switchery Js-->
<script src="{{asset('public/backend/assets/plugins/switchery/js/switchery.min.js')}}"></script>
<script>
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
    });
</script>

<!--Bootstrap Switch Buttons-->
<script src="{{asset('public/backend/assets/plugins/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
@stop