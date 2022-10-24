<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'mesin_id'      => $this->machine->name,
            'date'          => date('Y-m-d',strtotime($this->start)),
            'is_holiday'    => false,
            'shift_1'       => [
                'start' => date('Hi',strtotime($this->shift->start_time)),
                'end'   => date('Hi',strtotime($this->shift->end_time)),
                'break_1' => [
                    'start' => date('Hi',strtotime($this->shift->break_1_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_1_end)),
                ],
                'break_2' => [
                    'start' => date('Hi',strtotime($this->shift->break_2_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_2_end)),
                ],
                'break_3' => [
                    'start' => date('Hi',strtotime($this->shift->break_3_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_3_end)),
                ],
                'break_4' => [
                    'start' => date('Hi',strtotime($this->shift->break_4_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_4_end)),
                ],
                'break_5' => [
                    'start' => date('Hi',strtotime($this->shift->break_5_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_5_end)),
                ]
            ],
            'shift_2'       => [
                'start' => date('Hi',strtotime($this->shift->start_time)),
                'end'   => date('Hi',strtotime($this->shift->end_time)),
                'break_1' => [
                    'start' => date('Hi',strtotime($this->shift->break_1_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_1_end)),
                ],
                'break_2' => [
                    'start' => date('Hi',strtotime($this->shift->break_2_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_2_end)),
                ],
                'break_3' => [
                    'start' => date('Hi',strtotime($this->shift->break_3_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_3_end)),
                ],
                'break_4' => [
                    'start' => date('Hi',strtotime($this->shift->break_4_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_4_end)),
                ],
                'break_5' => [
                    'start' => date('Hi',strtotime($this->shift->break_5_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_5_end)),
                ]
            ],
            'shift_3'       => [
                'start' => date('Hi',strtotime($this->shift->start_time)),
                'end'   => date('Hi',strtotime($this->shift->end_time)),
                'break_1' => [
                    'start' => date('Hi',strtotime($this->shift->break_1_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_1_end)),
                ],
                'break_2' => [
                    'start' => date('Hi',strtotime($this->shift->break_2_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_2_end)),
                ],
                'break_3' => [
                    'start' => date('Hi',strtotime($this->shift->break_3_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_3_end)),
                ],
                'break_4' => [
                    'start' => date('Hi',strtotime($this->shift->break_4_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_4_end)),
                ],
                'break_5' => [
                    'start' => date('Hi',strtotime($this->shift->break_5_start)),
                    'end'   => date('Hi',strtotime($this->shift->break_5_end)),
                ]
            ],
            
            
        ];
    }
}
