@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Danh sách chi nhánh</title>
@stop
@section('css')
<?php

use Illuminate\Support\Facades\Session;
?>
<!--Data Tables -->
<link href="{{asset('public/backend/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/backend/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
<!--Select Plugins-->
<link href="{{asset('public/backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<!--inputtags-->
<link href="{{asset('public/backend/assets/plugins/inputtags/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<!--multi select-->
<link href="{{asset('public/backend/assets/plugins/jquery-multi-select/multi-select.css')}}" rel="stylesheet" type="text/css">
@stop
<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">DANH SÁCH CHI NHÁNH</h4>
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
                        <div><a href="" data-toggle="modal" data-target="#addBranch" data-whatever="@mdo" class="btn btn-success space">Tạo mới</a></div>
                        <div><a href="{{URL::to('/admin/list-branches-trash')}}" class="btn btn-primary space">Thùng rác <span class="badge badge-warning badge-pill">{{ $branchCountOnl }}</span></a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên chi nhánh</th>
                                    <th>Trạng thái</th>
                                    <th>Địa chỉ</th>
                                    <th>Tên vùng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataBranch as $key => $branch)
                                <tr>
                                    <td>{{$branch->name}}</td>
                                    <td>
                                        <?php
                                        if ($branch->status == 0) {
                                        ?>
                                            <a href="{{URL::to('/admin/hide-branches/'.$branch->id)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/admin/show-branches/'.$branch->id)}}"><span class="fa-styling fa fa-thumbs-down"></span></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{$branch->address > 25 ? substr($branch->address, 0, 25)."..." : $branch->address}}</td>
                                    <td>
                                        @foreach($getAreas as $key => $area)
                                        @if($branch->idArea == $area->id)
                                        {{$area->name}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group group-round m-1">
                                            <a type="button" href="{{URL::to('/admin/edit-branches/'.$branch->id)}}" class="btn btn-success waves-effect waves-light">Sửa</a>
                                            <a type="button" href="{{URL::to('/admin/trash-branches/'.$branch->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa chi nhánh này?')" class="btn btn-danger waves-effect waves-light">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tên chi nhánh</th>
                                    <th>Trạng thái</th>
                                    <th>Địa chỉ</th>
                                    <th>Tên vùng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Row-->
    <!-- ADD BRANCHES -->
    <div class="modal fade bd-example-modal-lg" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <!-- 
                flipInX : scroll show
                rollIn : left scroll center
                zoomInUp : small to large
                slideInUp : bottom to top
                rotateIn : right scroll center
                flip : scroll left and right
                lightSpeedIn : right to center
                swing : wobble : bounceIn : tada
                jackInTheBox : flash : fadeInUp
            -->
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Chi Nhánh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="signupForm" method="post" action="{{URL::to('/admin/save-branches')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Tên chi nhánh <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="name" name="name" onkeyup="changeToKeyword();">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Từ khóa <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control" id="keyword" name="keyword">
                            </div>
                        </div>
                        <script type="text/javascript">
                            function changeToKeyword() {
                                var tenChucDanh, tuKhoa;

                                //Lấy text từ thẻ input categoryName 
                                tenChucDanh = document.getElementById("name").value;

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
                                document.getElementById('keyword').value = tuKhoa;
                            }
                        </script>
                        <div class="form-group row">
                            <label for="input-15" class="col-sm-2 col-form-label">Trạng thái <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="status" class="form-control" id="basic-select">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>
                            <label for="input-14" class="col-sm-2 col-form-label">Địa chỉ <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Thứ tự hiển thị <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input class="form-control" type="number" min="0" max="50" value="0" name="displayOrder" id="example-number-input">
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Tên vùng <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="idArea" class="form-control single-select">
                                    @foreach($getAreas as $key => $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-15" class="col-sm-2 col-form-label">Tỉnh/Thành <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="idProvince" class="form-control single-select">
                                    @foreach($getProvinces as $key => $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="input-15" class="col-sm-2 col-form-label">Quận/Huyện <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <select name="idDistrict" class="form-control single-select">
                                    @foreach($getDistricts as $key => $district)
                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" id="input-17" name="note"></textarea>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" name="danh_sach_sinh_vien" class="btn btn-danger"><i class="fa fa-times"></i> Hủy bỏ</button>
                            <button name="them_sinh_vien" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Thêm chi nhánh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END ADD BRANCHES -->
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