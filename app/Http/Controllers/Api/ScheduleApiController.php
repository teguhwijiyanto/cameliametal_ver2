<?php

namespace App\Http\Controllers\Api;

use App\Models\Machine;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleApiRequest;
use App\Http\Resources\Schedule\ScheduleCollection;

class ScheduleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ScheduleApiRequest $request)
    {
        //
        $machineName = Machine::where('name',$request->mesin_id)->first();
        if (is_null($machineName)) {
            return response()->json([
                'message'   => 'Machine Name Not Found'
            ],404);
        }
        $data = Schedule::where('machine_id',$machineName->id)
                        ->where('start','>=',date('Y-m-d'))
                        ->where('end','<=',date('Y-m-d'))
                        ->orderBy('shift_id','ASC')
                        ->get();
        $results = 
        [
            'mesin_id'      => $request->mesin_id,
            'date'          => date('Y-m-d'),
            'is_holiday'    => true,
            'shift_1'       => [
                'start' => null,
                'end'   => null,
                'break_1' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_2' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_3' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_4' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_5' => [
                    'start' => null,
                    'end'   => null,
                ]
            ],
            'shift_2'       => [
                'start' => null,
                'end'   => null,
                'break_1' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_2' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_3' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_4' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_5' => [
                    'start' => null,
                    'end'   => null,
                ]
            ],
            'shift_3'       => [
                'start' => null,
                'end'   => null,
                'break_1' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_2' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_3' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_4' => [
                    'start' => null,
                    'end'   => null,
                ],
                'break_5' => [
                    'start' => null,
                    'end'   => null,
                ]
            ]
        ];

        if(count($data) == 0)
        {
            return response()->json([
                $results
            ],200);
        }
        
        $results['is_holiday'] = false;

        foreach ($data as $aData) {
            if($aData->shift_id == 1){
                $results['shift_1'] = [
                    'start' => date('Hi',strtotime($aData->shift->start_time)),
                    'end'   => date('Hi',strtotime($aData->shift->end_time)),
                    'break_1' => [
                        'start' => is_null($aData->shift->break_1_start)?null:date('Hi',strtotime($aData->shift->break_1_start)),
                        'end'   => is_null($aData->shift->break_1_end)?null:date('Hi',strtotime($aData->shift->break_1_end)),
                    ],
                    'break_2' => [
                        'start' => is_null($aData->shift->break_2_start)?null:date('Hi',strtotime($aData->shift->break_2_start)),
                        'end'   => is_null($aData->shift->break_2_end)?null:date('Hi',strtotime($aData->shift->break_2_end)),
                    ],
                    'break_3' => [
                        'start' => is_null($aData->shift->break_3_start)?null:date('Hi',strtotime($aData->shift->break_3_start)),
                        'end'   => is_null($aData->shift->break_3_end)?null:date('Hi',strtotime($aData->shift->break_3_end)),
                    ],
                    'break_4' => [
                        'start' => is_null($aData->shift->break_4_start)?null:date('Hi',strtotime($aData->shift->break_4_start)),
                        'end'   => is_null($aData->shift->break_4_end)?null:date('Hi',strtotime($aData->shift->break_4_end)),
                    ],
                    'break_5' => [
                        'start' => is_null($aData->shift->break_5_start)?null:date('Hi',strtotime($aData->shift->break_5_start)),
                        'end'   => is_null($aData->shift->break_5_end)?null:date('Hi',strtotime($aData->shift->break_5_end)),
                    ]
                ];
            }
            if($aData->shift_id == 2){
                $results['shift_2'] = [
                    'start' => date('Hi',strtotime($aData->shift->start_time)),
                    'end'   => date('Hi',strtotime($aData->shift->end_time)),
                    'break_1' => [
                        'start' => is_null($aData->shift->break_1_start)?null:date('Hi',strtotime($aData->shift->break_1_start)),
                        'end'   => is_null($aData->shift->break_1_end)?null:date('Hi',strtotime($aData->shift->break_1_end)),
                    ],
                    'break_2' => [
                        'start' => is_null($aData->shift->break_2_start)?null:date('Hi',strtotime($aData->shift->break_2_start)),
                        'end'   => is_null($aData->shift->break_2_end)?null:date('Hi',strtotime($aData->shift->break_2_end)),
                    ],
                    'break_3' => [
                        'start' => is_null($aData->shift->break_3_start)?null:date('Hi',strtotime($aData->shift->break_3_start)),
                        'end'   => is_null($aData->shift->break_3_end)?null:date('Hi',strtotime($aData->shift->break_3_end)),
                    ],
                    'break_4' => [
                        'start' => is_null($aData->shift->break_4_start)?null:date('Hi',strtotime($aData->shift->break_4_start)),
                        'end'   => is_null($aData->shift->break_4_end)?null:date('Hi',strtotime($aData->shift->break_4_end)),
                    ],
                    'break_5' => [
                        'start' => is_null($aData->shift->break_5_start)?null:date('Hi',strtotime($aData->shift->break_5_start)),
                        'end'   => is_null($aData->shift->break_5_end)?null:date('Hi',strtotime($aData->shift->break_5_end)),
                    ]
                ];
            }
            if($aData->shift_id == 3){
                $results['shift_3'] = [
                    'start' => date('Hi',strtotime($aData->shift->start_time)),
                    'end'   => date('Hi',strtotime($aData->shift->end_time)),
                    'break_1' => [
                        'start' => is_null($aData->shift->break_1_start)?null:date('Hi',strtotime($aData->shift->break_1_start)),
                        'end'   => is_null($aData->shift->break_1_end)?null:date('Hi',strtotime($aData->shift->break_1_end)),
                    ],
                    'break_2' => [
                        'start' => is_null($aData->shift->break_2_start)?null:date('Hi',strtotime($aData->shift->break_2_start)),
                        'end'   => is_null($aData->shift->break_2_end)?null:date('Hi',strtotime($aData->shift->break_2_end)),
                    ],
                    'break_3' => [
                        'start' => is_null($aData->shift->break_3_start)?null:date('Hi',strtotime($aData->shift->break_3_start)),
                        'end'   => is_null($aData->shift->break_3_end)?null:date('Hi',strtotime($aData->shift->break_3_end)),
                    ],
                    'break_4' => [
                        'start' => is_null($aData->shift->break_4_start)?null:date('Hi',strtotime($aData->shift->break_4_start)),
                        'end'   => is_null($aData->shift->break_4_end)?null:date('Hi',strtotime($aData->shift->break_4_end)),
                    ],
                    'break_5' => [
                        'start' => is_null($aData->shift->break_5_start)?null:date('Hi',strtotime($aData->shift->break_5_start)),
                        'end'   => is_null($aData->shift->break_5_end)?null:date('Hi',strtotime($aData->shift->break_5_end)),
                    ]
                ];
            }
        }

        return response()->json([
            $results
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
