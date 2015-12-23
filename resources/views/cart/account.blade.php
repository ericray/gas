@extends('layouts.app')
@section('title','Mi cuenta')
@section('page-title')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Mi cuenta</h5>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                <li><b>Crédito disponible</b>: ${{ number_format(auth()->user()->cliente->cuenta->credito_disponible,2) }}</li>
                <li><b>Periodicidad de consumo</b>: {{ auth()->user()->cliente->cuenta->periodicidad_consumo }}.</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Consumos de gasolina</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Importe</th>
                            <th>Fecha</th>
                            <th>Coche</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(auth()->user()->cliente->consumos_clientes as $consumo)
                            <tr>
                                <td>{{ $consumo->importe }}</td>
                                <td>{{ $consumo->created_at->format('d/m/Y') }}</td>
                                <td>{{ $consumo->coche->marca }} {{ $consumo->coche->modelo }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Asociados</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Correo</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->cliente->asociados as $asociado)
                                <tr>
                                    <td>
                                        {{ $asociado->persona->primer_nombre }}
                                        {{ $asociado->persona->segundo_nombre }}
                                        {{ $asociado->persona->primer_apellido }}
                                        {{ $asociado->persona->segundo_apellido }}
                                    </td>
                                    <td>{{ $asociado->correo }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection