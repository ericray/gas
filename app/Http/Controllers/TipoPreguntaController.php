<?php

namespace App\Http\Controllers;

use App\Models\TipoPregunta;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TipoPreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tipo_pregunta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_pregunta = new TipoPregunta();
        $title = 'Crear tipo de pregunta';
        $form_data = ['route' => 'tipo_pregunta.store'];

        return view('tipo_pregunta.form')->with(compact('tipo_pregunta','title','form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo_pregunta = new TipoPregunta();
        $tipo_pregunta->fill($request->all());
        $tipo_pregunta->save();

        return redirect()->route('tipo_pregunta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_pregunta = TipoPregunta::findOrFail($id);
        $title = 'Editar tipo de pregunta: '.$tipo_pregunta->descripcion;
        $form_data = ['route' => ['tipo_pregunta.update',$tipo_pregunta->id],'method' => 'PUT'];

        return view('tipo_pregunta.form')->with(compact('tipo_pregunta','title','form_data'));
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
        $tipo_pregunta = TipoPregunta::findOrFail($id);
        $tipo_pregunta->fill($request->all());
        $tipo_pregunta->save();

        return redirect()->route('tipo_pregunta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $tipo_pregunta = TipoPregunta::findOrFail($id);
        $tipo_pregunta->delete();

        if($request->ajax()){
            return response()->json([
                'message' => 'El tipo pregunta ' . $tipo_pregunta->descripcion . 'ha sido eliminado'
            ]);
        }

        return redirect()->route('tipo_pregunta.index');
    }

    public function getJsonList(Request $request)
    {
        $searchPhrase = $request->searchPhrase;
        $field = 'id';
        $order = 'ASC';
        if ($request->has('sort')) {
            $sort = $request->sort;
            $field = key($sort);
            $order = $request->sort[$field];
        }

        $tipos_preguntas = TipoPregunta::where('descripcion','LIKE',"%$searchPhrase%")
            ->orderBy($field,$order)
            ->get();

        return response()->json([
            'current' => 1,
            'rowCount' => 10,
            'rows' => $tipos_preguntas,
            'total' => $tipos_preguntas->count()
        ]);
    }
}
