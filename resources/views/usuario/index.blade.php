@extends('layouts.app')
@section('title','Lista de usuarios')
@section('page-title')
    <h4><i class="icon-users"></i>Usuarios</h4>
@endsection
@section('heading-elements')
    <a href="{{ route('usuario.create') }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" title="Nuevo cliente">
        <i class="icon-plus3"></i>
    </a>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4>Lista de usuarios</h4>
        </div>
        <div class="table-responsive">
            <div id="message"></div>
            <table class="table table-hover table-bordered" id="tbl-usuarios">
                <thead>
                <tr>
                    <th data-column-id="name">Nombre</th>
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
