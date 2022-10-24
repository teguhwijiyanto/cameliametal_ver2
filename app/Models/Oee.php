<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oee extends Model
{
    use HasFactory;

    protected $fillable = [
        'workorder_id',
        'dt_briefing',
        'dt_cek_shot_blast',
        'dt_cek_mesin',
        'dt_sambung_bahan',
        'dt_bongkar_pasang_dies',
        'dt_setting_awal',
        'dt_selesai_satu_bundle',
        'dt_cleaning_area_mesin',
        'dt_tunggu_bahan_baku',
        'dt_ganti_bahan_baku',
        'dt_tunggu_dies',
        'dt_gosok_dies',
        'dt_ganti_part_shot_blast',
        'dt_putus_dies',
        'dt_setting_ulang_kelurusan',
        'dt_ganti_polishing_dies',
        'dt_ganti_nozle_polishing_mesin',
        'dt_ganti_roller_straightener',
        'dt_dies_rusak',
        'dt_mesin_trouble_operator',
        'dt_validasi_qc',
        'dt_mesin_trouble_maintenance',
        'dt_istirahat',
        'total_runtime',
        'total_downtime'
    ];

    public function workorder(){
        return $this->belongsTo(Workorder::class);
    }
}
