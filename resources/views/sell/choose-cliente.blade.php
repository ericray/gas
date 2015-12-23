@extends('layouts.app')
@section('title','Seleccionar cliente')
@section('page-title')
    <h4><div class="i icon-bag"></div> Venta</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Seleccionar cliente</h5>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'client.choose','class' => 'navbar-form navbar-right','method' => 'get']) !!}
            <div class="form-group">
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                    {!! Form::text('s',null,['class' => 'form-control','placeholder' => 'Buscar']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="table-responsive">


            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre_completo }}</td>
                            <td>
                                {!! Form::open(['url' => 'generar_orden']) !!}
                                    {!! Form::hidden('cliente_id',$cliente->id) !!}
                                    {!! Form::submit('Seleccionar',['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection