<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoleRequest extends Request
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
        $display_name = 'required|max:50|unique:roles';

        if($this->segment(2))
            $display_name = 'required|max:50|unique:roles,display_name,'.$this->segment(2).',id';

        return [
            'display_name' => $display_name,
            'description' => 'required|max:100'
        ];
    }
}
