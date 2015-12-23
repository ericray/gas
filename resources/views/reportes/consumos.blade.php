@extends('layouts.app')
@section('title','Consumos de clientes')
@section('page-title')
    <h4><i class="icon-chart"></i> Reporte</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Consumos de clientes</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Importe</th>
                        <th>Cliente</th>
                        <th>Coche</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consumos as $consumo)
                        <tr>
                            <td>${{ number_format($consumo->importe,2) }}</td>
                            <td>
                                {{ $consumo->cliente->persona->primer_nombre }}
                                {{ $consumo->cliente->persona->segundo_nombre }}
                                {{ $consumo->cliente->persona->primer_apellido }}
                                {{ $consumo->cliente->persona->segundo_apellido }}
                            </td>
                            <td>{{ $consumo->coche->marca }}</td>
                            <td>{{ $consumo->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection