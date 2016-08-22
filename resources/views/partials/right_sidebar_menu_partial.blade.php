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
                <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
                    <div class="page-quick-sidebar-settings-list">
                        <h3 class="list-heading">General Settings</h3>
                        <ul class="list-items borderless">
                            <li>
                                Enable Notifications <input type="checkbox" class="make-switch" checked
                                                            data-size="small" data-on-color="success"
                                                            data-on-text="ON" data-off-color="default"
                                                            data-off-text="OFF">
                            </li>
                            <li>
                                Allow Tracking <input type="checkbox" class="make-switch" data-size="small"
                                                      data-on-color="info" data-on-text="ON"
                                                      data-off-color="default" data-off-text="OFF">
                            </li>
                            <li>
                                Log Errors <input type="checkbox" class="make-switch" checked data-size="small"
                                                  data-on-color="danger" data-on-text="ON" data-off-color="default"
                                                  data-off-text="OFF">
                            </li>
                            <li>
                                Auto Sumbit Issues <input type="checkbox" class="make-switch" data-size="small"
                                                          data-on-color="warning" data-on-text="ON"
                                                          data-off-color="default" data-off-text="OFF">
                            </li>
                            <li>
                                Enable SMS Alerts <input type="checkbox" class="make-switch" checked
                                                         data-size="small" data-on-color="success" data-on-text="ON"
                                                         data-off-color="default" data-off-text="OFF">
                            </li>
                        </ul>
                        <h3 class="list-heading">System Settings</h3>
                        <ul class="list-items borderless">
                            <li>
                                Security Level
                                <select class="form-control input-inline input-sm input-small">
                                    <option value="1">Normal</option>
                                    <option value="2" selected>Medium</option>
                                    <option value="e">High</option>
                                </select>
                            </li>
                            <li>
                                Failed Email Attempts <input class="form-control input-inline input-sm input-small"
                                                             value="5"/>
                            </li>
                            <li>
                                Secondary SMTP Port <input class="form-control input-inline input-sm input-small"
                                                           value="3560"/>
                            </li>
                            <li>
                                Notify On System Error <input type="checkbox" class="make-switch" checked
                                                              data-size="small" data-on-color="danger"
                                                              data-on-text="ON" data-off-color="default"
                                                              data-off-text="OFF">
                            </li>
                            <li>
                                Notify On SMTP Error <input type="checkbox" class="make-switch" checked
                                                            data-size="small" data-on-color="warning"
                                                            data-on-text="ON" data-off-color="default"
                                                            data-off-text="OFF">
                            </li>
                        </ul>
                        <div class="inner-content">
                            <button class="btn btn-success"><i class="icon-settings"></i> Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>