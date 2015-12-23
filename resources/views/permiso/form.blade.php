@extends('layouts.app')
@section('title',$title)
@section('page-title')
    <h4><i class="icon-hand"></i> Permisos</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4>{{ $title }}</h4>
        </div>
        {!! Form::model($permission,$form_data) !!}
            <div class="panel-body">
                @include('errors.errors_request')
                <div class="form-group">
                    {!! Form::label('display_name','Nombre') !!}
                    {!! Form::text('display_name',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description','Descripción') !!}
                    {!! Form::textarea('description',null,['class' => 'form-control','rows' => 3]) !!}
                </div>
                <div class="text-right">
                    {!! link_to_route('permiso.index','Cancelar',[],['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection