@extends('layouts.master')

@section('title_section')
    <title>CUBIM - Administración</title>
    @endsection

    @section('styles_section')
    {!! HTML::style('css/profile.css') !!}
    @endsection

    @section('content_section')
            <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Perfil de cuenta
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-users"></i>
                <a href="{{URL::route('users.index')}}">Cuentas de usuario</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{URL::route('users.show', $user->id)}}">Perfil de cuenta</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <a class="btn btn-fit-height blue" data-close-others="true">
                    <i class="fa fa-plus"></i> Nueva cuenta
                </a>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div id="info">
        @if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                {{Session::get('message')}}
            </div>
        @endif
    </div>
    <ul style="list-style: none; padding: 0">
        @foreach($errors->all() as $error)
            <li>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    {{ $error }}
                </div>
            </li>
        @endforeach
    </ul>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img alt="" class="img-responsive"
                             src="../../assets/admin/pages/media/profile/profile_user.jpg">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{$user->first_name}} {{$user->last_}}
                        </div>
                        <div class="profile-usertitle-job info">
                            <ul style="list-style: none; margin: 0; padding: 10px 0;">
                                @foreach($user->roles as $rol)
                                    <li>
                                        {{$rol->slug}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    {{--<div class="profile-usermenu">--}}
                        {{--<ul class="nav">--}}
                            {{--<li class="active">--}}
                                {{--<span href="#generales_tab" data-toggle="tab" aria-expanded="true">--}}
                                    {{--<i class="icon-info"></i>--}}
                                    {{--Datos de perfil </span>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Configuraci&oacute;n</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#tab_1_1">Informaci&oacute;n personal</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab_1_2">Change Password</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab_1_3">Roles y permisos</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div id="tab_1_1" class="tab-pane active">
                                        <form action="#" role="form">
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <input type="text" class="form-control" placeholder="John">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Doe">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Mobile Number</label>
                                                <input type="text" class="form-control" placeholder="+1 646 580 DEMO (6284)">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Interests</label>
                                                <input type="text" class="form-control" placeholder="Design, Web etc.">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Occupation</label>
                                                <input type="text" class="form-control" placeholder="Web Developer">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">About</label>
                                                <textarea placeholder="We are KeenThemes!!!" rows="3" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Website Url</label>
                                                <input type="text" class="form-control" placeholder="http://www.mywebsite.com">
                                            </div>
                                            <div class="margiv-top-10">
                                                <a class="btn green-haze" href="javascript:;">
                                                    Save Changes </a>
                                                <a class="btn default" href="javascript:;">
                                                    Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE PASSWORD TAB -->
                                    <div id="tab_1_2" class="tab-pane">
                                        <form action="#">
                                            <div class="form-group">
                                                <label class="control-label">Current Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="margin-top-10">
                                                <a class="btn green-haze" href="javascript:;">
                                                    Change Password </a>
                                                <a class="btn default" href="javascript:;">
                                                    Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                    <!-- PRIVACY SETTINGS TAB -->
                                    <div id="tab_1_3" class="tab-pane">
                                        <form action="#">
                                            <table class="table table-light table-hover">
                                                <tbody><tr>
                                                    <td>
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
                                                    </td>
                                                    <td>
                                                        <label class="uniform-inline">
                                                            <div class="radio"><span><input type="radio" value="option1" name="optionsRadios1"></span></div>
                                                            Yes </label>
                                                        <label class="uniform-inline">
                                                            <div class="radio"><span class="checked"><input type="radio" checked="" value="option2" name="optionsRadios1"></span></div>
                                                            No </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                    </td>
                                                    <td>
                                                        <label class="uniform-inline">
                                                            <div class="checker"><span><input type="checkbox" value=""></span></div> Yes </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                    </td>
                                                    <td>
                                                        <label class="uniform-inline">
                                                            <div class="checker"><span><input type="checkbox" value=""></span></div> Yes </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                                    </td>
                                                    <td>
                                                        <label class="uniform-inline">
                                                            <div class="checker"><span><input type="checkbox" value=""></span></div> Yes </label>
                                                    </td>
                                                </tr>
                                                </tbody></table>
                                            <!--end profile-settings-->
                                            <div class="margin-top-10">
                                                <a class="btn green-haze" href="javascript:;">
                                                    Save Changes </a>
                                                <a class="btn default" href="javascript:;">
                                                    Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PRIVACY SETTINGS TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
@endsection