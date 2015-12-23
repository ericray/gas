@extends('layouts.app')
@section('title','Lista de preguntas secretas')
@section('page-title')
    <h4><i class="icon-question6"></i> Pregunta secreta</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Lista de preguntas secretas</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tbl-preguntas">
                <thead>
                    <tr>
                        <th data-column-id="pregunta">Nombre</th>
                        <th data-column-id="respuesta">Respuesta</th>
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