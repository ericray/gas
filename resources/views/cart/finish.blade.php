@extends('layouts.app')
@section('title','Finalizar compra')
@section('page-title')
    <h4><i class="icon-bag"></i> Orden</h4>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Finalización de compra</h5>
        </div>
        <div class="panel-body">
            <ul>
                <li>Para terminar con la compra haga clic en el botón de Finalizar.</li>
                <li>En caso de no querer proseguir con la compra haga clic en regresar y cancelar la compra.</li>
            </ul>

            {!! Form::open(['route' => 'cart.finish']) !!}
                <div class="form-group">
                    {!! Form::label('tipo_pago_id','Seleccione un tipo de pago') !!}
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        {!! Form::select('tipo_pago_id',$tipos_pagos,null,['class' => 'form-control']) !!}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="datos-tarjeta">
                    <div class="form-group">
                        {!! Form::label('numero_tarjeta','Número de tarjeta') !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::text('numero_tarjeta',null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('codigo_tarjeta','Código') !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::text('codigo_tarjeta',null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_expiracion','Fecha de expiración') !!}
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('mes_expiracion','Mes') !!}
                                {!! Form::select('mes_expiracion',$meses,null,['class' => 'form-control', 'placeholder' => 'Seleccione mes']) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::label('anio_expiracion','Año') !!}
                                {!! Form::select('anio_expiracion',$anios,null,['class' => 'form-control','placeholder' => 'Seleccione año']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {!! link_to_route('cart.confirmation','Regresar',[],['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Finalizar',['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('styles')
    <style>
        #datos-tarjeta{
            display: none;
        }
    </style>
@endsection
@section('scripts')
    <script>
        $(function () {
           $('#tipo_pago_id').change(function () {
               var url = '{{ url('obtener_tipo_pago') }}/' + $(this).val();
               var data = { '_token' : '{{ csrf_token() }}' };
               $.post(url,data)
                       .success(function (result) {
                           console.log(result.descripcion);
                           if(result.descripcion !== 'En efectivo'){
                               $('#datos-tarjeta').show();
                           }else{
                               $('#datos-tarjeta').hide();
                           }
                       })
                       .error(function (error) {
                           console.log(error);
                       });

           });
        });
    </script>
@endsection