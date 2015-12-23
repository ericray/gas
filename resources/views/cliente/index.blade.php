@extends('layouts.app')
@section('title','Lista de clientes')
@section('page-title')
    <h5><i class="icon-users"></i> Clientes</h5>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">Lista de clientes</h4>
        </div>
        <table class="table table-hover table-bordered" id="tbl-clientes">
            <thead>
                <tr>
                    <th data-column-id="primer_nombre" data-formatter="nombre">Nombre</th>
                    <th data-column-id="id" data-formatter="id" data-sortable="false">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('styles')
    {!! Html::style(asset('plugins/bootgrid/jquery.bootgrid.min.css')) !!}
@endsection
@section('scripts')
    {!! Html::script(asset('plugins/bootgrid/jquery.bootgrid.min.js')) !!}
    @include('partials.scripts-bootgrid')
@endsection