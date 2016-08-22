<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
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
    <title>CUBiM | Acceso</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {!! HTML::style('plugins/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('plugins/simple-line-icons/simple-line-icons.min.css') !!}
    {!! HTML::style('plugins/bootstrap/css/bootstrap.min.css') !!}
    {!! HTML::style('plugins/uniform/css/uniform.default.css') !!}
            <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style('css/login.css') !!}
            <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    {!! HTML::style('css/components-md.css') !!}
    {!! HTML::style('css/plugins-md.css') !!}
    {!! HTML::style('css/layout.css') !!}
    {!! HTML::style('css/darkblue.css') !!}
    {!! HTML::style('css/olive.css') !!}
    {!! HTML::style('css/custom.css') !!}
            <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md login">
<!-- BEGIN LOGO -->
<div class="logo">

</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    {!! Form::open(array('method' => 'post', 'route' => ['auth.login'], 'class' => 'login-form', 'id'=>'form_login')) !!}
    <div class="row" style="text-align: center">
        {!! HTML::image('img/logo_cubim.png', 'logo', ['width' => '225px' ]) !!}
        <h3 class="form-title">Introduzca sus credenciales</h3>
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
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Usuario</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            {!! Form::text('email', null, array('class'=>"form-control placeholder-no-fix", 'autocomplete'=>"off", 'placeholder' =>"Usuario", 'id'=>'form_email')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Contrase&ntilde;a</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            {!! Form::password('password', array('class'=>'form-control placeholder-no-fix', 'autocomplete'=>"off", 'placeholder' =>"Contraseña", 'id'=>'form_password')) !!}
        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox">
            <div class="md-checkbox">
                {!! Form::checkbox('remember_me', null, true, array('class'=>'md-check', 'id'=>'form_remember_me')) !!}
                <label for="form_remember_me">
                    <span></span>
                    <span class="check login-check"></span>
                    <span class="box"></span>
                    Recu&eacute;rdame </label>
            </div>
        </label>
        {!! Form::submit('Acceder', array('class'=>'btn green-haze pull-right')) !!}
    </div>
    {!! Form::close() !!}
            <!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2016 &copy; CUBiM por <a style="color: #ffffff;"
                             href="http://codechanic.wordpress.com"
                             title="Codechanich en WordPress" target="_blank">Codechanic</a>.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
{!! HTML::script('plugins/respond.min.js') !!}
{!! HTML::script('plugins/excanvas.min.js') !!}
<![endif]-->
{!! HTML::script('plugins/jquery.min.js') !!}
{!! HTML::script('plugins/jquery-migrate.min.js') !!}
{!! HTML::script('plugins/bootstrap/js/bootstrap.min.js') !!}
{!! HTML::script('plugins/jquery.blockui.min.js') !!}
{!! HTML::script('plugins/jquery.cokie.min.js') !!}
{!! HTML::script('plugins/uniform/jquery.uniform.min.js') !!}
        <!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! HTML::script('plugins/jquery-validation/js/jquery.validate.min.js') !!}
        <!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

{!! HTML::script('scripts/metronic.js') !!}
{!! HTML::script('scripts/layout.js') !!}
{!! HTML::script('scripts/demo.js') !!}
{!! HTML::script('scripts/login.js') !!}
        <!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>