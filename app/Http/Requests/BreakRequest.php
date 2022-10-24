<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
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
        $rule_holiday_unique = Rule::unique('holidays','name');
        if($this->method() !== 'POST'){
            $rule_holiday_unique->ignore(Request::segment(3));
        }
        
        return [
            //
            'name'      => ['required',$rule_holiday_unique],
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'Kolom :attribute harus diisi.'
        ];
    }
}
