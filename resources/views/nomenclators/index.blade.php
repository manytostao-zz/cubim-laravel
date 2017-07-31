@extends('layouts.master')

@section('title_section')
    <title>CUBiM - Nomencladores</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('styles_section')
    {!! HTML::style('plugins/select2/select2.css') !!}
    {!! HTML::style('plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
@endsection

@section('content_section')
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        {{$nomenclator_type->description}}
        <small> Nomenclador</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-users"></i>
                <a href="{{URL::route('nomenclators.index', $nomenclator_type->id)}}">Listado de valores</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <a class="btn btn-fit-height blue" data-close-others="true"
                   href="{{URL::route('nomenclators.create')}}">
                    <i class="fa fa-plus"></i> Nuevo valor
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
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer"
                           id="nomenclatorsListDatatable">
                        <thead>
                        <tr>
                            <th data-name="id" style="text-align: left; display: none">
                                Id
                            </th>
                            <th data-name="description" style="text-align: left">
                                Descripci&oacute;n
                            </th>
                            <th data-name="active" style="text-align: center">
                                Activo
                            </th>
                            <th data-name="created_at">
                                Fecha de creaci&oacute;n
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modal Title</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('method' => 'put', 'route' => ['nomenclators.update', 1], 'class' => 'form', 'id'=>'form_nomenclator')) !!}
                    {!! Form::hidden('id', null, array('class'=>'form-control','id'=>'form_id')) !!}
                    <div class="form-group form-md-line-input">
                        {!! Form::text('description', null, array('class'=>'form-control', 'id'=>'form_description', 'required'=>'required')) !!}
                        <label for="form_email">Descripci&oacute;n</label>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn blue" onclick="$('#form_nomenclator').submit();">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-delete" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">&iexcl;Atenci&oacute;n!</h4>
                </div>
                <div class="modal-body">
                    &iquest;Est&aacute; seguro que desea eliminar este valor?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                    <a id="delete" href="javascript:;" class="btn red" data-method="DELETE"
                       data-token={{ csrf_token() }}>Eliminar</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
    {!! HTML::script('scripts/nomenclators/nomenclatorsDatatables.js') !!}
    {!! HTML::script('scripts/laroute.js') !!}
    {!! HTML::script('scripts/laravel.js') !!}

    <script>
        jQuery(document).ready(function () {
            moment.locale('es');
            nomenclatorsDatatables.initNomenclatorsListDatatable('{{$nomenclator_type->id}}');
        });
    </script>
@endsection