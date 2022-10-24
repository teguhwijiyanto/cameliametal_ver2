<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ScheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=> ScheduleResouce::collection($this->collection),
            'meta'=>[
                'total_schedule_data'=>$this->collection->count()
            ]
        ];
    }
}
