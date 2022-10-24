<?php

namespace App\Http\Requests;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
        $rule_supplier_unique = Rule::unique('suppliers','name');
        if($this->method() !== 'POST'){
            $rule_supplier_unique->ignore(Request::segment(3));
        }
        
        return [
            //
            'name'      => ['required',$rule_supplier_unique],
            'grade'     => ['required'],
            'diameter'  => ['required','numeric'],
            'qty_kg'    => ['required','numeric','integer'],
            'qty_coil'  => ['required','numeric','integer']
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'Kolom :attribute harus diisi.'
        ];
    }
}
