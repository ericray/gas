<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Persona;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = new User();
        $roles = Role::all()->lists('display_name','id');
        $myroles = [];
        $title = 'Agregar usuario';
        $form_data = ['route' => 'usuario.store','class' => 'form-horizontal'];
        $password_field = \Form::label('password','Contraseña') . \Form::password('password',['class' => 'form-control']);

        return view('usuario.form')->with(compact('title','usuario','form_data','password_field','roles','myroles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $persona = new Persona();
        $persona->fill($request->all());
        $persona->contacto_id = 1;
        $persona->fecha_nacimiento = Carbon::createFromTimestamp(strtotime($persona->fecha_nacimiento))->format('Y-m-d');
        $persona->save();

        $cliente = new Cliente();
        $cliente->numero_cliente = 0;
        $cliente->curp = '';
        $cliente->rfc = '';
        $cliente->razon_social = '';
        $cliente->actividad_economica = '';
        $cliente->fecha_registro = Carbon::now();
        $cliente->persona_id = $persona->id;
        $cliente->save();

        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->cliente_id = $cliente->id;
        $user->save();
        $user->roles()->sync($request->roles);

        return redirect()->route('usuario.index');
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
        $usuario = User::findOrFail($id);
        $roles = Role::all()->lists('display_name','id');
        $myroles = $usuario->roles->lists('id')->toArray();
        $title = 'Editar usuario '.$usuario->name;
        $form_data = ['route' => ['usuario.update',$usuario->id],'method' => 'PUT','class' => 'form-horizontal'];
        $password_field = '';

        return view('usuario.form')->with(compact('title','usuario','form_data','password_field','roles','myroles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->fill($request->all());
        $usuario->save();
        $usuario->roles()->sync($request->roles);

        return redirect()->route('usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        if($request->ajax()){
            return response()->json([
                'message' => 'El usuario '.$usuario->name.' ha sido eliminado'
            ]);
        }

        return redirect()->route('usuario.index');
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
        $users = User::where(\DB::raw('CONCAT(users.name,\' \',users.email)'),'LIKE',"%$searchPhrase%")
            ->where('id','<>',auth()->user()->id)
            ->orderBy($field,$order)
            ->get();

        return response()->json([
            'rows' => $users,
            'total' => $users->count(),
            'current' => 1,
            'rowCount' => 10
        ]);
    }
}
