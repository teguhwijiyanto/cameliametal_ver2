<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OeeRequest extends FormRequest
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
            'workorder_id'                      => ['required'],
            'dt_briefing'                       => ['required'],
            'dt_cek_shot_blast'                 => ['required'],
            'dt_cek_mesin'                      => ['required'],
            'dt_sambung_bahan'                  => ['required'],
            'dt_bongkar_pasang_dies'            => ['required'],
            'dt_setting_awal'                   => ['required'],
            'dt_selesai_satu_bundle'            => ['required'],
            'dt_cleaning_area_mesin'            => ['required'],
            'dt_tunggu_bahan_baku'              => ['required'],
            'dt_ganti_bahan_baku'               => ['required'],
            'dt_tunggu_dies'                    => ['required'],
            'dt_gosok_dies'                     => ['required'],
            'dt_ganti_part_shot_blast'          => ['required'],
            'dt_putus_dies'                     => ['required'],
            'dt_setting_ulang_kelurusan'        => ['required'],
            'dt_ganti_polishing_dies'           => ['required'],
            'dt_ganti_nozle_polishing_mesin'    => ['required'],
            'dt_ganti_roller_straightener'      => ['required'],
            'dt_dies_rusak'                     => ['required'],
            'dt_mesin_trouble_operator'         => ['required'],
            'dt_validasi_qc'                    => ['required'],
            'dt_mesin_trouble_maintenance'      => ['required'],
            'dt_istirahat'                      => ['required'],
            'total_runtime'                     => ['required'],
            'total_downtime'                    => ['required'],
        ];
    }

    public function messages(){
        return [
            'required'  => 'Kolom :attribute harus diisi.'
        ];
    }
}
