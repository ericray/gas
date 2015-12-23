<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PermissionRequest extends Request
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
        $name_rules = 'required|max:50|unique:permissions';

        if($this->segment(2))
            $name_rules = 'required|max:50|unique:permissions,display_name,'.$this->segment(2).',id';

        return [
            'display_name' => $name_rules,
            'description' => 'required|max:150'
        ];
    }
}
