@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Thêm nhân viên</title>
@stop
@section('css')
<!-- Vector CSS -->
<link href="{{asset('public/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
<!-- notifications css -->
<link rel="stylesheet" href="{{asset('public/backend/assets/plugins/notifications/css/lobibox.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('node_modules/sweetalert/dist/sweetalert.css')}}">
<!--Bootstrap Datepicker-->
<link href="{{asset('public/backend/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<!--Select Plugins-->
<link href="{{asset('public/backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<!--multi select-->
<link href="{{asset('public/backend/assets/plugins/jquery-multi-select/multi-select.css')}}" rel="stylesheet" type="text/css">
@stop
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">THÊM NHÂN VIÊN</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">CÀI ĐẶT HỆ THỐNG</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm Nhân Viên</li>
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
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="nav nav-pills nav-pills-warning flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link py-4 active" data-toggle="pill" href="#piil-21"><i class="icon-home"></i> <span class="hidden-xs">Thông tin cơ bản</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-22"><i class="icon-user"></i> <span class="hidden-xs">Chấm công</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-23"><i class="icon-envelope-open"></i> <span class="hidden-xs">Thời gian làm việc</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-24"><i class="icon-envelope-open"></i> <span class="hidden-xs">Trình độ chuyên môn</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-25"><i class="icon-envelope-open"></i> <span class="hidden-xs">Chứng chỉ</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-26"><i class="icon-envelope-open"></i> <span class="hidden-xs">Lịch sử công tác</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-27"><i class="icon-envelope-open"></i> <span class="hidden-xs">Thông tin liên hệ</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-28"><i class="icon-envelope-open"></i> <span class="hidden-xs">Tình trạng sức khỏe</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-29"><i class="icon-envelope-open"></i> <span class="hidden-xs">Tiền lương/Trợ cấp</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-4" data-toggle="pill" href="#piil-30"><i class="icon-envelope-open"></i> <span class="hidden-xs">Thông tin khác</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="piil-21" class="container tab-pane active">
                                    <div class="card">
                                        <div class="card-body">
                                            <form id="signupForm" enctype="multipart/form-data" method="post" action="{{URL::to('/admin/save-employees')}}">
                                                {{csrf_field()}}
                                                <h4 class="form-header text-uppercase">
                                                    <i class="fa fa-envelope-o"></i>
                                                    Thêm Nhân Viên
                                                </h4>

                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Tên nhân viên <span class="focus">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Số điện thoại <span class="focus">*</span></label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="phone">
                                                    </div>
                                                    <label for="input-14" class="col-sm-2 col-form-label">Ngày sinh <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <input type="text" id="autoclose-datepicker" name="date_of_birth" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Email <span class="focus">*</span></label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="email">
                                                    </div>
                                                    <label for="input-14" class="col-sm-2 col-form-label">Giới tính <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <select name="gender" class="form-control" id="basic-select">
                                                            <option value="1">Nam</option>
                                                            <option value="0">Nữ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Địa chỉ hiện tại <span class="focus">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="current_address">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Thứ tự hiển thị </label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="number" min="0" max="50" value="0" name="display_order" id="example-number-input">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Số CMND <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="identity_card" name="identity_card">
                                                    </div>
                                                    <label for="input-14" class="col-sm-3 col-form-label">Ngày cấp <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <input type="text" id="default-datepicker" name="date_release_id" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Nơi cấp <span class="focus">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="located_release_id" name="noi_cap_cmnd">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input id="checkbox" type="checkbox"> Hộ chiếu (nếu có)
                                                </div>
                                                <div id="passport">
                                                    <div class="form-group row">
                                                        <label for="input-14" class="col-sm-3 col-form-label">Số hộ chiếu </label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="passport" name="passport">
                                                        </div>
                                                        <label for="input-14" class="col-sm-3 col-form-label">Nơi cấp </label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="located_release_passport" name="located_release_passport">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="input-14" class="col-sm-3 col-form-label">Ngày cấp </label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="date_release_passport" id="default-datepicker" class="form-control">
                                                        </div>
                                                        <label for="input-14" class="col-sm-3 col-form-label">Ngày hết hạn </label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="date_expired_passport" id="default-datepicker" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    var checkbox = document.getElementById('checkbox');
                                                    var delivery_div = document.getElementById('passport');
                                                    var showHiddenDiv = function() {
                                                        if (checkbox.checked) {
                                                            delivery_div.style['display'] = 'block';
                                                        } else {
                                                            delivery_div.style['display'] = 'none';
                                                        }
                                                    }
                                                    checkbox.onclick = showHiddenDiv;
                                                    showHiddenDiv();
                                                </script>

                                                <hr>

                                                <div class="form-group row">
                                                    <label for="input-15" class="col-sm-3 col-form-label">Vùng <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <select name="area_id" class="form-control single-select">
                                                            @foreach($dataArea as $key => $areas)
                                                            <option value="{{$areas->id}}">{{$areas->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label for="input-15" class="col-sm-2 col-form-label">Chi nhánh <span class="focus">*</span></label>
                                                    <div class="col-sm-4">
                                                        <select name="branch_id" class="form-control single-select">
                                                            @foreach($dataBranch as $key => $branch)
                                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-15" class="col-sm-3 col-form-label">Chức danh <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <select name="position_id" class="form-control single-select">
                                                            @foreach($dataPosition as $key => $position)
                                                            <option value="{{$position->id}}">{{$position->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label for="input-15" class="col-sm-2 col-form-label">Phòng ban </label>
                                                    <div class="col-sm-4">
                                                        <select name="department_id" class="form-control single-select">
                                                            @foreach($dataDepartment as $key => $department)
                                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-15" class="col-sm-3 col-form-label">Tỉnh/Thành <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <select name="province_id" class="form-control single-select">
                                                            @foreach($provinces as $key => $province)
                                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label for="input-15" class="col-sm-3 col-form-label">Quận/Huyện <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <select name="district_id" class="form-control single-select">
                                                            @foreach($districts as $key => $district)
                                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-15" class="col-sm-3 col-form-label">Nhóm truy cập <span class="focus">*</span></label>
                                                    <div class="col-sm-9">
                                                        <select name="accessgroup_id" class="form-control single-select">
                                                            @foreach($dataAccessGroup as $key => $access)
                                                            <option value="{{$access->id}}">{{$access->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Hoạt động <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <select name="active" class="form-control" id="basic-select">
                                                            <option value="1">Đang hoạt động</option>
                                                            <option value="0">Đã nghỉ</option>
                                                        </select>
                                                    </div>
                                                    <label for="input-14" class="col-sm-4 col-form-label">Quyền trưởng phòng <span class="focus">*</span></label>
                                                    <div class="col-sm-2">
                                                        <select name="acting_chief" class="form-control" id="basic-select">
                                                            <option value="1">Không</option>
                                                            <option value="0">Có</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Chủ tài khoản <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="bank_name" name="bank_name">

                                                    </div>
                                                    <label for="input-14" class="col-sm-3 col-form-label">Số tài khoản <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="bank_number" name="bank_number">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-14" class="col-sm-3 col-form-label">Tên ngân hàng </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="name_of_bank" name="name_of_bank">
                                                    </div>
                                                    <label for="input-14" class="col-sm-3 col-form-label">Chi nhánh <span class="focus">*</span></label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="branch_of_bank" name="branch_of_bank">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label for="input-17" class="col-sm-3 col-form-label">Hình ảnh</label>
                                                    <div class="col-sm-9">
                                                        <input name="image" type="file" multiple="multiple">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="input-17" class="col-sm-3 col-form-label">Ghi chú</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" rows="4" id="input-17" name="note"></textarea>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-footer">
                                                    <button type="button" name="danh_sach_vung" class="btn btn-danger"><i class="fa fa-times"></i> Hủy Bỏ</button>
                                                    <button name="add_areas" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Thêm Nhân Viên</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="piil-22" class="container tab-pane fade">
                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    <p>It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                                </div>
                                <div id="piil-23" class="container tab-pane fade">
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                </div>
                                <div id="piil-24" class="container tab-pane fade">
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End row-->
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
<!-- Dropzone JS  -->
<script src="{{asset('public/backend/assets/plugins/dropzone/js/dropzone.js')}}"></script>
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