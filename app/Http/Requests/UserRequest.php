<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
        $rule_user_unique = Rule::unique('users','employeeId');
        if($this->method() !== 'POST'){
            $rule_user_unique->ignore(Request::segment(3));
        }

        return [
            'name'=>'required',
            'employeeId'=>['required','min:8','max:8',$rule_user_unique],
            'role'  =>'required'
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'Kolom :attribute harus diisi.',
            'min'   => 'Kolom :attribute harus setidaknya diisi 8 digit',
            'max'   => 'Kolom :attribute tidak bisa diisi lebih dari 8 digit',
        ];
    }
}
