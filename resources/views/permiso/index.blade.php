@extends('layouts.app')
@section('title','Lista de permisos')
@section('page-title')
    <h4><i class="icon-hand"></i> Permisos</h4>
@endsection
@section('heading-elements')
    <a href="{{ route('permiso.create') }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" title="Agregar permiso">
        <i class="icon-plus3"></i>
    </a>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Lista de permisos</h5>
        </div>
        <div class="table-responsive">
            <div id="message"></div>
            <table class="table table-hover table-bordered" id="tbl-permisos">
                <thead>
                    <tr>
                        <th data-column-id="display_name">Nombre</th>
                        <th data-column-id="id" data-formatter="id" data-sortable="false">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('styles')
    {!! Html::style(asset('plugins/bootgrid/jquery.bootgrid.min.css')) !!}
@endsection
@section('scripts')
    {!! Html::script(asset('plugins/bootgrid/jquery.bootgrid.min.js')) !!}
    @include('partials.scripts-bootgrid')
@endsection