@extends('layouts.app')
@section('title','Lista de tipos de pregunta')
@section('page-title')
    <h4><i class="icon-question3"></i> Tipos de preguntas</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Lista de tipos de pregunta secreta</h5>
        </div>
        <div class="table-reponsive">
            <div id="mensaje"></div>
            <table class="table table-hover table-bordered" id="tbl-tipo-pregunta">
                <thead>
                <tr>
                    <th data-column-id="descripcion">Nombre</th>
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