<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
<div class="page-quick-sidebar-wrapper">
    <div class="page-quick-sidebar">
        <div class="nav-justified">
            <ul class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#admin_sidebar_tab" data-toggle="tab">
                        Administraci&oacute;n
                    </a>
                </li>
                <li>
                    <a href="#nom_sidebar_tab" data-toggle="tab">
                        Nomencladores
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active page-quick-sidebar-chat" id="admin_sidebar_tab">
                    <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd"
                         data-wrapper-class="page-quick-sidebar-list">
                        <ul class="media-list list-items">
                            <li>
                                <a href="{{URL::route('users.index')}}">
                                    <div class="media-body">
                                        <h4 class="media-heading">Cuentas de usuario</h4>
                                        <div class="media-heading-sub">
                                            Gesti&oacute;n y autorizaci&oacute;n
                                        </div>
                                    </div>
                                </a>
                            </li><li>
                                <a href="{{URL::route('traces.index')}}">
                                    <div class="media-body">
                                        <h4 class="media-heading">Trazas</h4>
                                        <div class="media-heading-sub">
                                            Registros del sistema
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane page-quick-sidebar-alerts" id="nom_sidebar_tab">
                    <div class="page-quick-sidebar-alerts-list">
                        <ul class="feeds list-items">
                            @foreach(Request::get('nomenclator_types') as $nomenclator_type)
                                <li>
                                    <a href="{{URL::route('nomenclators.index', ['nomenclator_type_id'=>$nomenclator_type->id])}}">
                                        <div class="col1">
                                            <div class="pull-left">
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        {{$nomenclator_type->description}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>