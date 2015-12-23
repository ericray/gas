@extends('layouts.app')
@section('title','Seleccionar producto')
@section('page-title')
    <h4><i class="icon-bag"></i> Venta</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Elegir producto</h5>
        </div>
        <div class="panel-body">
            @foreach($productos as $producto)
                <div class="col-md-3">
                    <div class="thumbnail">
                        {!! Html::image(asset('theme/img/gas_station2.png'),'role-'.$producto->id) !!}
                        <div class="caption text-center">
                            <h3>${{ number_format($producto->precio,2) }}</h3>
                            <p class="text-muted">{{ $producto->descripcion }}</p>

                            {!! Form::open(['url' => 'addtocart','class' => 'form-inline']) !!}
                                {!! Form::hidden('producto_id',$producto->id) !!}
                                <div class="form-group">
                                    {!! Form::label('quantity','Cantidad') !!}
                                    {!! Form::number('quantity',1,['class' => 'form-control','min' => 1,'max' => $producto->cantidad]) !!}
                                </div>
                                <br><br>
                                <div class="form-group">
                                    {!! Form::submit('Seleccionar',['class' => 'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection