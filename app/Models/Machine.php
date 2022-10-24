<?php

namespace App\Models;

use Dotenv\Parser\Lines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'line_id',
        'name'
    ];

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function workorders()
    {
        return $this->hasMany(Workorder::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
