<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    {!! Html::meta('viewport','width=device-width, initial-scale=1') !!}
    {!! Html::meta(null,'IE=edge',['http-equiv' => 'X-UA-Compatible']) !!}
    <title>Iniciar sesión</title>
    <!-- Global stylesheets -->
    {!! Html::style(asset('https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900')) !!}
    {!! Html::style(asset('theme/css/index.css')) !!}
    {!! Html::style(asset('theme/css/icons/styles.css')) !!}
    {!! Html::style(asset('theme/css/bootstrap.css')) !!}
    {!! Html::style(asset('theme/css/core.css')) !!}
    {!! Html::style(asset('theme/css/components.css')) !!}
    {!! Html::style(asset('theme/css/colors.css')) !!}
    {!! Html::style(asset('plugins/font-awesome/css/font-awesome.min.css')) !!}
    <!-- /Global stylesheets -->
</head>
<body>
    <!-- Core JS Files -->
    {!! Html::script(asset('theme/js/pace.min.js')) !!}
    {!! Html::script(asset('plugins/jquery/jquery.min.js')) !!}
    {!! Html::script(asset('plugins/bootstrap/js/bootstrap.min.js')) !!}
    {!! Html::script(asset('theme/js/blockui.min.js')) !!}
    <!-- /Core JS Files -->

    <!-- Page container -->
    <div class="page-container login-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">
                    @include('errors.errors_request')
                    <!-- Simple login form -->
                    {!! Form::open(['route' => 'login']) !!}

                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                                <h5 class="content-group">Iniciar sesión</h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::email('email',null,['class' => 'form-control','placeholder' => 'Correo']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-envelope text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                {!! Form::password('password',['class' => 'form-control','placeholder' => 'Contraseña']) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Entrar <i class="icon-circle-right2 position-right"></i></button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- /simple login form -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

    <!-- Theme JS File -->
    {!! Html::script(asset('theme/js/d3.min.js')) !!}
    {!! Html::script(asset('theme/js/d3_tooltip.js')) !!}
    {!! Html::script(asset('theme/js/switchery.min.js')) !!}
    {!! Html::script(asset('theme/js/uniform.min.js')) !!}
    {!! Html::script(asset('theme/js/moment.min.js')) !!}
    {!! Html::script(asset('theme/js/daterangepicker.js')) !!}
    {!! Html::script(asset('theme/js/app.js')) !!}
</body>
</html>