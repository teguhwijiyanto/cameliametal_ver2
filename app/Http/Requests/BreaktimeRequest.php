<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BreaktimeRequest extends FormRequest
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
        $rule_breaktime_unique = Rule::unique('breaktimes','name');
        if($this->method() !== 'POST'){
            $rule_breaktime_unique->ignore(Request::segment(3));
        }
        
        return [
            //
            'name'      => ['required',$rule_breaktime_unique],
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'Kolom :attribute harus diisi.'
        ];
    }
}
