@extends('layouts.app')
@section('title',$title)
@section('page-title')
    <h4><i class="icon-users2"></i> Roles</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{ $title }}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse"></a>
                    </li>
                </ul>
            </div>
        </div>
        {!! Form::model($rol,$form_data) !!}
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
                <div class="form-group">
                    {!! Form::label('permissions','Permisos') !!}
                    {!! Form::select('permissions[]',$permissions,$mypermissions,['class' => 'form-control select2-permissions','multiple']) !!}
                </div>
                <div class="text-right">
                    {!! link_to_route('rol.index','Cancelar',[],['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('styles')
    <style>
        .select2-permissions{
            display: none;
        }
    </style>
@endsection
@section('scripts')
    {!! Html::script(asset('plugins/select2/js/select2.min.js')) !!}
    <script>
        $(function () {
            $('.select2-permission').show();
            $('.select2-permissions').select2();
        });
    </script>
@endsection