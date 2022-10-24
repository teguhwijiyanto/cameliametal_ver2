<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smelting extends Model
{
    use HasFactory;
    protected $fillable = [
        'workorder_id',
        'bundle_num',
        'weight',
        'smelting_num',
        // 'area',
    ];

    public function workorder(){
        return $this->belongsTo(Workorder::class);
    }

    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
