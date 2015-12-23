<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ConsumoCliente;
use App\Models\Cuenta;
use App\Models\DetalleOrden;
use App\Models\Orden;
use App\Models\Producto;
use App\Models\TipoPago;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Symfony\Component\Routing\Route;

class PagesController extends Controller
{


    public function __construct()
    {
        Carbon::setLocale('es');
    }

    function home()
    {
        $productos = Producto::all();

        return view('home')->with(compact('productos'));
    }

    function profile()
    {
        return view('auth.profile');
    }

    public function postAddToCart(Request $request)
    {
        $id = ($request->has('producto_id')) ? $request->producto_id : 0;
        $quantity = ($request->has('quantity')) ? $request->quantity : 1;
        $prod = \App\Models\Producto::cart($id)->toArray();
        $prod = array_add($prod, 'task', 0);
        $prod = array_add($prod, 'quantity', $quantity);

        \Cart::insert($prod);

        return redirect()->route('cart.detail');
    }

    public function cartDetail()
    {
        $cart = \Cart::contents();

        if (\Session::has('orden_id')) {
            return redirect()->route('cart.confirmation');
        }

        return view('cart.detail')->with(compact('cart'));
    }

    public function postOrderGenerate(Request $request)
    {
        $orden = new \App\Models\Orden();
        $orden->numero_productos = \Cart::totalItems();
        $orden->total_productos = \Cart::total();
        $orden->fecha = Carbon::now();
        $orden->estatus = 1;
        $orden->cliente_id = $request->cliente_id;
        $orden->save();

        $request->session()->put('orden_id', $orden->id);

        foreach (\Cart::contents() as $item) {
            $detalle = new \App\Models\DetalleOrden();
            $detalle->producto_id = $item->id;
            $detalle->precio_producto = $item->price;
            $detalle->cantidad_producto = $item->quantity;
            $detalle->orden_id = $orden->id;
            $detalle->save();
        }

        \Cart::destroy();

        return redirect()->route('cart.confirmation');
    }

    public function order_confirmation(Request $request)
    {
        $orden_id = ($request->session()->has('orden_id')) ? $request->session()->get('orden_id') : 0;
        $orden = Orden::findOrFail($orden_id);
        $detalles = DetalleOrden::where('orden_id', $orden->id)->first();
        $productos_detalle = DetalleOrden::productosByDetalle($orden->id)->get();

        return view('cart.confirmation')->with(compact('orden', 'detalles', 'productos_detalle'));
    }

    public function orderCancel(Request $request)
    {
        $id = ($request->session()->has('orden_id')) ? $request->session()->get('orden_id') : 0;
        $order = Orden::findOrFail($id);
        $order->estatus = 2;
        $order->tipo_pago_id = 1;
        $order->save();

        $request->session()->forget('orden_id');
        \Cart::destroy();

        return redirect()->route('home');
    }

    public function getFinishOrder()
    {
        $tipos_pagos = TipoPago::all()->lists('descripcion', 'id');
        $meses = [
            '01' => '01',
            '02' => '02',
            '03' => '03',
            '04' => '04',
            '05' => '05',
            '06' => '06',
            '07' => '07',
            '08' => '08',
            '09' => '09',
            '10' => '10',
            '11' => '11',
            '12' => '12'
        ];
        $anios = [
            '2016' => '2016',
            '2017' => '2017',
            '2018' => '2018',
            '2019' => '2019',
            '2020' => '2020'
        ];

        if (\Session::has('orden_id'))
            return view('cart.finish')->with(compact('tipos_pagos', 'meses', 'anios'));

        return redirect()->to('home');
    }

    public function postFinishOrder(Request $request)
    {
        $id = ($request->session()->has('orden_id')) ? $request->session()->get('orden_id') : 0;
        $tipo_pago_id = ($request->has('tipo_pago_id')) ? $request->tipo_pago_id : 0;
        $order = Orden::findOrFail($id);
        $order->estatus = 3;
        $order->tipo_pago_id = $tipo_pago_id;
        $order->save();

        $cliente = $order->cliente_id;
        $cuenta = Cuenta::where('cliente_id', $cliente)->get()->first();
        $cuenta->credito_disponible = $order->total_productos + $cuenta->credito_disponible;
        $cuenta->save();

        $request->session()->forget('orden_id');

        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('cart.account');
    }

    public function getChooseCli(Request $request)
    {
        $clientes = Cliente::cuentaAndCliente($request->s)->get();

        return view('sell.choose-cliente')->with(compact('clientes'));
    }

    public function getChooseProd()
    {
        $productos = Producto::all();

        return view('sell.choose')->with(compact('productos'));
    }

    public function getSearchCliente(Request $request)
    {
        $clientes = Cliente::cuentaAndCliente($request->s)->get();

        return view('sell.search-cliente')->with(compact('clientes'));
    }

    public function getClientAccount($id)
    {
        $cliente = Cliente::findOrFail($id);
        $coches = $cliente->coches->lists('modelo','id');

        $title = 'Cuenta de cliente';

        return view('sell.clientaccount')->with(compact('cliente', 'title','coches'));
    }

    public function postCargarGasolina(Request $request, $id)
    {
        $cuenta = Cuenta::findOrFail($id);

        $valitador = \Validator::make($request->all(), [
            'consumo' => 'required|numeric|min:1|max:' . $cuenta->credito_disponible
        ]);

        if ($valitador->fails()) {
            return redirect()->back()->withErrors($valitador);
        } else {
            $cuenta = Cuenta::findOrFail($id);
            $cuenta->credito_disponible = $cuenta->credito_disponible - $request->consumo;
            $cuenta->save();

            $consumo = new ConsumoCliente();
            $consumo->importe = $request->consumo;
            $consumo->cliente_id = $cuenta->cliente_id;
            $consumo->coche_id = $request->coche_id;
            $consumo->save();

            Flash::success('El cargo se ha efectuado exitosamente');
        }

        return redirect()->route('home');
    }

    public function getOrdenes()
    {
        $ordenes = Orden::ordenesCliente()->get();

        return view('reportes.ordenes')->with(compact('ordenes'));
    }

    public function getConsumosClientes()
    {
        $consumos = ConsumoCliente::all();

        return view('reportes.consumos')->with(compact('consumos'));
    }
}
