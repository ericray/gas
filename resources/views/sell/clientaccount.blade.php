@extends('layouts.app')
@section('title',$title)
@section('page-title')
    <h4><i class="icon-user"></i> Cuenta</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Cuenta de cliente: {{ $cliente->persona->primer_nombre }}</h5>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                <li><b>Periodicidad de consumo</b>: {{ $cliente->cuenta->periodicidad_consumo }}.</li>
                <li><b>Crédito disponible</b>: ${{ number_format($cliente->cuenta->credito_disponible,2) }}</li>
            </ul>
            <fieldset>
                <legend class="content-group">Cargar gasolina</legend>
                @include('errors.errors_request')
                {!! Form::open(['route' => ['cliente.cargar',$cliente->cuenta->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('Coche') !!}
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::select('coche_id',$coches,null,['class' => 'form-control','placeholder' => 'Seleccione un coche']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::label('consumo','Cantidad a consumir') !!}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                {!! Form::text('consumo', null,['class' => 'form-control']) !!}
                                <div class="input-group-btn">
                                    {!! Form::submit('Cargar',['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </fieldset>
        </div>
    </div>
@endsection