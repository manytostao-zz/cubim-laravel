@extends('layouts.master')

@section('title_section')
    <title>CUBIM - Administración</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('styles_section')
    {!! HTML::style('css/profile.css') !!}
    {!! HTML::style('plugins/select2/select2.css') !!}
    {!! HTML::style('plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') !!}
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
                                            <input type="radio" id="today_button" class="toggle"
                                                   name="options" value="today">Hoy</label>
                                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                            <input type="radio" id="week_button" class="toggle"
                                                   name="options" value="week">Semana</label>
                                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                            <input type="radio" id="month_button" class="toggle"
                                                   name="options" value="month">Mes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-striped table-bordered table-hover"
                                           id="tracesListDatatable">
                                        <thead>
                                        <tr>
                                            <th style="text-align: left; display: none">
                                                Id
                                            </th>
                                            <th style="text-align: left">
                                                Operaci&oacute;n
                                            </th>
                                            <th style="text-align: left">
                                                Objeto
                                            </th>
                                            <th style="text-align: left">
                                                Comentario
                                            </th>
                                            <th style="text-align: left">
                                                Modulo
                                            </th>
                                            <th class="hidden-xs" style="text-align: center">
                                                Fecha
                                            </th>
                                            <th style="text-align: left">
                                                Usuario
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
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

@section('scripts_section')
    {!! HTML::script('plugins/datatables/media/js/jquery.dataTables.min.js') !!}
    {!! HTML::script('plugins/datatables/extensions/TableTools/js/dataTables.TableTools.min.js') !!}
    {!! HTML::script('plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
    {!! HTML::script('plugins/select2/select2.min.js') !!}
    {!! HTML::script('plugins/select2/select2_locale_es.js') !!}
    {!! HTML::script('scripts/traces/tracesDatatables.js') !!}
    {!! HTML::script('scripts/traces/traces.js') !!}
    {!! HTML::script('scripts/laroute.js') !!}
    {!! HTML::script('scripts/utilities.js') !!}
    <script>
        jQuery(document).ready(function () {
            traces.initFilterButtons();
            tracesDatatables.initTracesListDatatable();
        })
    </script>

@endsection