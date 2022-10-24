<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'shift_id',
        'start',
        'end'
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
