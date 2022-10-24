<?php

namespace App\Http\Resources\Workorder;

use App\Models\Smelting;
use App\Models\Realtime;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkorderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $smeltingData   = Smelting::where('workorder_id',$this->id)->get();
        $smelting       = [];
        foreach($smeltingData as $smelt){
            $smelting[] = [
                'weight'        => $smelt->weight,
                'smelting_num'  => $smelt->smelting_num,
            ]; 
        }

        $realtimeData   = Realtime::where('workorder_id',$this->id)->get();
        $realtime       = [];
        foreach($realtimeData as $realt){
            $realtime[] = [
                'counter'        => $realt->counter,
            ]; 
        }

        //$actual_qty_production   = Realtime::select('counter')->where('workorder_id',$this->id)->get();
                                   //->orderBy('created_at', 'desc')->first();
        
        return [
            'wo_number'         =>$this->wo_number,
            'bb_supplier'       =>$this->bb_supplier,
            'bb_grade'          =>$this->bb_grade,
            'bb_diameter'       =>$this->bb_diameter,
            'bb_qty_pcs'        =>$this->bb_qty_pcs,
            'bb_qty_coil'       =>$this->bb_qty_coil,
            'fg_customer'       =>$this->fg_customer,
            'fg_size_1'         =>$this->fg_size_1,
            'fg_size_2'         =>$this->fg_size_2,
            'tolerance_minus'   =>$this->tolerance_minus,
            'fg_reduction_rate' =>$this->fg_reduction_rate,
            'fg_shape'          =>$this->fg_shape,
            'fg_qty_kg'         =>$this->fg_qty_kg,
            'fg_qty_pcs'        =>$this->fg_qty_pcs,
            'wo_order_num'      =>$this->wo_order_num,
            'status_wo'         =>$this->status_wo,
            'machine'           =>$this->machine->name,
            'user'              =>$this->user->name,
			'created_at'        =>$this->created_at,
			'updated_at'        =>$this->updated_at,
			'actual_qty_production' =>$this->actual_qty_production,
            'smelting_data'     =>$smelting,
            'realtime_data'     =>$realtime
        ];
    }
}
