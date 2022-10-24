<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'workorder_id',
        'bundle_num',
        'dies_num',
        // 'area',
        'diameter_ujung',
        'diameter_tengah',
        'diameter_ekor',
        'kelurusan_aktual',
        'panjang_aktual',
        'berat_fg',
        'pcs_per_bundle',
        'bundle_judgement',
        'visual',
    ];

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

}
