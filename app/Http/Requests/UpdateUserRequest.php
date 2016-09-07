<?php

namespace emutoday\Http\Requests;

use emutoday\Http\Requests\Request;

class UpdateUserRequest extends Request
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
            'last_name' => ['required'],
						'email' => ['required', 'email', 'unique:users,email,'.$this->route('users')],
            'password' => ['required_with:password_confirmation', 'confirmed']
        ];
    }
}
