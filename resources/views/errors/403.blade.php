@extends('layouts.app')
@section('title','Error 403')
@section('content')
        <!-- Error wrapper -->
<div class="container-fluid text-center">
    <h1 class="error-title">403</h1>
    <h6 class="text-semibold content-group">Oops !No tiene acceso a esta dirección!</h6>

    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fa fa-arrow-circle-left"></i> Regresar
            </a>
        </div>
    </div>
</div>
<!-- /error wrapper -->
@endsection