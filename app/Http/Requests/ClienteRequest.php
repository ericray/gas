<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClienteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'primer_nombre' => 'required|max:60',
            'segundo_nombre' => 'required|max:60',
            'primer_apellido' => 'required|max:60',
            'segundo_apellido' => 'required|max:60',
            'fecha_nacimiento' => 'required|date',
            'curp' => 'required|min:18',
            'rfc' => 'required|min:18',
            'calle' => 'required|max:20',
            'numero_interior' => 'required|max:5',
            'numero_exterior' => 'required|max:5',
            'cruzamientos' => 'required|max:40',
            'asentamiento' => 'required|max:50',
            'entidad_federativa' => 'required|max:60',
            'municipio' => 'required|max:60',
            'correo' => 'required|email|unique:contactos',
            'telefono_fijo' => 'required|unique:contactos|max:15',
            'telefono_movil' => 'required|unique:contactos|max:15',
            'codigo_barras' => 'required|unique:cuentas',
            'descripcion' => 'required|max:70',
            'periodicidad_consumo' => 'required|max:50',
            'pregunta' => 'required|max:50',
            'respuesta' => 'required|max:80'
        ];
    }
}
