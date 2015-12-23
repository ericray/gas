@extends('layouts.app')
@section('title','Asociados')
@section('page-title')
    <h4><i class="icon-users"></i> Asociados</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Asociados de cliente {{ $cliente->persona->full_name }}</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tbl-asociados" data-cliente-id="{{ $cliente->id }}">
                <thead>
                    <tr>
                        <td data-column-id="primer_nombre">Nombre</td>
                        <td data-column-id="id" data-formatter="id">Acciones</td>
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