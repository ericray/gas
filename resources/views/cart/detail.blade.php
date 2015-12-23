@extends('layouts.app')
@section('title','Carro de compras')
@section('page-title')
    <h4>Detalle del carro</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Productos agregados al carro</h5>
            <div class="heading-elements">

                <div class="col-md-12">
                    <div class="col-md-7">
                        {!! link_to_route('home','Seguir comprando',[],['class' => 'btn btn-default']) !!}
                    </div>
                    <div class="col-md-5">
                        {!! link_to_route('client.choose','Continuar',[],['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="table-repsonsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{  number_format($item->price,2) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>{{ Cart::totalItems() }}</td>
                        <td>${{ number_format(Cart::total(),2) }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection