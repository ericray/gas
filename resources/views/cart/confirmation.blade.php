@extends('layouts.app')
@section('title','Confirmación de orden')
@section('page-title')
    <h4><i class="icon-bag"></i> Orden</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Confirmación de compra</h5>
            <div class="heading-elements">
                <div class="col-md-12">
                    <div class="col-md-6">
                        {!! link_to_route('cart.finish','Continuar',[],['class' => 'btn btn-primary']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => 'cart.cancel']) !!}
                            {!! Form::submit('Cancelar compra',['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                <li><b>Folio</b>: {{ $orden->id }}</li>
                <li><b>Total de orden</b>: ${{ number_format($orden->total_productos,2) }}</li>
                <li><b>Cantidad de productos</b>: {{ $orden->numero_productos }}</li>
            </ul>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos_detalle as $prod)
                        <tr>
                            <td>{{ $prod->nombre }}</td>
                            <td>${{ number_format($prod->precio,2) }}</td>
                            <td>{{ $prod->cantidad }}</td>
                            <td>${{ number_format(($prod->cantidad * $prod->precio),2)  }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Total</td>
                        <td>{{ $orden->numero_productos }}</td>
                        <td>${{ number_format($orden->total_productos,2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection