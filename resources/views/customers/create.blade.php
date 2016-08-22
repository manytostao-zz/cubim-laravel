@extends('layouts.master')

@section('title_section')
    <title>CUBIM - Registro</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @endsection

    @section('styles_section')
    {!! HTML::style('plugins/select2/select2.css') !!}
    @endsection

    @section('content_section')
            <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Crear usuario
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-users"></i>
                <a href="{{URL::route('customers.index')}}">Listado de Usuarios</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{URL::route('customers.create')}}">Crear usuario</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <a class="btn btn-fit-height blue" data-close-others="true" onclick="$('#form_customer').submit()">
                    <i class="fa fa-save"></i> Salvar
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
        {!! Form::open(array('method' => 'post', 'route' => ['customers.store'], 'class' => 'form', 'id'=>'form_customer')) !!}
        {!! Form::hidden('id', null, array('class'=>'form-control','id'=>'form_id')) !!}
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="form-inline col-md-8">
                        <div class="form-group form-md-line-input">
                            {!! Form::text('customer_type', null, array('class'=>'form-control', 'placeholder'=>'Tipo de usuario', 'id'=>'form_customer_type')) !!}
                            <div class="form-control-focus">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <div class="input-icon">
                                {!! Form::text('library_card', null, array('class'=>'form-control', 'placeholder'=>'Carnet de biblioteca', 'id'=>'form_library_card')) !!}
                                <div class="form-control-focus">
                                </div>
                                <i class="fa fa-hashtag"></i>
                            </div>
                        </div>
                        <button id="number_suggestion" class="btn btn-info" type="button">Sugerir n&uacute;mero</button>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                <li class="active">
                                    <a href="#personales_tab" data-toggle="tab" aria-expanded="true">
                                        <i class="fa fa-info"></i> Datos personales </a>
                                    <span class="after">
                                    </span>
                                </li>
                                <li>
                                    <a href="#profesionales_tab" data-toggle="tab" aria-expanded="false">
                                        <i class="fa fa-briefcase"></i> Datos profesionales </a>
                                </li>
                                <li class="non-estudiante">
                                    <a href="#categorias_tab" data-toggle="tab">
                                        <i class="fa fa-star-half-full"></i> Categor&iacute;as </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personales_tab">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'form_name')) !!}
                                                    <label for="form_name">Nombre(s)</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('last_name', null, array('class'=>'form-control', 'id'=>'form_last_name')) !!}
                                                    <label for="form_last_name">Apellidos</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('id_card', null, array('class'=>'form-control', 'id'=>'form_id_card')) !!}
                                                    <label for="form_id_card">Carnet de identidad</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('country', null, array('class'=>'form-control', 'id'=>'form_country')) !!}
                                                    <label for="form_country">Pa&iacute;s</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'form_email')) !!}
                                                    <label for="form_email">Correo electr&oacute;nico</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('phone', null, array('class'=>'form-control', 'id'=>'form_phone')) !!}
                                                    <label for="form_phone">Tel&eacute;fono</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('topic', null, array('class'=>'form-control input-lg','id'=>'form_topic')) !!}
                                                    <label for="form_topic">Tema de investigaci&oacute;n</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('comments', null, array('class'=>'form-control input-lg','id'=>'form_comments')) !!}
                                                    <label for="form_comments">Observaciones</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profesionales_tab">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="md-checkbox">
                                                    {!! Form::checkbox('student', null, false, array('class'=>'md-check', 'id'=>'form_student', 'onclick'=>'switchSelectsByCheck()')) !!}
                                                    <label for="form_student">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        Estudiante </label>
                                                </div>
                                                <br/>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('professional_type', null, array('class'=>'form-control', 'id'=>'form_professional_type')) !!}
                                                    <label id="form_professional_type_label" for="form_professional_type">Tipo de
                                                        profesional</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('profession', null, array('class'=>'form-control', 'id'=>'form_profession')) !!}
                                                    <label id="form_profession_label" for="form_profession">Profesi&oacute;n</label>
                                                </div>
                                                <div class="non-student">
                                                    <div class="form-group form-md-line-input">
                                                        {!! Form::text('specialty', null, array('class'=>'form-control', 'id'=>'form_specialty')) !!}
                                                        <label for="form_specialty">Especialidad</label>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        {!! Form::text('position', null, array('class'=>'form-control', 'id'=>'form_position')) !!}
                                                        <label for="form_position">Cargo</label>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        {!! Form::text('institution', null, array('class'=>'form-control', 'id'=>'form_institution')) !!}
                                                        <label for="form_institution">Instituci&oacute;n</label>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        {!! Form::text('dedication', null, array('class'=>'form-control', 'id'=>'form_dedication')) !!}
                                                        <label for="form_dedication">Dedicaci&oacute;n</label>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        {!! Form::number('experience', null, array('class'=>'form-control', 'id'=>'form_experience')) !!}
                                                        <label for="form_experience">Experiencia</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="categorias_tab">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('teaching_category', null, array('class'=>'form-control', 'id'=>'form_teaching_category')) !!}
                                                    <label for="form_teaching_category">Docente</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('investigative_category', null, array('class'=>'form-control', 'id'=>'form_investigative_category')) !!}
                                                    <label for="form_investigative_category">Investigativa</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('scientific_category', null, array('class'=>'form-control', 'id'=>'form_scientific_category')) !!}
                                                    <label for="form_scientific_category">Cient&iacute;fica</label>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    {!! Form::text('occupational_category', null, array('class'=>'form-control', 'id'=>'form_occupational_category')) !!}
                                                    <label for="form_occupational_category">Ocupacional</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
        {!! Form::close() !!}
    </div>
    <!-- END PAGE CONTENT-->
@endsection

@section('scripts_section')
    {!! HTML::script('plugins/select2/select2.min.js') !!}
    {!! HTML::script('plugins/select2/select2_locale_es.js') !!}
    {!! HTML::script('scripts/customers/customers.js') !!}
    {!! HTML::script('scripts/laroute.js') !!}
    {!! HTML::script('scripts/laravel.js') !!}

    <script>
        var switchSelectsByCheck = function () {
            if ($('#form_student').is(':checked')) {
                $('#form_professional_type_label').text('Carrera en salud');
                $('#form_profession_label').text('Carrera fuera de salud');
                $('.non-student').hide();
            } else {
                $('#form_professional_type_label').text('Tipo de profesional');
                $('#form_profession_label').text('Profesión');
                $('.non-student').show();
            }
        };
    </script>

    <script>
        jQuery(document).ready(function () {
            customers.initSpecificSelects(false, false);
            customers.initLastNumberSuggestion();
            switchSelectsByCheck();
        });
    </script>
@endsection