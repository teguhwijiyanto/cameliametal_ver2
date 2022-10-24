<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'workorder_id',
        'downtime_number',
        'time',
        'status',
        'downtime',
        'is_downtime_stopped',
        'is_remark_filled',
    ];

    public function Workorder()
    {
        return $this->belongsTo(Workorder::class);
    }   
}
