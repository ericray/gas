<?php

namespace App\Http\Controllers;

use App\Models\Asociado;
use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AsociadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persona = new Persona();
        $persona->fill($request->all());
        $persona->contacto_id = 1;
        $persona->save();

        $asociado = new Asociado();
        $asociado->fill($request->all());
        $asociado->cliente_id = $request->cliente_id;
        $asociado->persona_id = $persona->id;
        $asociado->save();

        return redirect()->route('cliente.asociados',$request->cliente_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asociado = Asociado::getPersonaAsociadoSingle($id);
        $asociado->persona;
        $title = 'Editad asociado: '.$asociado->persona->primer_nombre;
        $form_data = ['route' => ['asociado.update',$asociado->id],'method' => 'PUT'];
        $cliente_id_field = '';
        $cliente_id = $asociado->cliente_id;

        return view('asociado.form')->with(compact('asociado','title','form_data','cliente_id_field','cliente_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asociado = Asociado::findOrFail($id);
        $asociado->fill($request->all());
        $asociado->save();

        $persona = Persona::findOrFail($asociado->persona_id);
        $persona->fill($request->all());
        $persona->fecha_nacimiento = Carbon::createFromTimestamp(strtotime($persona->fecha_nacimiento))->format('Y-m-d');
        $persona->save();

        return redirect()->route('cliente.asociados',$asociado->cliente_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getByCliente($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('asociado.index')->with('cliente',$cliente);
    }

    public function getJsonListByCliente(Request $request,$id)
    {
        $searchPhrase = $request->searchPhrase;
        $field = 'id';
        $order = 'ASC';
        if ($request->has('sort')) {
            $sort = $request->sort;
            $field = key($sort);
            $order = $request->sort[$field];
        }

        /*$asociados = Asociado::where('telefono_movil','LIKE',"%$searchPhrase%")
            ->where('cliente_id',$id)
            ->orderBy($field,$order)
            ->get();*/
        $asociados = Asociado::getPersonaAsociado($id,$searchPhrase,$field,$order)->get();

        return response()->json([
           'current' => 1,
            'rowCount' => 10,
            'rows' => $asociados,
            'total' => $asociados->count()
        ]);
    }

    public function createByCliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente_id = $cliente->id;
        $asociado = new Asociado();
        $cliente_id_field = \Form::hidden('cliente_id',$cliente->id);
        $form_data = ['route' => 'asociado.store'];
        $title = 'Agregar asociado de cliente: '.$cliente->persona->primer_nombre;

        return view('asociado.form')->with(compact('cliente','asociado','cliente_id_field','cliente_id','form_data','title'));
    }
}
