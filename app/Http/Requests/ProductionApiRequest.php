<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductionApiRequest extends FormRequest
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
            'workorder_id'      =>['required'],
            'bundle_num'        =>['required'],
            'dies_num'          =>['required'],
            // 'area'              =>['required'],
            'diameter_ujung'    =>['required'],
            'diameter_tengah'   =>['required'],
            'diameter_ekor'     =>['required'],
            'kelurusan_aktual'  =>['required'],
            'panjang_aktual'    =>['required'],
            'berat_fg'          =>['required'],
            'pcs_per_bundle'    =>['required'],
            'bundle_judgement'  =>['required'],
            'visual'            =>['required'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }   
}
