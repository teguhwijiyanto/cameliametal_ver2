<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'total_runtime',
        'total_downtime',
        'total_pcs',
        'total_weight_fg',
        'total_weight_bb',
        'average_speed'
    ];
}
