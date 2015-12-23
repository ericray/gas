@extends('layouts.app')
@section('page-title')
    <h4><i class="icon-user"></i> Usuario</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4>{{ $title }}</h4>
        </div>
        {!! Form::model($usuario,$form_data) !!}
            <div class="panel-body">
                @include('errors.errors_request')
                <fieldset class="content-group">
                    <legend>Datos generales</legend>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('primer_nombre','Primer nombre') !!}
                            {!! Form::text('primer_nombre',null,['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('segundo_nombre','Segundo nombre') !!}
                            {!! Form::text('segundo_nombre',null,['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('primer_apellido','Primer apellido') !!}
                            {!! Form::text('primer_apellido',null,['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('segundo_apellido','Segundo apellido') !!}
                            {!! Form::text('segundo_apellido',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('fecha_nacimiento','Fecha de nacimiento') !!}
                            {!! Form::text('fecha_nacimiento',null,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <legend>Datos de usuario</legend>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('name','Usuario') !!}
                            {!! Form::text('name',null,['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('email','Correo electrónico') !!}
                            {!! Form::email('email',null,['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! $password_field !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('roles') !!}
                            {!! Form::select('roles[]',$roles,$myroles,['class' => 'form-control select2-roles','multiple']) !!}
                        </div>
                    </div>
                </fieldset>
                <div class="text-right">
                    {!! link_to_route('usuario.index','Cancelar',[],['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('styles')
    {!! Html::style(asset('plugins/chosen/css/chosen.css')) !!}
    <style>
        .select2-roles{
            display: none;
        }
    </style>
@endsection
@section('scripts')
    {!! Html::script(asset('plugins/chosen/js/chosen.jquery.min.js')) !!}
    {!! Html::script(asset('plugins/select2/js/select2.js')) !!}
    <script>
        $(function () {
            $('.select2-roles').show();
            $('.select2-roles').select2();
        });
    </script>
@endsection