<?php

namespace App\Http\Resources\Realtime;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RealtimeCollection extends ResourceCollection
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
            'data2'=> RealtimeResource::collection($this->collection),
            'meta'=>[
                'total_realtime_data'=>$this->collection->count()
            ]
        ];
    }
}
