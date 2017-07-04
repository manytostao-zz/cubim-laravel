@extends('layouts.master')

@section('title_section')
    <title>CUBIM - Administración</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @endsection

    @section('styles_section')
    {!! HTML::style('plugins/select2/select2.css') !!}
    @endsection

    @section('content_section')
            <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Editar cuenta de usuario
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-users"></i>
                <a href="{{URL::route('users.index')}}">Cuentas de usuario</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{URL::route('users.edit', $usuario->id)}}">Editar cuenta</a>
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
@endsection