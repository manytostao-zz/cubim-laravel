@extends('layouts.master')

@section('title_section')
    <title>CUBiM - Registro</title>
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
        Registro
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-users"></i>
                <a href="{{URL::route('customers.index')}}">Listado de Usuarios</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <a class="btn btn-fit-height blue" data-close-others="true" href="{{URL::route('customers.create')}}">
                    <i class="fa fa-plus"></i> Nuevo Usuario
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
                        <a class="reload" href="javascript:" data-original-title="" title="Limpiar filtros">
                        </a>
                        <a class="expand" href="javascript:" data-original-title="" title="Colapsar/Expandir">
                        </a>
                    </div>
                    <div class="actions">
                        <a id="filter" class="btn default btn-sm" href="javascript:">
                            <i class="fa fa-filter icon-black"></i> Filtrar </a>
                    </div>
                </div>
                <div class="portlet-body display-hide" style="display: none;">
                    {!! Form::open(array('route'=>'customers.index', 'class'=>'form', 'id'=>'filters_form', 'name'=>'form')) !!}
                    <div class="panel-group accordion" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#collapse_1">
                                        Datos personales </a>
                                </h4>
                            </div>
                            <div id="collapse_1" class="panel-collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('name', Session::get('customer_filters')['name'], array('class'=>'form-control', 'placeholder'=>'Nombres', 'id'=>'form_name')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('last_name', Session::get('customer_filters')['last_name'], array('class'=>'form-control', 'placeholder'=>'Apellidos', 'id'=>'form_last_name')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('id_card', Session::get('customer_filters')['id_card'], array('class'=>'form-control', 'placeholder'=>'Carnet de identidad', 'id'=>'form_id_card')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('country', Session::get('customer_filters')['country'], array('class'=>'form-control', 'placeholder'=>'País', 'id'=>'form_country')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('email', Session::get('customer_filters')['email'], array('class'=>'form-control', 'placeholder'=>'Correo', 'id'=>'form_email')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('phone', Session::get('customer_filters')['phone'], array('class'=>'form-control', 'placeholder'=>'Teléfono', 'id'=>'form_phone')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group" id="created_at_range">
                                                        {!! Form::text('created_at',
                                                            Session::get('customer_filters')['from_inscription_date'] != ''?Session::get('customer_filters')['from_inscription_date'].' - '.Session::get('customer_filters')['to_inscription_date']:null,
                                                            array('class'=>'form-control', 'placeholder'=>'Fecha de inscripción', 'id'=>'form_created_at', 'disabled'=>'')) !!}
                                                        <span class="input-group-btn">
												            <button class="btn default date-range-toggle" type="button">
                                                                <i class="fa fa-calendar"></i></button>
												        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('topic', Session::get('customer_filters')['topic'], array('class'=>'form-control', 'placeholder'=>'Tema de investigación', 'id'=>'form_topic')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('comments', Session::get('customer_filters')['comments'], array('class'=>'form-control', 'placeholder'=>'Observaciones', 'id'=>'form_comments')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#collapse_2">
                                        Datos profesionales</a>
                                </h4>
                            </div>
                            <div id="collapse_2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="md-checkbox">
                                                    {!! Form::checkbox('student', Session::get('customer_filters')['student'], Session::get('customer_filters')['student'] == 'true', array('class'=>'md-check', 'id'=>'form_student', 'onclick'=>'Usuario.switchSelectsByCheck()')) !!}
                                                    <label for="form_student">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        Solo estudiantes </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('professional_type', Session::get('customer_filters')['professional_type'], array('class'=>'form-control', 'placeholder'=>'Tipo de profesional', 'id'=>'form_professional_type')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('profession', Session::get('customer_filters')['profession'], array('class'=>'form-control', 'placeholder'=>'Profesión', 'id'=>'form_profession')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row non-student">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('position', Session::get('customer_filters')['position'], array('class'=>'form-control', 'placeholder'=>'Cargo', 'id'=>'form_position')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('institution', Session::get('customer_filters')['institution'], array('class'=>'form-control', 'placeholder'=>'Institución', 'id'=>'form_institution')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('dedication', Session::get('customer_filters')['dedication'], array('class'=>'form-control', 'placeholder'=>'Dedicación', 'id'=>'form_dedication')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row non-student">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::number('experience', Session::get('customer_filters')['experience'], array('class'=>'form-control', 'placeholder'=>'Experiencia', 'id'=>'form_experience')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('customer_type', Session::get('customer_filters')['customer_type'], array('class'=>'form-control', 'placeholder'=>'Tipo de usuario', 'id'=>'form_customer_type')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::text('attended_by', Session::get('customer_filters')['attended_by'], array('class'=>'form-control', 'placeholder'=>'Atendido por', 'id'=>'form_attended_by')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default non-student">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#collapse_3">
                                        Categor&iacute;as </a>
                                </h4>
                            </div>
                            <div id="collapse_3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    {!! Form::text('teaching_category', Session::get('customer_filters')['teaching_category'], array('class'=>'form-control', 'placeholder'=>'Categoría Docente', 'id'=>'form_teaching_category')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    {!! Form::text('scientific_category', Session::get('customer_filters')['scientific_category'], array('class'=>'form-control', 'placeholder'=>'Categoría Científica', 'id'=>'form_scientific_category')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    {!! Form::text('investigative_category', Session::get('customer_filters')['investigative_category'], array('class'=>'form-control', 'placeholder'=>'Categoría Investigativa', 'id'=>'form_investigative_category')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    {!! Form::text('occupational_category', Session::get('customer_filters')['occupational_category'], array('class'=>'form-control', 'placeholder'=>'Categoría Ocupacional', 'id'=>'form_occupational_category')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#collapse_4">
                                        Otros </a>
                                </h4>
                            </div>
                            <div id="collapse_4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="md-checkbox">
                                                    {!! Form::checkbox('currently_in', Session::get('customer_filters')['currently_in'], Session::get('customer_filters')['currently_in'] == 'true', array('class'=>'md-check', 'id'=>'form_currently_in')) !!}
                                                    <label for="form_currently_in">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        Actualmente en la biblioteca </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="md-checkbox">
                                                    {!! Form::checkbox('currently_in_internet_browsing_service', Session::get('customer_filters')['currently_in_internet_browsing_service'], Session::get('customer_filters')['currently_in_internet_browsing_service'] == 'true', array('class'=>'md-check', 'id'=>'form_currently_in_internet_browsing_service')) !!}
                                                    <label for="form_currently_in_internet_browsing_service">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        Actualmente en Sala de Navegaci&oacute;n </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="md-checkbox">
                                                    {!! Form::checkbox('currently_in_reading_service', Session::get('customer_filters')['currently_in_reading_service'], Session::get('customer_filters')['currently_in_reading_service'] == 'true', array('class'=>'md-check', 'id'=>'form_currently_in_reading_service')) !!}
                                                    <label for="form_currently_in_reading_service">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        Actualmente en Sala de Lectura </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="md-checkbox">
                                                    {!! Form::checkbox('inactive', Session::get('customer_filters')['inactive'], Session::get('customer_filters')['inactive'] == 'true', array('class'=>'md-check', 'id'=>'form_inactive')) !!}
                                                    <label for="form_inactive">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        Solo inactivos </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="md-checkbox">
                                                    {!! Form::checkbox('banned', null, Session::get('customer_filters')['banned'] == 'true', array('class'=>'md-check', 'id'=>'form_banned')) !!}
                                                    <label for="form_banned">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        Solo restringidos </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                      data-field="name">Nombre(s)</label>
                                        <label><input type="checkbox" checked data-column="2"
                                                      data-field="last_name">Apellidos</label>
                                        <label><input type="checkbox" data-column="3" data-field="id_card">Carnet de
                                            Identidad</label>
                                        <label><input type="checkbox" data-column="4"
                                                      data-field="phone">Tel&eacute;fono</label>
                                        <label><input type="checkbox" data-column="5" data-field="email">Correo
                                            Electr&oacute;nico</label>
                                        <label><input type="checkbox" data-column="6" data-field="customer_type">Tipo de
                                            Usuario</label>
                                        <label><input type="checkbox" data-column="7" data-field="professional_type">Tipo de
                                            Profesional</label>
                                        <label><input type="checkbox" checked data-column="8" data-field="institution">Instituci&oacute;n</label>
                                        <label><input type="checkbox" checked data-column="9" data-field="library_card">Carnet
                                            de
                                            Usuario</label>
                                        <label><input type="checkbox" data-column="10"
                                                      data-field="specialty">Especialidad</label>
                                        <label><input type="checkbox" data-column="11"
                                                      data-field="profession">Profesi&oacute;n</label>
                                        <label><input type="checkbox" data-column="12"
                                                      data-field="dedication">Dedicaci&oacute;n</label>
                                        <label><input type="checkbox" data-column="13" data-field="occupational_category">Categor&iacute;a
                                            Ocupacional</label>
                                        <label><input type="checkbox" data-column="14" data-field="scientific_category">Categor&iacute;a
                                            Cient&iacute;fica</label>
                                        <label><input type="checkbox" data-column="15" data-field="investigative_category">Categor&iacute;a
                                            Investigativa</label>
                                        <label><input type="checkbox" data-column="16" data-field="teaching_category">Categor&iacute;a
                                            Docente</label>
                                        <label><input type="checkbox" data-column="17"
                                                      data-field="country">Pa&iacute;s</label>
                                        <label><input type="checkbox" data-column="18" data-field="position">Cargo</label>
                                        <label><input type="checkbox" data-column="19" data-field="topic">Tema de
                                            Investigaci&oacute;n</label>
                                        <label><input type="checkbox" data-column="20"
                                                      data-field="comments">Observaciones</label>
                                        <label><input type="checkbox" data-column="21" data-field="attended_by">Atendido
                                            por</label>
                                        <label><input type="checkbox" data-column="22"
                                                      data-field="student">Estudiante</label>
                                        <label><input type="checkbox" checked data-column="23"
                                                      data-field="active">Activo</label>
                                        <label><input type="checkbox" data-column="24"
                                                      data-field="experience">Experiencia</label>
                                        <label><input type="checkbox" checked data-column="25" data-field="created_at">Fecha
                                            de
                                            Inscripci&oacute;n</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTable no-footer"
                           id="usersListDatatable">
                        <thead>
                        <tr>
                            <th data-name="id" style="text-align: left; display: none">
                                Id
                            </th>
                            <th data-name="name" style="text-align: left">
                                Nombre(s)
                            </th>
                            <th data-name="last_name" style="text-align: left">
                                Apellidos
                            </th>
                            <th data-name="id_card" style="text-align: center">
                                Carnet de Identidad
                            </th>
                            <th data-name="phone" class="hidden-xs" style="text-align: center">
                                Tel&eacute;fono
                            </th>
                            <th data-name="email" class="hidden-xs" style="text-align: center">
                                Correo Electr&oacute;nico
                            </th>
                            <th data-name="customer_type" class="hidden-xs" style="text-align: center">
                                Tipo de Usuario
                            </th>
                            <th data-name="professional_type" class="hidden-xs" style="text-align: center">
                                Tipo de Profesional
                            </th>
                            <th data-name="institution" class="hidden-xs" style="text-align: center">
                                Instituci&oacute;n
                            </th>
                            <th data-name="library_card" class="hidden-xs" style="text-align: center">
                                Carnet de Usuario
                            </th>
                            <th data-name="specialty" class="hidden-xs" style="text-align: center">
                                Especialidad
                            </th>
                            <th data-name="profession" class="hidden-xs" style="text-align: center">
                                Profesi&oacute;n
                            </th>
                            <th data-name="dedication" class="hidden-xs" style="text-align: center">
                                Dedicaci&oacute;n
                            </th>
                            <th data-name="occupational_category" class="hidden-xs" style="text-align: center">
                                Categor&iacute;a Ocupacional
                            </th>
                            <th data-name="scientific_category" class="hidden-xs" style="text-align: center">
                                Categor&iacute;a Cient&iacute;fica
                            </th>
                            <th data-name="investigative_category" class="hidden-xs" style="text-align: center">
                                Categor&iacute;a Investigativa
                            </th>
                            <th data-name="teaching_category" class="hidden-xs" style="text-align: center">
                                Categor&iacute;a Docente
                            </th>
                            <th data-name="country" class="hidden-xs" style="text-align: center">
                                Pa&iacute;s
                            </th>
                            <th data-name="position" class="hidden-xs" style="text-align: center">
                                Cargo
                            </th>
                            <th data-name="topic" class="hidden-xs" style="text-align: center">
                                Tema de Investigaci&oacute;n
                            </th>
                            <th data-name="comments" class="hidden-xs" style="text-align: center">
                                Observaciones
                            </th>
                            <th data-name="attended_by" class="hidden-xs" style="text-align: center">
                                Atendido por
                            </th>
                            <th data-name="student" class="hidden-xs" style="text-align: center">
                                Estudiante
                            </th>
                            <th data-name="active" class="hidden-xs" style="text-align: center">
                                Activo
                            </th>
                            <th data-name="experience" class="hidden-xs" style="text-align: center">
                                Experiencia
                            </th>
                            <th data-name="created_at" class="hidden-xs" style="text-align: center">
                                Fecha de Inscripci&oacute;n
                            </th>
                            <th data-name="actions">
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
    {!! HTML::script('scripts/customers/customersDatatables.js') !!}
    {!! HTML::script('scripts/customers/customers.js') !!}
    {!! HTML::script('scripts/laroute.js') !!}

    <script>
        jQuery(document).ready(function () {
            moment.locale('es');
            customersDatatables.initUsersListDatatable();
            customersDatatables.initDatatableColumnVisibility();
            customers.initSpecificSelects();
            customers.initFilter();
            customers.initRefreshFilter();
            customers.switchSelectsByCheck();
            customers.initDateRangePicker('{{Session::get('customer_filters')['from_inscription_date']}}', '{{Session::get('customer_filters')['to_inscription_date']}}');
        });
    </script>
@endsection