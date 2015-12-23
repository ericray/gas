@extends('layouts.app')
@section('title',$title)
@section('page-title')
    <h4><i class="icon-users"></i> Asociado</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{ $title }}</h5>
        </div>
        <div class="panel-body">
            {!! Form::model($asociado,$form_data) !!}
                {!! $cliente_id_field !!}
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
                    <div class="col-md-3">
                        {!! Form::label('domicilio') !!}
                        {!! Form::textarea('domicilio',null,['class' => 'form-control','rows' => 3]) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('telefono_fijo','Teléfono fijo') !!}
                        {!! Form::text('telefono_fijo',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('telefono_movil','Teléfono móvil') !!}
                        {!! Form::text('telefono_movil',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        {!! Form::label('correo') !!}
                        {!! Form::email('correo',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! link_to_route('cliente.asociados','Cancelar',$cliente_id,['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection