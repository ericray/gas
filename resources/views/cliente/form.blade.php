@extends('layouts.app')
@section('title','Agregar cliente')
@section('page-title')
    <h4><i class="icon-users"></i> Clientes</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4>Agregar cliente</h4>
        </div>
        <div class="panel-body">
            @include('errors.errors_request')
        {!! Form::open(['route' => 'cliente.store','class' => 'form-horizontal']) !!}
            <fieldset class="content-group">
                <legend class="text-bold">Datos generales</legend>
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

                <div class="col-md-3">
                    {!! Form::label('fecha_nacimiento','Fecha de nacimiento') !!}
                    {!! Form::text('fecha_nacimiento',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('curp','CURP') !!}
                    {!! Form::text('curp',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('rfc','RFC') !!}
                    {!! Form::text('rfc',null,['class' => 'form-control']) !!}
                </div>
            </fieldset>
            <fieldset class="content-group">
                <legend class="text-bold">Datos de contacto</legend>

                <div class="col-md-3">
                    {!! Form::label('calle') !!}
                    {!! Form::text('calle',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('numero_interior','Número interior') !!}
                    {!! Form::text('numero_interior',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('numero_exterior','Número exterior') !!}
                    {!! Form::text('numero_exterior',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('cruzamientos') !!}
                    {!! Form::text('cruzamientos',null,['class' => 'form-control']) !!}
                </div>

                <div class="col-md-3">
                    {!! Form::label('entidad_federativa','Entidad federativa') !!}
                    {!! Form::text('entidad_federativa',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('municipio') !!}
                    {!! Form::text('municipio',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('asentamiento') !!}
                    {!! Form::text('asentamiento',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('correo') !!}
                    {!! Form::email('correo',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('telefono_fijo','Teléfono fijo') !!}
                    {!! Form::text('telefono_fijo',null,['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('telefono_movil','Teléfono móvil') !!}
                    {!! Form::text('telefono_movil',null,['class' => 'form-control']) !!}
                </div>
            </fieldset>

            <fieldset class="content-group">
                <legend class="text-bold">Datos de la cuenta</legend>
                <div class="row">
                    <div class="col-md-3">
                        {!! Form::label('codigo_barras','Código de barras') !!}
                        {!! Form::text('codigo_barras',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('descripcion','Descripción') !!}
                        {!! Form::text('descripcion',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('periodicidad_consumo','Periodicidad de consumo') !!}
                        {!! Form::text('periodicidad_consumo',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        {!! Form::label('pregunta','Pregunta secreta') !!}
                        {!! Form::select('pregunta',$tipos_preguntas,null,['class' => 'form-control','placeholder' => 'Seleccione una pregunta...']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('respuesta','Respuesta de la pregunta secreta') !!}
                        {!! Form::text('respuesta',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('sucursal_gasolinera_id','Sucursal') !!}
                        {!! Form::select('sucursal_gasolinera_id',$sucursales,null,['class' => 'form-control','placeholder' => 'Seleccione una sucursal...']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        {!! Form::label('name','Usuario') !!}
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('password','Contraseña') !!}
                        {!! Form::password('password',['class' => 'form-control']) !!}
                    </div>
                </div>
            </fieldset>
            <div class="text-right">
                {!! link_to_route('cliente.index','Cancelar',[],['class' => 'btn btn-default']) !!}
                {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
        </div>
    </div>
@endsection