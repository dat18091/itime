@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Danh sách nhân viên</title>
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-info nav-justified">
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#nhanvien" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Nhân Viên</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#hopdong" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Hợp Đồng</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#baohiem" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Bảo Hiểm</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#khenthuong" data-toggle="pill" class="nav-link"><i class="icon-user"></i> <span class="hidden-xs">Khen Thưởng</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#kyluat" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Kỷ Luật</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void();" data-target="#taisan" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Tài Sản</span></a>
                    </li>
                </ul>
                <div class="tab-content p-6">
                    <div class="container tab-pane active" id="nhanvien">
                        <div class="card-header">
                        <div class="action-button" style="display:flex;">
                        <div><a href="{{URL::to('/admin/add-employees')}}" class="btn btn-success space">Tạo mới</a></div>
                        <div><a href="{{URL::to('/admin/list-employees-trash')}}" class="btn btn-primary space">Thùng rác</a></div>
                    </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên nhân viên</th>
                                            <th>Số điện thoại</th>
                                            <th>Hình ảnh</th>
                                            <th>Vùng</th>
                                            <th>Chi nhánh</th>
                                            <th>Phòng ban</th>
                                            <th>Chức danh</th>
                                            <th>Nhóm truy cập</th>
                                            <th>Trạng thái</th>
                                            <th>Quyền trưởng phòng</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataEmployee as $key => $employee)
                                        <tr>
                                            <td>{{$employee->name}}</td>
                                            <td>{{$employee->phone}}</td>
                                            <td>
                                                <?php
                                                if ($employee->image == '') {
                                                ?>
                                                    <img src="{{asset('public/backend/assets/images/avatars/avatar-1.png')}}" width="50" height="50">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="../public/uploads/employees/{{$employee->image}}" width="50" height="50">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                @foreach($dataArea as $key => $area)
                                                @if($employee->area_id == $area->id)
                                                {{$area->name}}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($dataBranch as $key => $branch)
                                                @if($employee->branch_id == $branch->id)
                                                {{$branch->name}}
                                                @endif
                                                @endforeach
                                            </>
                                            <td>
                                                @foreach($dataDepartment as $key => $department)
                                                @if($employee->department_id == $department->id)
                                                {{$department->name}}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($dataPosition as $key => $position)
                                                @if($employee->position_id == $position->id)
                                                {{$position->name}}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($dataAccessGroup as $key => $access)
                                                @if($employee->accessgroup_id == $access->id)
                                                {{$access->name}}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <?php
                                                if ($employee->active == 1) {
                                                ?>
                                                    <a href="{{URL::to('/admin/hide-employees/'.$employee->id)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="{{URL::to('/admin/show-employees/'.$employee->id)}}"><span class="fa-styling fa fa-thumbs-down"></span></a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($employee->acting_chief == 0) {
                                                ?>
                                                    <a href="{{URL::to('/admin/renew-permit/'.$employee->id)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="{{ URL::to('/admin/terminate-permit/'.$employee->id )}}"><span class="fa-styling fa fa-thumbs-down"></span></a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group group-round m-1">
                                                    <a type="button" href="{{URL::to('/admin/edit-employees/'.$employee->id)}}" class="btn btn-success waves-effect waves-light">Sửa</a>
                                                    <a type="button" href="{{URL::to('/admin/trash-employees/'.$employee->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tên nhân viên</th>
                                            <th>Số điện thoại</th>
                                            <th>Hình ảnh</th>
                                            <th>Vùng</th>
                                            <th>Chi nhánh</th>
                                            <th>Phòng ban</th>
                                            <th>Chức danh</th>
                                            <th>Nhóm truy cập</th>
                                            <th>Trạng thái</th>
                                            <th>Quyền trưởng phòng</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="hopdong">
                        Danh sách nhân viên hợp đồng
                    </div>
                    <div class="tab-pane" id="baohiem">
                        Danh sách nhân viên bảo hiểm
                    </div>
                    <div class="tab-pane" id="khenthuong">
                        Danh sách nhân viên khen thưởng
                    </div>
                    <div class="tab-pane" id="kyluat">
                        Danh sách nhân viên kỷ luật
                    </div>
                    <div class="tab-pane" id="taisan">
                        Danh sách nhân viên tài sản
                    </div>
                </div>
            </div>
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