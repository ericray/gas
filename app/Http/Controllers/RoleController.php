<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\App;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rol.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nuevo rol';
        $rol = new Role();
        $form_data = ['route' => 'rol.store','class' => 'form-horizontal'];
        $permissions = Permission::all()->lists('display_name','id');
        $mypermissions = [];

        return view('rol.form')->with(compact('title','rol','form_data','permissions','mypermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = new Role();
        $role->fill($request->all());
        $role->name = snake_case($request->display_name);
        $role->save();
        $role->attachPermissions($request->permissions);

        return redirect()->route('rol.index');
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
        $rol = Role::findOrFail($id);
        $title = 'Editar rol '.$rol->display_name;
        $form_data = ['route' => ['rol.update',$rol->id],'method' => 'PUT','class' => 'form-horizontal'];
        $permissions = Permission::all()->lists('display_name','id');
        $mypermissions = $rol->perms()->lists('id')->toArray();

        return view('rol.form')->with(compact('title','rol','form_data','permissions','mypermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->fill($request->all());
        $role->name = snake_case($request->display_name);
        $role->save();
        $role->perms()->sync($request->permissions);

        return redirect()->route('rol.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();

        if($request->ajax())
            return response()->json([
                'message' => 'El rol '.$rol->display_name.' ha sido eliminado'
            ]);

        return redirect()->route('rol.index');
    }

    /**
     * JSON LIST
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

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

        $roles = Role::where(\DB::raw('CONCAT(roles.display_name,\' \',roles.description)'),'LIKE',"%$searchPhrase%")
            ->orderBy($field,$order)
            ->get();

        return response()->json([
            'rows' => $roles,
            'rowCount' => 10,
            'current' => 1,
            'total' => $roles->count()
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */

    public function getAttachPerms($id)
    {
        $role = Role::findOrFail($id);
        $title = 'Asignar permisos al rol '.$role->display_name;
        $permissions = Permission::all();
        $permissions->each(function($permissions){
            $permissions->roles;
        });

        return view('rol.attachperms')->with(compact('title','role','permissions'));
    }

    public function postAttachPerms(Request $request,$id)
    {
       return $request->permission_id;
    }
}
