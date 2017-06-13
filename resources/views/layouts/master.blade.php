<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    @yield('title_section')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"--}}
    {{--type="text/css"/>--}}
    {!! HTML::style('plugins/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('plugins/simple-line-icons/simple-line-icons.min.css') !!}
    {!! HTML::style('plugins/bootstrap/css/bootstrap.min.css') !!}
    {!! HTML::style('plugins/uniform/css/uniform.default.css') !!}
    {!! HTML::style('plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('styles_section')
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    {!! HTML::style('css/components-md.css') !!}
    {!! HTML::style('css/plugins-md.css') !!}
    {!! HTML::style('css/layout.css') !!}
    {!! HTML::style('css/darkblue.css') !!}
    {!! HTML::style('css/olive.css') !!}
    {!! HTML::style('css/custom.css') !!}
            <!-- END THEME STYLES -->
    {{--<link rel="shortcut icon" href="favicon.ico"/>--}}
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-fixed page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{URL::route('home')}}">
                {!! HTML::image('img/logo_cubim.png', 'logo', ['width' => '190px', 'heigh' => '46px' ]) !!}
            </a>
            {{--<div class="menu-toggler sidebar-toggler">--}}
            {{--<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->--}}
            {{--</div>--}}
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        @include('partials.top_menu_partial')
                <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    @include('partials.left_sidebar_menu_partial')
            <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            @yield('content_section')
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    @include('partials.right_sidebar_menu_partial')
            <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2017 &copy; CUBiM por <a
                href="http://codechanic.wordpress.com"
                title="Codechanich en WordPress" target="_blank">Codechanic</a>.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
{!! HTML::script('plugins/respond.min.js') !!}
{!! HTML::script('plugins/excanvas.min.js') !!}
<![endif]-->
{!! HTML::script('plugins/jquery.min.js') !!}
{!! HTML::script('plugins/jquery-migrate.min.js') !!}
        <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
{!! HTML::script('plugins/jquery-ui/jquery-ui.min.js') !!}
{!! HTML::script('plugins/bootstrap/js/bootstrap.min.js') !!}
{!! HTML::script('plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
{!! HTML::script('plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{!! HTML::script('plugins/jquery.blockui.min.js') !!}
{!! HTML::script('plugins/jquery.cokie.min.js') !!}
{!! HTML::script('plugins/uniform/jquery.uniform.min.js') !!}
{!! HTML::script('plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
        <!-- END CORE PLUGINS -->
@yield('scripts_section')
{!! HTML::script('scripts/metronic.js') !!}
{!! HTML::script('scripts/layout.js') !!}
{!! HTML::script('scripts/quick-sidebar.js') !!}
{!! HTML::script('scripts/demo.js') !!}
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>