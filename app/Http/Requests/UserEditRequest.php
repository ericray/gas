<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserEditRequest extends Request
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
            'name' => 'required|max:50|unique:users,name,'.$this->segment(2).',id',
            'email' => 'required|email|max:50|unique:users,email,'.$this->segment(2).',id',
            'roles' => 'required',
        ];
    }
}
