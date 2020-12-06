@extends('admin_layout')
@section('admin_content')
@section('admin_title')
<title>IZITIME - Chỉnh sửa loại ngày nghỉ phép</title>
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
            <h4 class="page-title">CHỈNH SỬA VÙNG</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">CÀI ĐẶT HỆ THỐNG</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Công Ty</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Vùng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa Vùng</li>
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
                    @foreach($datetakeleavetypes as $key => $datetakeleavetype)
                    <form id="signupForm" method="post" action="{{URL::to('/admin/update-date-take-leave-types/'.$datetakeleavetype->id)}}">
                        {{csrf_field()}}
                        <h4 class="form-header text-uppercase">
                            <i class="fa fa-envelope-o"></i>
                            Chỉnh Sửa Loại Ngày Nghỉ Phép
                        </h4>

                        <div class="form-group row">
                            <label for="input-14" class="col-sm-2 col-form-label">Tên vùng <span class="focus">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{$datetakeleavetype->name}}" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-17" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" id="input-17" name="note">{{$datetakeleavetype->note}}</textarea>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" name="danh_sach_vung" class="btn btn-danger"><i class="fa fa-times"></i> Hủy Bỏ</button>
                            <button name="add_areas" class="btn btn-primary" type="submit"><i class="fa fa-add"></i> Chỉnh Sửa Vùng</button>
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