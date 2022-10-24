<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'break_1_start',
        'break_1_end',
        'break_2_start',
        'break_2_end',
        'break_3_start',
        'break_3_end',
        'break_4_start',
        'break_4_end',
        'break_5_start',
        'break_5_end',
        'background_color'
    ];
    
}
