<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200">
            <li @if($active['sup'] == 'dashboard') class="start active open" @endif>
                <a href="{{ URL::route('home') }}">
                    <i class="icon-home"></i>
                    <span class="title">Panel Resumen</span>
                </a>
            </li>
            <li @if($active['sup'] == 'registro') class="start active open" @endif>
                <a href="{{ URL::route('customers.index') }}">
                    <i class="icon-users"></i>
                    <span class="title">Registro</span>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-login"></i>
                    <span class="title">Recepci&oacute;n</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="layout_horizontal_sidebar_menu.html">
                            <i class="icon-users"></i>
                            Usuarios</a>
                    </li>
                    <li>
                        <a href="index_horizontal_menu.html">
                            <i class="icon-directions"></i>
                            Entradas/Salidas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-info"></i>
                    <span class="title">Referencia</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="ui_general.html">
                            <i class="icon-users"></i>
                            Usuarios</a>
                    </li>
                    <li>
                        <a href="ui_buttons.html">
                            <i class="icon-question"></i>
                            Preguntas/Respuestas</a>
                    </li>
                    <li>
                        <a href="ui_confirmations.html">
                            <i class="icon-bulb"></i>
                            Solicitudes/Respuestas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-puzzle"></i>
                    <span class="title">DSI</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="components_pickers.html">
                            <i class="icon-users"></i>
                            Usuarios</a>
                    </li>
                    <li>
                        <a href="components_context_menu.html">
                            <i class="icon-question"></i>
                            Preguntas/Respuestas</a>
                    </li>
                    <li>
                        <a href="components_dropdowns.html">
                            <i class="icon-bulb"></i>
                            Solicitudes/Respuestas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-list"></i>
                    <span class="title">Bibliograf&iacute;a</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="form_controls_md.html">
                            <i class="icon-users"></i>
                            Usuarios</a>
                    </li>
                    <li>
                        <a href="form_controls.html">
                            <i class="icon-bulb"></i>
                            Solicitudes/Respuestas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-screen-desktop"></i>
                    <span class="title">Sala de Navegaci&oacute;n</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="table_basic.html">
                            <i class="icon-users"></i>
                            Usuarios</a>
                    </li>
                    <li>
                        <a href="table_tree.html">
                            <i class="icon-directions"></i>
                            Entradas/Salidas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-book-open"></i>
                    <span class="title">Sala de Lectura</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="portlet_general.html">
                            <i class="icon-users"></i>
                            Usuarios</a>
                    </li>
                    <li>
                        <a href="portlet_general2.html">
                            <i class="icon-directions"></i>
                            Entradas/Salidas</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>