<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Workorder extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wo_number',
        'bb_supplier',
        'bb_grade',
        'bb_diameter',
        'bb_qty_pcs',
        'bb_qty_coil',
        'fg_customer',
        'straightness_standard',
        'fg_size_1',
        'fg_size_2',
        'tolerance_minus',
		'tolerance_plus',
        'fg_reduction_rate',
        'fg_shape',
        'fg_qty_kg',
        'fg_qty_pcs',
        'wo_order_num',
        // 'status_prod',
        'status_wo',
        // 'status_smelting',
		'chamfer',
	    'color',
        'machine_id',
        'user_id',
        'remarks'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function smeltings(){
        return $this->hasMany(Smelting::class);
    }
    
    public function oees(){
        return $this->hasMany(Oee::class);
    }

    public function realtimes(){
        return $this->hasMany(Realtime::class);
    }
}
