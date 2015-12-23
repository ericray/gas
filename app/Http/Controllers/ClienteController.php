<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contacto;
use App\Models\Cuenta;
use App\Models\Persona;
use App\Models\PreguntaSecreta;
use App\Models\SucursalGasolinera;
use App\Models\TipoPregunta;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use Carbon\Carbon;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cliente.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = SucursalGasolinera::all()->lists('nombre','id');
        $tipos_preguntas = TipoPregunta::all()->lists('descripcion','id');

        return view('cliente.form')->with(compact('sucursales','tipos_preguntas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $contacto = new Contacto();
        $contacto->fill($request->all());
        $contacto->save();

        $persona = new Persona();
        $persona->fill($request->all());
        $persona->fecha_nacimiento = Carbon::createFromTimestamp(strtotime($request->fecha_nacimiento))->format('Y-m-d');
        $persona->contacto_id = $contacto->id;
        $persona->save();

        $cliente = new Cliente();
        $cliente->fill($request->all());
        $cliente->fecha_registro = Carbon::now();
        $cliente->numero_cliente = '000'.$persona->id;
        $cliente->persona_id = $persona->id;
        $cliente->save();

        $pregunta = new PreguntaSecreta();
        $pregunta->fill($request->all());
        $pregunta->save();

        $cuenta = new Cuenta();
        $cuenta->fill($request->all());
        $cuenta->cliente_id = $cliente->id;
        $cuenta->placa_auto = '';
        $cuenta->credito_disponible = 0;
        $cuenta->sucursal_gasolinera_id = $request->sucursal_gasolinera_id;
        $cuenta->pregunta_secreta_id = $pregunta->id;
        $cuenta->save();

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->password = bcrypt($request->password);
        $usuario->email = $request->correo;
        $usuario->cliente_id = $cliente->id;
        $usuario->save();

        return redirect()->route('cliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postJsonList(Request $request)
    {
        $searchPhrase = $request->searchPhrase;
        $field = 'id';
        $order = 'ASC';
        if ($request->has('sort')) {
            $sort = $request->sort;
            $field = key($sort);
            $order = $request->sort[$field];
        }

        $cliente = Cliente::personaCliente($searchPhrase,$field,$order)->get();

       return response()->json([
           'current' => 1,
           'rowCount' => 10,
           'rows' => $cliente,
           'total' => $cliente->count()
       ]);
    }
}
