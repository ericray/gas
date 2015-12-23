@extends('layouts.app')
@section('title',$title)
@section('page-title')
    <h4><i class="icon-users2"></i> Roles</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4>{{ $title }}</h4>
        </div>
        <div class="table-reponsive">

            {!! Form::open(['route' => ['rol.attachperms',$role->id]]) !!}

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Permiso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $perm)
                            <tr>
                                <td></td>
                                <td>{{ $perm->display_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            {!! Form::close() !!}
        </div>
    </div>
@endsection