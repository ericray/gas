@extends('layouts.app')
@section('title','Órdenes de compra')
@section('page-title')
    <h4><i class="icon-chart"></i> Reporte</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Órdenes de compra</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Importe</th>
                        <th>Cliente</th>
                        <th>Estatus</th>
                        <th>Tipo de pago</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordenes as $orden)
                        <tr>
                            <td>${{ number_format($orden->importe,2) }}</td>
                            <td>{{ $orden->cliente }}</td>
                            <td>
                                @if($orden->estatus == 1)
                                    <span class="label label-primary">Activo</span>
                                @elseif($orden->estatus == 2)
                                    <span class="label label-danger">Cancelado</span>
                                @elseif($orden->estatus == 3)
                                    <span class="label label-success">Finalizado</span>
                                @endif
                            </td>
                            <td>{{ $orden->tipo_pago }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection