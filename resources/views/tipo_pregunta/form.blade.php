@extends('layouts.app')
@section('title',$title)
@section('page-title')
    <h4><i class="icon-question3"></i> Tipo de pregunta</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{ $title }}</h5>
        </div>
        <div class="panel-body">
            {!! Form::model($tipo_pregunta,$form_data) !!}
                <div class="form-group">
                    {!! Form::label('descripcion','Descripción') !!}
                    {!! Form::text('descripcion',null,['class' => 'form-control']) !!}
                </div>
                <div class="text-right">
                    {!! link_to_route('tipo_pregunta.index','Cancelar',[],['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection