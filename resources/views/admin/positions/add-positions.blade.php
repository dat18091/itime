@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Thêm chức danh</title>
@stop
@section('css')
<!-- Vector CSS -->
<link href="{{asset('public/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
<!--Select Plugins-->
<link href="{{asset('public/backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<!--inputtags-->
<link href="{{asset('public/backend/assets/plugins/inputtags/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<!--multi select-->
<link href="{{asset('public/backend/assets/plugins/jquery-multi-select/multi-select.css')}}" rel="stylesheet" type="text/css">
<!--Bootstrap Datepicker-->
<link href="{{asset('public/backend/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<!--Touchspin-->
<link href="{{asset('public/backend/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css">
@stop
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">THÊM CHỨC DANH</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">CÀI ĐẶT HỆ THỐNG</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Thông Tin</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Danh Sách Chức Danh</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm Chức Danh</li>
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
                    <form id="signupForm" method="post" action="{{URL::to('/admin/save-positions')}}">
                        {{csrf_field()}}
                        <h4 class="form-header text-uppercase">
                            <i class="fa fa-envelope-o"></i>
                            Thêm Chức Danh
                        </h4>

                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Tên chức danh <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="ten_chuc_danh" name="ten_chuc_danh" onkeyup="changeToKeyword();">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Từ khóa <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control" id="tu_khoa_chuc_danh" name="tu_khoa_chuc_danh">
                            </div>
                        </div>
                        <script type="text/javascript">
                            function changeToKeyword() {
                                var tenChucDanh, tuKhoa;

                                //Lấy text từ thẻ input categoryName 
                                tenChucDanh = document.getElementById("ten_chuc_danh").value;

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
                                document.getElementById('tu_khoa_chuc_danh').value = tuKhoa;
                            }
                        </script>

                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Kinh nghiệm <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input class="form-control" type="number" min="0" max="50" value="0" name="kinh_nghiem" id="example-number-input">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Trình độ <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="ma_trinh_do" class="form-control single-select">
                                    @foreach($trinhDo as $key => $level)
                                    <option value="{{$level->ma_trinh_do}}">{{$level->ten_trinh_do}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="input-14" class="col-sm-2 col-form-label">Thứ tự hiển thị </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="number" min="0" max="50" value="0" name="thu_tu_hien_thi" id="example-number-input">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Trạng thái <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="trang_thai_chuc_danh" class="form-control" id="basic-select">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" id="input-17" name="ghi_chu_chuc_danh"></textarea>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" name="danh_sach_sinh_vien" class="btn btn-danger"><i class="fa fa-times"></i> Hủy bỏ</button>
                            <button name="them_sinh_vien" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Thêm chức danh</button>
                        </div>
                    </form>
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
<!--Bootstrap Touchspin Js-->
<script src="{{asset('public/backend/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/bootstrap-touchspin/js/bootstrap-touchspin-script.js')}}"></script>

<!--Bootstrap Datepicker Js-->
<script src="{{asset('public/backend/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $('#default-datepicker').datepicker({
        todayHighlight: true
    });
    $('#autoclose-datepicker').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#inline-datepicker').datepicker({
        todayHighlight: true
    });

    $('#dateragne-picker .input-daterange').datepicker({});
</script>
<!--Multi Select Js-->
<script src="{{asset('public/backend/assets/plugins/jquery-multi-select/jquery.multi-select.js')}}"></script>
<script src="{{asset('public/backend/assets/plugins/jquery-multi-select/jquery.quicksearch.js')}}"></script>
<!--Select Plugins Js-->
<script src="{{asset('public/backend/assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.single-select').select2();

        $('.multiple-select').select2();

        //multiselect start

        $('#my_multi_select1').multiSelect();
        $('#my_multi_select2').multiSelect({
            selectableOptgroup: true
        });

        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            afterInit: function(ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function() {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function() {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        $('.custom-header').multiSelect({
            selectableHeader: "<div class='custom-header'>Selectable items</div>",
            selectionHeader: "<div class='custom-header'>Selection items</div>",
            selectableFooter: "<div class='custom-header'>Selectable footer</div>",
            selectionFooter: "<div class='custom-header'>Selection footer</div>"
        });


    });
</script>
@stop