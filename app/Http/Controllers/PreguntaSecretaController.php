<?php

namespace App\Http\Controllers;

use App\Models\PreguntaSecreta;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PreguntaSecretaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pregunta_secreta.index');
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
        //
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
        //
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
        //
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

    public function getJsonPregunta(Request $request)
    {
        $searchPhrase = $request->searchPhrase;
        $field = 'id';
        $order = 'ASC';
        if ($request->has('sort')) {
            $sort = $request->sort;
            $field = key($sort);
            $order = $request->sort[$field];
        }

        $preguntas = PreguntaSecreta::where(\DB::raw('CONCAT(preguntas_secretas.pregunta,\' \',preguntas_secretas.respuesta)'),'LIKE',"%$searchPhrase%")
            ->orderBy($field,$order)
            ->get();

        return response()->json([
            'current' => 1,
            'rowCount' => 10,
            'rows' => $preguntas,
            'total' => $preguntas->count()
        ]);
    }
}
