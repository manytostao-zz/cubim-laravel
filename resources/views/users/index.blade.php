@extends('layouts.master')

@section('title_section')
    <title>CUBiM - Administración</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @endsection

    @section('styles_section')
    {!! HTML::style('plugins/select2/select2.css') !!}
    {!! HTML::style('plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! HTML::style('plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') !!}
    @endsection

    @section('content_section')
            <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Cuentas de usuario
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-users"></i>
                <a href="{{URL::route('users.index')}}">Cuentas de usuario</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <a class="btn btn-fit-height blue" data-close-others="true" href="javascript:;">
                    <i class="fa fa-plus"></i> Nueva cuenta
                </a>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    @if(Session::has('message'))
        <div class="alert alert-info alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            {{Session::get('message')}}
        </div>
    @endif
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
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list"></i>Par&aacute;metros de filtrado
                    </div>
                    <div class="tools">
                        <a class="reload" href="javascript:;" data-original-title="" title="Limpiar filtros">
                        </a>
                        <a class="expand" href="javascript:;" data-original-title="" title="Colapsar/Expandir">
                        </a>
                    </div>
                    <div class="actions">
                        <a id="filter" class="btn default btn-sm" href="javascript:;">
                            <i class="fa fa-filter icon-black"></i> Filtrar </a>
                    </div>
                </div>
                <div class="portlet-body display-hide" style="display: none;">
                    {!! Form::open(array('route'=>'users.index', 'class'=>'form', 'id'=>'filters_form', 'name'=>'form')) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::text('first_name', Session::get('users_filters')['first_name'], array('class'=>'form-control', 'placeholder'=>'Nombres', 'id'=>'form_first_name')) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::text('last_name', Session::get('users_filters')['last_name'], array('class'=>'form-control', 'placeholder'=>'Apellidos', 'id'=>'form_last_name')) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::text('email', Session::get('users_filters')['email'], array('class'=>'form-control', 'placeholder'=>'Nombre de usuario', 'id'=>'form_email')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::select('roles', $roles, Session::get('users_filters')['roles'], array('class'=>'form-control', 'id'=>'form_roles', 'multiple'=>'multiple')) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group" id="register_date_range">
                                        {!! Form::text('from_register_date',
                                            Session::get('users_filters')['from_register_date'] != ''?Session::get('users_filters')['from_register_date'].' - '.Session::get('users_filters')['to_register_date']:null,
                                            array('class'=>'form-control', 'placeholder'=>'Fecha de alta', 'id'=>'form_created_at', 'disabled'=>'')) !!}
                                        <span class="input-group-btn">
												            <button class="btn default date-range-toggle" type="button">
                                                                <i class="fa fa-calendar"></i></button>
												        </span>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-md-4">--}}
                                {{--<div class="md-checkbox">--}}
                                    {{--{!! Form::checkbox('inactivo', Session::get('users_filters')['inactivo'], Session::get('users_filters')['inactivo'] == 'true', array('class'=>'md-check', 'id'=>'form_inactivo')) !!}--}}
                                    {{--<label for="form_inactivo">--}}
                                        {{--<span></span>--}}
                                        {{--<span class="check"></span>--}}
                                        {{--<span class="box"></span>--}}
                                        {{--Solo inactivos </label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group pull-right">
                                    <a class="btn default" href="#" data-toggle="dropdown">
                                        Columnas <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div id="usersListDatatable_column_toggler" style="min-width: 185px"
                                         class="dropdown-menu hold-on hold-on-click dropdown-checkboxes pull-right">
                                        <label><input type="checkbox" checked data-column="1"
                                                      data-field="first_name">Nombre(s)</label>
                                        <label><input type="checkbox" checked data-column="2"
                                                      data-field="last_name">Apellidos</label>
                                        <label><input type="checkbox" checked data-column="3" data-field="email">Nombre
                                            de usuario</label>
                                        <label><input type="checkbox" data-column="4"
                                                      data-field="roles">Roles</label>
                                        {{--<label><input type="checkbox" checked data-column="5" data-field="activo">Activo</label>--}}
                                        <label><input type="checkbox" checked data-column="5" data-field="created_at">Fecha
                                            de alta</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="usersListDatatable">
                        <thead>
                        <tr>
                            <th style="text-align: left; display: none">
                                Id
                            </th>
                            <th style="text-align: left">
                                Nombre(s)
                            </th>
                            <th style="text-align: left">
                                Apellidos
                            </th>
                            <th class="hidden-xs" style="text-align: center">
                                Nombre de usuario
                            </th>
                            <th class="hidden-xs" style="text-align: center">
                                Roles
                            </th>
                            {{--<th class="hidden-xs" style="text-align: center">--}}
                                {{--Activo--}}
                            {{--</th>--}}
                            <th class="hidden-xs" style="text-align: center">
                                Fecha de alta
                            </th>
                            <th class="hidden-xs" style="text-align: center">
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
    <!-- END PAGE CONTENT-->
@endsection

@section('scripts_section')
    {!! HTML::script('plugins/datatables/media/js/jquery.dataTables.min.js') !!}
    {!! HTML::script('plugins/datatables/extensions/TableTools/js/dataTables.TableTools.min.js') !!}
    {!! HTML::script('plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
    {!! HTML::script('plugins/select2/select2.min.js') !!}
    {!! HTML::script('plugins/select2/select2_locale_es.js') !!}
    {!! HTML::script('plugins/moment/moment-with-locales.js') !!}
    {!! HTML::script('plugins/bootstrap-daterangepicker/daterangepicker.js') !!}
    {!! HTML::script('scripts/users/usersDatatables.js') !!}
    {!! HTML::script('scripts/users/users.js') !!}
    {!! HTML::script('scripts/laroute.js') !!}

    <script>
        jQuery(document).ready(function () {
            moment.locale('es');
            usersDatatables.initUsersListDatatable();
            usersDatatables.initDatatableColumnVisibility();
            users.initDateRangePicker('{{Session::get('users_filters')['from_register_date']}}', '{{Session::get('users_filters')['to_register_date']}}');
            $('#form_roles').select2({
                placeholder: "Roles",
                allowClear: true
            });
            users.initFilter();
            users.initRefreshFilter();
        });
    </script>
@endsection