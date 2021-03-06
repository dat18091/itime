<!DOCTYPE html>
<html lang="en">
<?php

use Illuminate\Support\Facades\Session;
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>IZITIME | Trang đăng ký tài khoản cho công ty</title>
    <!--favicon-->
    <link rel="icon" href="{{asset('public/backend/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link href="{{asset('public/backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{asset('public/backend/assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{asset('public/backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="{{asset('public/backend/assets/css/app-style.css')}}" rel="stylesheet" />

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
    <!-- notifications css -->
    <link rel="stylesheet" href="{{asset('public/backend/assets/plugins/notifications/css/lobibox.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('node_modules/sweetalert/dist/sweetalert.css')}}">
</head>

<body>

    <!-- Start wrapper-->
    <div id="wrapper">
      
        <div class="card card-authentication1 mx-auto my-4">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="card-title text-uppercase text-center py-3">ĐĂNG KÝ TÀI KHOẢN</div>
                    <form action="{{URL::to('/sign-up')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Tên công ty <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="input-14" name="name">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Tên truy cập <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="input-15" name="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Mật khẩu <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="input-14" name="password">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Loại hình doanh nghiệp</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="input-15" name="type_of_business">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Email <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>

                            <label for="input-15" class="col-sm-2 col-form-label">Số điện thoại <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="input-15" name="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Tỉnh/Thành Phố <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="province_id" class="form-control single-select">
                                    @foreach($getProvinces as $key => $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Quận/Huyện <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="district_id" class="form-control single-select">
                                    @foreach($getDistricts as $key => $district)
                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Website công ty </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="input-14" name="website">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Ngày thành lập <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" id="autoclose-datepicker" name="establish_date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" row s="4" id="input-17" name="note"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="icheck-material-primary">
                                <input type="checkbox" id="user-checkbox" checked="" />
                                <label for="user-checkbox">Tôi đồng ý tất cả các điều khoản và hợp đồng từ IZITIME</label>
                            </div>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary btn-block waves-effect waves-light">Đăng Ký</button>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-dark mb-0">Bạn đã có tài khoản? <a href="{{URL::to('/login')}}"> Đăng Nhập</a></p>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <?php
        $message = Session::get('message');
        $alert_type = Session::get('alert-type');
        if ($message && $alert_type == 'warning') {
            echo '<script>
            setTimeout(function() {
                swal({
                    title: "Thông báo",
                    text: "'.$message.'",
                    type: "'.$alert_type.'",
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
    <!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/backend/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/js/bootstrap.min.js')}}"></script>

    <!-- sidebar-menu js -->
    <script src="{{asset('public/backend/assets/js/sidebar-menu.js')}}"></script>

    <!-- Custom scripts -->
    <script src="{{asset('public/backend/assets/js/app-script.js')}}"></script>

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
    <!--notification js -->
    <script src="{{asset('public/backend/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/plugins/notifications/js/notifications.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
    <!--Sweet Alerts -->
    <script src="{{asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script>
        document.onkeydown = function(e) {
            if (e.ctrlKey &&
                (e.keyCode === 67 ||
                    e.keyCode === 86 ||
                    e.keyCode === 85 ||
                    e.keyCode === 117)) {
                return false;
            } else {
                return true;
            }
        };
        $(document).keypress("u", function(e) {
            if (e.ctrlKey) {
                return false;
            } else {
                return true;
            }
        });
        $(window).on('keydown', function(event) {
            if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                return false; //Prevent from ctrl+shift+i
            }
        })
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    </script>
</body>

</html>