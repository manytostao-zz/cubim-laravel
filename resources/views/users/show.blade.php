@extends('layouts.master')

@section('title_section')
    <title>CUBIM - Administración</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
                        <p style="text-align: center">NO IMAGE</p>
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
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Registro de actividad</span>
                                    <span class="caption-helper hide">weekly stats...</span>
                                </div>
                                <div class="actions">
                                    <div data-toggle="buttons" class="btn-group btn-group-devided">
                                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                            <input type="radio" id="option1" class="toggle" name="options">Today</label>
                                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                            <input type="radio" id="option2" class="toggle" name="options">Week</label>
                                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                            <input type="radio" id="option2" class="toggle" name="options">Month</label>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row number-stats margin-bottom-30">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-left">
                                            <div class="stat-chart">
                                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                <div id="sparkline_bar">
                                                    <canvas style="display: inline-block; width: 90px; height: 45px; vertical-align: top;"
                                                            width="90" height="45"></canvas>
                                                </div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title">
                                                    Total
                                                </div>
                                                <div class="number">
                                                    2460
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-right">
                                            <div class="stat-chart">
                                                <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                <div id="sparkline_bar2">
                                                    <canvas style="display: inline-block; width: 90px; height: 45px; vertical-align: top;"
                                                            width="90" height="45"></canvas>
                                                </div>
                                            </div>
                                            <div class="stat-number">
                                                <div class="title">
                                                    New
                                                </div>
                                                <div class="number">
                                                    719
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr class="uppercase">
                                            <th colspan="2">
                                                MEMBER
                                            </th>
                                            <th>
                                                Earnings
                                            </th>
                                            <th>
                                                CASES
                                            </th>
                                            <th>
                                                CLOSED
                                            </th>
                                            <th>
                                                RATE
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="fit">
                                                <img src="../../assets/admin/layout3/img/avatar4.jpg"
                                                     class="user-pic">
                                            </td>
                                            <td>
                                                <a class="primary-link" href="javascript:;">Brain</a>
                                            </td>
                                            <td>
                                                $345
                                            </td>
                                            <td>
                                                45
                                            </td>
                                            <td>
                                                124
                                            </td>
                                            <td>
                                                <span class="bold theme-font">80%</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit">
                                                <img src="../../assets/admin/layout3/img/avatar5.jpg"
                                                     class="user-pic">
                                            </td>
                                            <td>
                                                <a class="primary-link" href="javascript:;">Nick</a>
                                            </td>
                                            <td>
                                                $560
                                            </td>
                                            <td>
                                                12
                                            </td>
                                            <td>
                                                24
                                            </td>
                                            <td>
                                                <span class="bold theme-font">67%</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit">
                                                <img src="../../assets/admin/layout3/img/avatar6.jpg"
                                                     class="user-pic">
                                            </td>
                                            <td>
                                                <a class="primary-link" href="javascript:;">Tim</a>
                                            </td>
                                            <td>
                                                $1,345
                                            </td>
                                            <td>
                                                450
                                            </td>
                                            <td>
                                                46
                                            </td>
                                            <td>
                                                <span class="bold theme-font">98%</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fit">
                                                <img src="../../assets/admin/layout3/img/avatar7.jpg"
                                                     class="user-pic">
                                            </td>
                                            <td>
                                                <a class="primary-link" href="javascript:;">Tom</a>
                                            </td>
                                            <td>
                                                $645
                                            </td>
                                            <td>
                                                50
                                            </td>
                                            <td>
                                                89
                                            </td>
                                            <td>
                                                <span class="bold theme-font">58%</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
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