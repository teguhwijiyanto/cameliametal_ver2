<?php

namespace App\Http\Resources\Downtime;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DowntimeCollection extends ResourceCollection
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
            'data'=> DowntimeResource::collection($this->collection),
            'meta'=>[
                'total_downtime_data'=>$this->collection->count()
            ]
        ];
    }
}
