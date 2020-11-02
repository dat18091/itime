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
    @yield('admin_title')
    <!--favicon-->
    <link rel="icon" href="{{asset('public/backend/assets/images/logo-itime96x96.ico')}}" type="image/x-icon" />
    <!-- simplebar CSS-->
    <link href="{{asset('public/backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{{asset('public/backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{asset('public/backend/assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{asset('public/backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="{{asset('public/backend/assets/css/sidebar-menu.css')}}" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="{{asset('public/backend/assets/css/app-style.css')}}" rel="stylesheet" />
    <!-- skins CSS-->
    <link href="{{asset('public/backend/assets/css/skins.css')}}" rel="stylesheet" />
    @yield('css')
</head>

<body>
    <!-- Start wrapper-->
    <div id="wrapper">
        <!--Start sidebar-wrapper-->
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
            <div class="brand-logo">
                <a href="index.html">
                    <img src="{{asset('public/backend/assets/images/logo-itime96x96.png')}}" class="logo-icon" alt="logo icon">
                    <h5 class="logo-text">IZITIME Admin</h5>
                </a>
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-header">CÀI ĐẶT HỆ THỐNG</li>

                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-view-dashboard"></i> <span>Công Ty</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Công Ty <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{URL::to('/admin/list-companies')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Thông Tin Công Ty</a></li>
                                <li><a href="{{URL::to('/admin/list-areas')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Vùng</a></li>
                                <li><a href="{{URL::to('/admin/list-branch')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Chi Nhánh</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Thông Tin <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Dự Án</a></li>
                                <li><a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Phòng Ban</a></li>
                                <li><a href="{{URL::to('/admin/list-education-levels')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Trình Độ</a></li>
                                <li><a href="{{URL::to('/admin/list-positions')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Chức Danh</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-layers"></i>
                        <span>Nhân Sự</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="ui-typography.html"><i class="zmdi zmdi-dot-circle-alt"></i> Hình Thức Làm Việc</a></li>
                        <li><a href="ui-cards.html"><i class="zmdi zmdi-dot-circle-alt"></i> Chuyên Nghành</a></li>
                        <li><a href="ui-buttons.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Nghỉ Việc</a></li>
                        <li><a href="ui-nav-tabs.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Làm Thêm Giờ</a></li>
                        <li><a href="ui-accordions.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Kỷ Luật</a></li>
                        <li><a href="ui-modals.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Khen Thưởng</a></li>
                        <li><a href="ui-list-groups.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Suất Ăn</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-card-travel"></i>
                        <span>Nghỉ Phép</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="components-range-slider.html"><i class="zmdi zmdi-dot-circle-alt"></i> Thiết Lập Nghỉ Lễ</a></li>
                        <li><a href="components-image-carousel.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Ngày Nghỉ</a></li>
                        <li><a href="components-grid-layouts.html"><i class="zmdi zmdi-dot-circle-alt"></i> Thiết Lập Ngày Nghỉ</a></li>
                        <li><a href="components-switcher-buttons.html"><i class="zmdi zmdi-dot-circle-alt"></i> Thiết Lập Nghỉ Phép</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-chart"></i> <span>Lương</span>
                        <i class="fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="charts-chartjs.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Cấp Bậc Lương</a></li>
                        <li><a href="charts-apex.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Phụ Cấp</a></li>
                        <li><a href="charts-sparkline.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Tạm Ứng</a></li>
                        <li><a href="charts-peity.html"><i class="zmdi zmdi-dot-circle-alt"></i> Hệ Số Lương</a></li>
                        <li><a href="charts-other.html"><i class="zmdi zmdi-dot-circle-alt"></i> Loại Làm Thêm Giờ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-invert-colors"></i> <span>Phân Quyền</span>
                        <i class="fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="icons-font-awesome.html"><i class="zmdi zmdi-dot-circle-alt"></i> Nhóm Phân Quyền</a></li>
                        <li><a href="icons-material-designs.html"><i class="zmdi zmdi-dot-circle-alt"></i> Phân Quyền</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-view-dashboard"></i> <span>Cài Đặt Khác</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Công Ty <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Thông Tin</a></li>
                                <li><a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Vùng</a></li>
                                <li><a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Chi Nhánh</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Thông Tin <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Dự Án</a></li>
                                <li><a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Phòng Ban</a></li>
                                <li><a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Chức Danh</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-header">DANH MỤC QUẢN LÝ</li>
                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-view-dashboard"></i> <span>Sinh Viên</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Lớp Học <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{URL::to('/them-lop-hoc')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Thêm Lớp Học</a></li>
                                <li><a href="{{URL::to('/danh-sach-lop-hoc')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Danh Sách Lớp Học</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Môn Học<i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{URL::to('/them-mon-hoc')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Thêm Môn Học</a></li>
                                <li><a href="{{URL::to('/danh-sach-mon-hoc')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Danh Sách Môn Học</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Sinh Viên<i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{URL::to('/them-sinh-vien')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Thêm Sinh Viên</a></li>
                                <li><a href="{{URL::to('/danh-sach-sinh-vien')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Danh Sách Sinh Viên</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();"><i class="zmdi zmdi-dot-circle-alt"></i> Kết Quả<i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{URL::to('/cham-diem')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Chấm Điểm</a></li>
                                <li><a href="{{URL::to('/xem-ket-qua')}}"><i class="zmdi zmdi-dot-circle-alt"></i> Xem Kết Quả</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-format-list-bulleted"></i> <span>Nhân Viên</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="form-inputs.html"><i class="zmdi zmdi-dot-circle-alt"></i> Thêm Nhân Viên</a></li>
                        <li><a href="form-input-group.html"><i class="zmdi zmdi-dot-circle-alt"></i> Quản Lý Nhân Viên</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-lock"></i> <span>Điểm Danh</span>
                        <i class="fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="authentication-signin.html" target="_blank"><i class="zmdi zmdi-dot-circle-alt"></i> Thông Tin Điểm Danh</a></li>
                        <li><a href="authentication-signup.html" target="_blank"><i class="zmdi zmdi-dot-circle-alt"></i> Lịch Sử Điểm Danh</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-lock"></i> <span>Yêu Cầu</span>
                        <i class="fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="authentication-signin.html" target="_blank"><i class="zmdi zmdi-dot-circle-alt"></i> Thông Tin Yêu Cầu</a></li>
                        <li><a href="authentication-signup.html" target="_blank"><i class="zmdi zmdi-dot-circle-alt"></i> Danh Sách Yêu Cầu</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javaScript:void();" class="waves-effect">
                        <i class="zmdi zmdi-grid"></i> <span>Tiền Lương</span>
                        <i class="fa fa-angle-left float-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="table-simple-tables.html"><i class="zmdi zmdi-dot-circle-alt"></i> Simple Tables</a></li>
                        <li><a href="table-data-tables.html"><i class="zmdi zmdi-dot-circle-alt"></i> Data Tables</a></li>
                    </ul>
                </li>

                <li class="sidebar-header">LABELS</li>
                <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-coffee text-danger"></i> <span>Important</span></a></li>
                <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-chart-donut text-success"></i> <span>Warning</span></a></li>
                <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-share text-info"></i> <span>Information</span></a></li>
            </ul>
        </div>
        <!--End sidebar-wrapper-->
        <!--Start topbar header-->
        <header class="topbar-nav">
            <nav id="header-setting" class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="icon-menu menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="search-bar">
                            <input type="text" class="form-control" placeholder="Enter keywords">
                            <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                        </form>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                            <i class="fa fa-envelope-open-o"></i><span class="badge badge-primary badge-up">12</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    You have 12 new messages
                                    <span class="badge badge-primary">12</span>
                                </li>
                                <li class="list-group-item">
                                    <a href="javaScript:void();">
                                        <div class="media">
                                            <div class="avatar"><img class="align-self-start mr-3" src="{{asset('public/backend/assets/images/avatars/avatar-5.png')}}" alt="user avatar"></div>
                                            <div class="media-body">
                                                <h6 class="mt-0 msg-title">Jhon Deo</h6>
                                                <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                                <small>Today, 4:10 PM</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javaScript:void();">
                                        <div class="media">
                                            <div class="avatar"><img class="align-self-start mr-3" src="{{asset('public/backend/assets/images/avatars/avatar-6.png')}}" alt="user avatar"></div>
                                            <div class="media-body">
                                                <h6 class="mt-0 msg-title">Sara Jen</h6>
                                                <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                                <small>Yesterday, 8:30 AM</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javaScript:void();">
                                        <div class="media">
                                            <div class="avatar"><img class="align-self-start mr-3" src="{{asset('public/backend/assets/images/avatars/avatar-7.png')}}" alt="user avatar"></div>
                                            <div class="media-body">
                                                <h6 class="mt-0 msg-title">Dannish Josh</h6>
                                                <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                                <small>5/11/2018, 2:50 PM</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javaScript:void();">
                                        <div class="media">
                                            <div class="avatar"><img class="align-self-start mr-3" src="{{asset('public/backend/assets/images/avatars/avatar-8.png')}}" alt="user avatar"></div>
                                            <div class="media-body">
                                                <h6 class="mt-0 msg-title">Katrina Mccoy</h6>
                                                <p class="msg-info">Lorem ipsum dolor sit amet.</p>
                                                <small>1/11/2018, 2:50 PM</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item text-center"><a href="javaScript:void();">See All Messages</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                            <i class="fa fa-bell-o"></i><span class="badge badge-info badge-up">14</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    You have 14 Notifications
                                    <span class="badge badge-info">14</span>
                                </li>
                                <li class="list-group-item">
                                    <a href="javaScript:void();">
                                        <div class="media">
                                            <i class="zmdi zmdi-accounts fa-2x mr-3 text-info"></i>
                                            <div class="media-body">
                                                <h6 class="mt-0 msg-title">New Registered Users</h6>
                                                <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javaScript:void();">
                                        <div class="media">
                                            <i class="zmdi zmdi-coffee fa-2x mr-3 text-warning"></i>
                                            <div class="media-body">
                                                <h6 class="mt-0 msg-title">New Received Orders</h6>
                                                <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javaScript:void();">
                                        <div class="media">
                                            <i class="zmdi zmdi-notifications-active fa-2x mr-3 text-danger"></i>
                                            <div class="media-body">
                                                <h6 class="mt-0 msg-title">New Updates</h6>
                                                <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item text-center"><a href="javaScript:void();">See All Notifications</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item language">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
                            <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
                            <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
                            <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            <span class="user-profile"><img src="{{asset('public/backend/assets/images/avatars/avatar-13.png')}}" class="img-circle" alt="user avatar"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar"><img class="align-self-start mr-3" src="{{asset('public/backend/assets/images/avatars/avatar-13.png')}}" alt="user avatar"></div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title">
                                                <?php
                                                $name = Session::get('tenTruyCap');
                                                if ($name) {
                                                    echo $name;
                                                }
                                                ?>
                                            </h6>
                                            <p class="user-subtitle">
                                            <?php
                                                $email = Session::get('email');
                                                if ($email) {
                                                    echo $email;
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><i class="icon-power mr-2"></i> <a href="{{URL::to('/logout')}}">LOGOUT</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!--End topbar header-->
        <div class="clearfix"></div>
        <div class="content-wrapper">
            @yield('admin_content')
        </div>
        <!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
        <!--Start footer-->
        <footer class="footer">
            <div class="container">
                <div class="text-center">
                    Copyright © 2020 DatNQ Admin
                </div>
            </div>
        </footer>
        <!--End footer-->
        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
            </div>
            <div class="right-sidebar-content">


                <p class="mb-0">Header Colors</p>
                <hr>

                <div class="mb-3">
                    <button type="button" id="default-header" class="btn btn-outline-primary">Default Header</button>
                </div>

                <ul class="switcher">
                    <li id="header1"></li>
                    <li id="header2"></li>
                    <li id="header3"></li>
                    <li id="header4"></li>
                    <li id="header5"></li>
                    <li id="header6"></li>
                </ul>

                <p class="mb-0">Sidebar Colors</p>
                <hr>

                <div class="mb-3">
                    <button type="button" id="default-sidebar" class="btn btn-outline-primary">Default Header</button>
                </div>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>

            </div>
        </div>
        <!--end color switcher-->
    </div>
    <!--End wrapper-->
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/backend/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/js/bootstrap.min.js')}}"></script>

    <!-- simplebar js -->
    <script src="{{asset('public/backend/assets/plugins/simplebar/js/simplebar.js')}}"></script>
    <!-- sidebar-menu js -->
    <script src="{{asset('public/backend/assets/js/sidebar-menu.js')}}"></script>

    <!-- Custom scripts -->
    <script src="{{asset('public/backend/assets/js/app-script.js')}}"></script>
    @yield('javascript')
</body>

</html>