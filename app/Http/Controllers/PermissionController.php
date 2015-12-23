<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permiso.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = new Permission();
        $title = 'Agregar permiso';
        $form_data = ['route' => 'permiso.store','class' => 'form-horizontal'];

        return view('permiso.form')->with(compact('permission','title','form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission();
        $permission->fill($request->all());
        $permission->name = snake_case($request->display_name);
        $permission->save();

        return redirect()->route('permiso.index');
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
        $permission = Permission::findOrFail($id);
        $title = 'Editar permiso '.$permission->display_name;
        $form_data = ['route' => ['permiso.update',$permission->id],'method' => 'PUT','class' => 'form-horizontal'];

        return view('permiso.form')->with(compact('permission','title','form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->fill($request->all());
        $permission->name = snake_case($request->display_name);
        $permission->save();

        return redirect()->route('permiso.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        if($request->ajax())
            return response()->json([
                'message' => 'El permiso '.$permission->display_name.' ha sido eliminado'
            ]);

       return redirect()->route('permiso.index');
    }

    public function postJsonList(Request $request)
    {
        $field = 'id';
        $order = 'ASC';
        if ($request->has('sort')) {
            $sort = $request->sort;
            $field = key($sort);
            $order = $request->sort[$field];
        }
        $searchPhrase = $request->searchPhrase;

        $permission = Permission::where(\DB::raw('CONCAT(permissions.display_name,\' \',permissions.description)'),'LIKE',"%$searchPhrase%")
            ->orderBy($field,$order)
            ->get();

        return response()->json([
            'current' => 1,
            'rowCount' => 10,
            'rows' => $permission,
            'total' => $permission->count()
        ]);
    }
}
