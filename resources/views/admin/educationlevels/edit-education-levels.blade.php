@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Chỉnh sửa trình độ</title>
@stop
@section('css')
<!-- Vector CSS -->
<link href="{{asset('public/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
@stop
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">CHỈNH SỬA TRÌNH ĐỘ</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">CÀI ĐẶT HỆ THỐNG</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Thông Tin</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Danh Sách Trình Độ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa Trình Độ</li>
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
                    @foreach($educationlevels as $key => $level)
                    <form id="signupForm" method="post" action="{{URL::to('/admin/update-education-levels/'.$level->ma_trinh_do)}}">
                        {{csrf_field()}}
                        <h4 class="form-header text-uppercase">
                            <i class="fa fa-envelope-o"></i>
                            Chỉnh Sửa Trình Độ
                        </h4>

                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Tên trình độ <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{$level->ten_trinh_do}}" id="ten_trinh_do" name="ten_trinh_do" onkeyup="changeToKeyword();">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Từ khóa trình độ <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control" value="{{$level->tu_khoa_trinh_do}}" id="tu_khoa_trinh_do" name="tu_khoa_trinh_do">
                            </div>
                        </div>
                        <script type="text/javascript">
                            function changeToKeyword() {
                                var tenTrinhDo, tuKhoa;

                                //Lấy text từ thẻ input categoryName 
                                tenTrinhDo = document.getElementById("ten_trinh_do").value;

                                //Đổi chữ hoa thành chữ thường
                                tuKhoa = tenTrinhDo.toLowerCase();

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
                                document.getElementById('tu_khoa_trinh_do').value = tuKhoa;
                            }
                        </script>
                        <div class="form-group row">
                            <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" id="input-17" name="ghi_chu_trinh_do">{{$level->ghi_chu_trinh_do}}</textarea>
                            </div>
                        </div>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <div class="form-footer">
                            <button type="submit" name="danh_sach_vung" class="btn btn-danger"><i class="fa fa-times"></i> Hủy Bỏ</button>
                            <button name="add_areas" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Chỉnh Sửa Trình Độ</button>
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
</div>
<!-- End container-fluid-->

@endsection
@section('javascript')

@stop