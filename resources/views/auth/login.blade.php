<!DOCTYPE html>
<html lang="en">
<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>IZITIME | Trang đăng nhập vào quản lý</title>
    <!--favicon-->
    <link rel="icon" href="{{asset('public/backend/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- notifications css -->
    <link rel="stylesheet" href="{{asset('public/backend/assets/plugins/notifications/css/lobibox.min.css')}}" />
    <!-- Bootstrap core CSS-->
    <link href="{{asset('public/backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{asset('public/backend/assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{asset('public/backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="{{asset('public/backend/assets/css/app-style.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('node_modules/sweetalert/dist/sweetalert.css')}}">
</head>

<body>
    <!-- Start wrapper-->
    <div id="wrapper">

        <div class="card-authentication2 mx-auto my-5">
            <div class="card-group">
                <div class="card mb-0">
                    <div class="bg-signin2"></div>
                    <div class="card-img-overlay rounded-left my-5">
                        <h2 class="text-white">Lorem</h2>
                        <h1 class="text-white">Ipsum Dolor</h1>
                        <p class="card-text text-white pt-3">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                    </div>
                </div>

                <div class="card mb-0 ">
                    <div class="card-body">
                        <div class="card-content p-3">
                            <div class="card-title text-uppercase text-center py-3">Đăng Nhập</div>
                            <form action="{{URL::to('/sign-in')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="position-relative has-icon-left">
                                        <label for="exampleInputUsername" class="sr-only">Tên truy cập</label>
                                        <input type="text" id="exampleInputUsername" name="ten_truy_cap" class="form-control" placeholder="Nhập tên truy cập của bạn">
                                        <div class="form-control-position">
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="position-relative has-icon-left">
                                        <label for="exampleInputPassword" class="sr-only">Mật khẩu</label>
                                        <input type="password" id="exampleInputPassword" name="mat_khau" class="form-control" placeholder="Nhập mật khẩu của bạn">
                                        <div class="form-control-position">
                                            <i class="icon-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mr-0 ml-0">
                                    <div class="form-group col-6">
                                        <div class="icheck-material-primary">
                                            <input type="checkbox" id="user-checkbox" checked="" />
                                            <label for="user-checkbox">Ghi nhớ</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 text-right">
                                        <a href="authentication-reset-password2.html">Đổi mật khẩu</a>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">ĐĂNG NHẬP</button>
                                <div class="text-center pt-3">
                                    <p>or Sign in with</p>

                                    <div class="form-row mt-4">
                                        <div class="form-group mb-0 col-6">
                                            <button type="button" class="btn bg-facebook text-white btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
                                        </div>
                                        <div class="form-group mb-0 col-6 text-right">
                                            <button type="button" class="btn bg-twitter text-white btn-block"><i class="fa fa-twitter-square"></i> Twitter</button>
                                        </div>
                                    </div>

                                    <hr>
                                    <p class="text-dark">Ban chưa có tài khoản? <a href="{{URL::to('/register')}}"> Đăng ký</a></p>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->



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
    <!--notification js -->
    <script src="{{asset('public/backend/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/plugins/notifications/js/notifications.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/plugins/notifications/js/notification-custom-script.js')}}"></script>

    <!--Sweet Alerts -->
    <script src="{{asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

</body>

</html>