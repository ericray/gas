<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    {!! Html::meta('viewport','width=device-width, initial-scale=1') !!}
    {!! Html::meta(null,'IE=edge',['http-equiv' => 'X-UA-Compatible']) !!}
    <title>@yield('title','Bienvenido')</title>

    <!-- Global stylesheets -->
    {!! Html::style('https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900') !!}
    {!! Html::style(asset('theme/css/index.css')) !!}
    {!! Html::style(asset('theme/css/icons/styles.css')) !!}
    {!! Html::style(asset('theme/css/bootstrap.css')) !!}
    {!! Html::style(asset('theme/css/core.css')) !!}
    {!! Html::style(asset('theme/css/components.css')) !!}
    {!! Html::style(asset('theme/css/colors.css')) !!}
    {!! Html::style(asset('plugins/font-awesome/css/font-awesome.min.css')) !!}
    <!-- /Global stylesheets -->
    @yield('styles')
</head>
<body class="place-done">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <!-- Main navbar -->
    @include('layouts.mainbar')
    <!-- /main navbar -->

    <!-- Page container -->
    <div class="page-container" style="min-height: 563px">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            @include('layouts.sidebar')
            <!-- /main sidebar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            @yield('page-title')
                        </div>
                        <div class="heading-elements">
                            @yield('heading-elements')
                        </div>
                    </div>
                </div>
                <!-- Content -->
                <div class="content">
                    @yield('content')
                </div>
                <!-- /content -->
            </div>
            <!-- /content wrapper -->
        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

    <!-- Core JS Files -->
    {!! Html::script(asset('theme/js/pace.min.js')) !!}
    {!! Html::script(asset('plugins/jquery/jquery.min.js')) !!}
    {!! Html::script(asset('plugins/bootstrap/js/bootstrap.min.js')) !!}
    {!! Html::script(asset('theme/js/blockui.min.js')) !!}
    <!-- /Core JS Files -->

    <!-- Theme JS File -->
    {!! Html::script(asset('theme/js/d3.min.js')) !!}
    {!! Html::script(asset('theme/js/d3_tooltip.js')) !!}
    {!! Html::script(asset('theme/js/switchery.min.js')) !!}
    {!! Html::script(asset('theme/js/uniform.min.js')) !!}
    {!! Html::script(asset('theme/js/moment.min.js')) !!}
    {!! Html::script(asset('theme/js/daterangepicker.js')) !!}
    {!! Html::script(asset('theme/js/app.js')) !!}
    <!-- /Theme JS File -->

    @yield('scripts')
</body>
</html>