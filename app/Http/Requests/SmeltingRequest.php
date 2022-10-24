<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmeltingRequest extends FormRequest
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
            //
            'wo_id'             =>['required'],
            'weight'            =>['required'],
            'smelting_num'      =>['required'],
            // 'area'              =>['required'],
        ];
    }

    public function messages(){
        return [
            'required'  => 'Kolom :attribute harus diisi.'
        ];
    }
}
