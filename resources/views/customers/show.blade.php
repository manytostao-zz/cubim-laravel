@extends('layouts.master')

@section('title_section')
    <title>CUBIM - Registro</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @endsection

    @section('styles_section')
    @endsection

    @section('content_section')
            <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Ficha de usuario
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-users"></i>
                <a href="{{URL::route('customers.index')}}">Listado de Usuarios</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{URL::route('customers.show', $customer->id)}}">Ficha de usuario</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <a class="btn btn-fit-height blue" data-close-others="true">
                    <i class="fa fa-plus"></i> Nuevo usuario
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
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user"></i>{{$customer->name}} {{$customer->last_name}}
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">Acciones <i
                                        class="fa fa-angle-down"></i></button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="{{ URL::route('customers.edit', $customer->id) }}">
                                        <i class="fa fa-pencil"></i> Editar </a>
                                </li>
                                <li>
                                    <a id="ban" href="javascript:;">
                                        @if(!is_null($customer->banned) && $customer->banned == 1)
                                            <i class="fa fa-check"></i> Permitir
                                        @else
                                            <i class="fa fa-ban"></i> Restringir
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a id="activate" href="javascript:;">
                                        @if(!is_null($customer->active) && $customer->active == 1)
                                            <i class="fa fa-ban"></i> Inactivar
                                        @else
                                            <i class="fa fa-check"></i> Activar
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="#delete_confirmation" data-toggle="modal">
                                        <i class="fa fa-trash"></i> Eliminar </a>
                                </li>
                            </ul>
                        </div>
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
                                <li>
                                    <a href="#categorias_tab" data-toggle="tab">
                                        <i class="fa fa-star-half-full"></i> Categor&iacute;as </a>
                                </li>
                                <li>
                                    <a href="#historial_tab" data-toggle="tab">
                                        <i class="fa fa-list-alt"></i> Historial </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personales_tab">
                                    <div class="portlet light">
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table role="grid" id="personales"
                                                       class="table table-hover">
                                                    <tbody>
                                                    <tr role="row">
                                                        <td>
                                                            Carnet de Identidad
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">{{ $customer->id_card }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>
                                                            Pa&iacute;s
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">
                                                                {{
                                                                !is_null($customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 12;
                                                                    })->first())?$customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 12;
                                                                    })->first()->description:''
                                                                }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Correo Electr&oacute;nico
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">{{ $customer->email }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Tel&eacute;fono
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">{{ $customer->phone }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Fecha de Inscripci&oacute;n
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">{{ date('d/m/Y',strtotime($customer->created_at)) }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Tema de Investigaci&oacute;n
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">{{ $customer->topic }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Atendido por
                                                        </td>
                                                        <td>
                                                            @if (!is_null($customer->user))
                                                                <p style="text-align: right; font-style: italic">{{ $customer->user->first_name }} {{ $customer->user->last_name }}</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Observaciones
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">{{ $customer->comments }}</p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profesionales_tab">
                                    <div class="portlet light">
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table role="grid" id="profesionales"
                                                       class="table table-hover">
                                                    <tbody>
                                                    <tr role="row">
                                                        <td>
                                                            Estudiante
                                                        </td>
                                                        <td>
                                                            @if (!is_null($customer->student) &&  $customer->student)
                                                                <p style="text-align: right; font-style: italic">
                                                                    S&iacute;</p>
                                                            @else
                                                                <p style="text-align: right; font-style: italic">No</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>
                                                            @if (!is_null($customer->student) &&  $customer->student)
                                                                Carrera en salud
                                                            @else
                                                                Tipo de profesional
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">
                                                                {{
                                                                    !is_null($customer->nomenclators->filter(
                                                                        function($nomenclator){
                                                                            return $nomenclator->nomenclator_type_id == 1;
                                                                        })->first())?$customer->nomenclators->filter(
                                                                        function($nomenclator){
                                                                            return $nomenclator->nomenclator_type_id == 1;
                                                                        })->first()->description:''
                                                                    }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @if (!is_null($customer->student) &&  $customer->student)
                                                                Carrera fuera de salud
                                                            @else
                                                                Profesi&oacute;n
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">
                                                                {{
                                                                    !is_null($customer->nomenclators->filter(
                                                                        function($nomenclator){
                                                                            return $nomenclator->nomenclator_type_id == 3;
                                                                        })->first())?$customer->nomenclators->filter(
                                                                        function($nomenclator){
                                                                            return $nomenclator->nomenclator_type_id == 3;
                                                                        })->first()->description:''
                                                                }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    @if (is_null($customer->student) ||  !$customer->student)
                                                        <tr>
                                                            <td>
                                                                Especialidad
                                                            </td>
                                                            <td>
                                                                <p style="text-align: right; font-style: italic">
                                                                    {{
                                                                        !is_null($customer->nomenclators->filter(
                                                                            function($nomenclator){
                                                                                return $nomenclator->nomenclator_type_id == 2;
                                                                            })->first())?$customer->nomenclators->filter(
                                                                            function($nomenclator){
                                                                                return $nomenclator->nomenclator_type_id == 2;
                                                                            })->first()->description:''
                                                                    }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Cargo
                                                            </td>
                                                            <td>
                                                                <p style="text-align: right; font-style: italic">
                                                                    {{
                                                                        !is_null($customer->nomenclators->filter(
                                                                            function($nomenclator){
                                                                                return $nomenclator->nomenclator_type_id == 4;
                                                                            })->first())?$customer->nomenclators->filter(
                                                                            function($nomenclator){
                                                                                return $nomenclator->nomenclator_type_id == 4;
                                                                            })->first()->description:''
                                                                    }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Instituci&oacute;n
                                                            </td>
                                                            <td>
                                                                <p style="text-align: right; font-style: italic">
                                                                    {{
                                                                        !is_null($customer->nomenclators->filter(
                                                                            function($nomenclator){
                                                                                return $nomenclator->nomenclator_type_id == 5;
                                                                            })->first())?$customer->nomenclators->filter(
                                                                            function($nomenclator){
                                                                                return $nomenclator->nomenclator_type_id == 5;
                                                                            })->first()->description:''
                                                                    }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Dedicaci&oacute;n
                                                            </td>
                                                            <td>
                                                                <p style="text-align: right; font-style: italic">
                                                                    {{
                                                                        !is_null($customer->nomenclators->filter(
                                                                            function($nomenclator){
                                                                                return $nomenclator->nomenclator_type_id == 6;
                                                                            })->first())?$customer->nomenclators->filter(
                                                                            function($nomenclator){
                                                                                return $nomenclator->nomenclator_type_id == 6;
                                                                            })->first()->description:''
                                                                    }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr role="row">
                                                            <td>
                                                                Experiencia (en a&ntilde;os)
                                                            </td>
                                                            <td>
                                                                <p style="text-align: right; font-style: italic">{{ $customer->experience }}</p>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="categorias_tab">
                                    <div class="portlet light">
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table role="grid" id="categorias"
                                                       class="table table-hover">
                                                    <tbody>
                                                    <tr role="row">
                                                        <td>
                                                            Docente
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">
                                                                {{
                                                                !is_null($customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 7;
                                                                    })->first())?$customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 7;
                                                                    })->first()->description:''
                                                                }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>
                                                            Investigativa
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">
                                                                {{
                                                                !is_null($customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 9;
                                                                    })->first())?$customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 9;
                                                                    })->first()->description:''
                                                                }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>
                                                            Cient&iacute;fica
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">
                                                                {{
                                                                !is_null($customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 10;
                                                                    })->first())?$customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 10;
                                                                    })->first()->description:''
                                                                }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>
                                                            Ocupacional
                                                        </td>
                                                        <td>
                                                            <p style="text-align: right; font-style: italic">
                                                                {{
                                                                !is_null($customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 8;
                                                                    })->first())?$customer->nomenclators->filter(
                                                                    function($nomenclator){
                                                                        return $nomenclator->nomenclator_type_id == 8;
                                                                    })->first()->description:''
                                                                }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="historial_tab">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="panel-group" id="accordion1">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accordion1_1" data-parent="#accordion1"
                                                           data-toggle="collapse" class="accordion-toggle">
                                                            1. Anim pariatur cliche reprehenderit, enim eiusmod high
                                                            life accusamus terry ? </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse in" id="accordion1_1">
                                                    <div class="panel-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                                        accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                        non cupidatat skateboard dolor brunch. Food truck quinoa
                                                        nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
                                                        put a bird on it squid single-origin coffee nulla assumenda
                                                        shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                                        wes anderson cred nesciunt sapiente ea proident. Ad vegan
                                                        excepteur butcher vice lomo. Leggings occaecat craft beer
                                                        farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                        haven't heard of them accusamus labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accordion1_2" data-parent="#accordion1"
                                                           data-toggle="collapse" class="accordion-toggle">
                                                            2. Anim pariatur cliche reprehenderit, enim eiusmod high
                                                            life accusamus terry ? </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="accordion1_2">
                                                    <div class="panel-body">
                                                        Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                        tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                        nulla assumenda shoreditch et. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim
                                                        keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                                        synth nesciunt you probably haven't heard of them accusamus
                                                        labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accordion1_3" data-parent="#accordion1"
                                                           data-toggle="collapse" class="accordion-toggle">
                                                            3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                            moon tempor ? </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="accordion1_3">
                                                    <div class="panel-body">
                                                        Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                        tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                        nulla assumenda shoreditch et. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim
                                                        keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic
                                                        synth nesciunt you probably haven't heard of them accusamus
                                                        labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-warning">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accordion1_4" data-parent="#accordion1"
                                                           data-toggle="collapse" class="accordion-toggle">
                                                            4. Wolf moon officia aute, non cupidatat skateboard dolor
                                                            brunch ? </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="accordion1_4">
                                                    <div class="panel-body">
                                                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                                        Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                        tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                        nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                                        craft beer labore wes anderson cred nesciunt sapiente ea
                                                        proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                        occaecat craft beer farm-to-table, raw denim aesthetic synth
                                                        nesciunt you probably haven't heard of them accusamus labore
                                                        sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-danger">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accordion1_5" data-parent="#accordion1"
                                                           data-toggle="collapse" class="accordion-toggle">
                                                            5. Leggings occaecat craft beer farm-to-table, raw denim
                                                            aesthetic ? </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="accordion1_5">
                                                    <div class="panel-body">
                                                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                                        Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                        tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                        nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                                        craft beer labore wes anderson cred nesciunt sapiente ea
                                                        proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                        occaecat craft beer farm-to-table, raw denim aesthetic synth
                                                        nesciunt you probably haven't heard of them accusamus labore
                                                        sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                        Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accordion1_6" data-parent="#accordion1"
                                                           data-toggle="collapse" class="accordion-toggle">
                                                            6. Leggings occaecat craft beer farm-to-table, raw denim
                                                            aesthetic synth ? </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="accordion1_6">
                                                    <div class="panel-body">
                                                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                                        Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                        tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                        nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                                        craft beer labore wes anderson cred nesciunt sapiente ea
                                                        proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                        occaecat craft beer farm-to-table, raw denim aesthetic synth
                                                        nesciunt you probably haven't heard of them accusamus labore
                                                        sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                        Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accordion1_7" data-parent="#accordion1"
                                                           data-toggle="collapse" class="accordion-toggle">
                                                            7. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                            craft ? </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="accordion1_7">
                                                    <div class="panel-body">
                                                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                                        Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                        tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                        nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                                        craft beer labore wes anderson cred nesciunt sapiente ea
                                                        proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                        occaecat craft beer farm-to-table, raw denim aesthetic synth
                                                        nesciunt you probably haven't heard of them accusamus labore
                                                        sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                        Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et
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
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
    <!-- END PAGE CONTENT-->

    <!-- STARTs MODAL SECTION -->
    <div class="modal fade" id="delete_confirmation" tabindex="-1" role="alert" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirmaci&oacute;n </h4>
                </div>
                <div class="modal-body">
                    &iquest;Est&aacute; seguro de que desea eliminar este usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                    <a class="btn red" href="{{URL::route('customers.destroy', $customer->id)}}" data-method="DELETE"
                       data-token={{ csrf_token() }}>
                        Continuar </a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END MODALS SECTION -->
@endsection

@section('scripts_section')
    {!! HTML::script('scripts/customers/customers.js') !!}
    {!! HTML::script('scripts/laroute.js') !!}
    {!! HTML::script('scripts/laravel.js') !!}

    <script>
        jQuery(document).ready(function () {
            customers.initBanButton('{{$customer->id}}', 'customers.edit');
            customers.initActivateButton('{{$customer->id}}', 'customers.edit');
        });
    </script>
@endsection