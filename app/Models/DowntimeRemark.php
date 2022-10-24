<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DowntimeRemark extends Model
{
    use HasFactory;

    protected $fillable = [
        'downtime_id',
        'is_waste_downtime',
        'downtime_reason',
        'remarks'
    ];

    public function Downtimes(){
        return $this->hasMany(Downtime::class);
    }
}
