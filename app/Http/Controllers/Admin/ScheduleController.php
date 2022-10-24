<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shift;
use App\Models\Machine;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|office-admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.schedule.index',[
            'title'     => 'Admin: Schedule',
            'shifts'    => Shift::all(),
            'machines'  => Machine::all(),
        ]);
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
    public function store(ScheduleRequest $request)
    {
        //
        if($request->machine_id != 0){

            Schedule::create([
                'machine_id'    => $request->machine_id,
                'shift_id'      => $request->shift_id,
                'start'         => $request->start,
                'end'           => $request->end
            ]);

            return response()->json([
                'message' => 'Data Already Submitted',
            ],200);
        }

        $machines = Machine::all();
        $multiCreate = [];
        foreach ($machines as $machine) {
            $multiCreate[] = [
                'machine_id'    => $machine->id,
                'shift_id'      => $request->shift_id,
                'start'         => $request->start,
                'end'           => $request->end
            ];
        }
        Schedule::insert($multiCreate);

        return response()->json([
            'message' => 'All Data Already Submitted',
        ],200);
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
    public function edit(Schedule $schedule)
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
    public function update(Request $request, Schedule $schedule)
    {
        //
        $schedule->update([
            'start'         => $request->start,
            'end'           => $request->end
        ]);

        return response()->json([
            'message'   => 'Data updated successfully'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
        $schedule->delete();
        return response()->json(200);
    }

    public function data(Request $request)
    {
        // dd($request);
        $schedules = Schedule::all();
        if ($request->machine_id != 'all') {
            $schedules = Schedule::where('machine_id',$request->machine_id)->get();
        }

        $scheduleData = [];
        foreach ($schedules as $schedule) {
            $scheduleData[] = [
                'id'                => $schedule->id,
                'title'             => $schedule->machine->name ." | ". $schedule->shift->name,
                'backgroundColor'   => $schedule->shift->background_color,
                'borderColor'       => $schedule->shift->background_color,
                'start'             => date('Y-m-d',strtotime($schedule->start)) . " " . $schedule->shift->start_time,
                'end'               => date('Y-m-d',strtotime($schedule->end)) . " " . $schedule->shift->end_time,
                'allDay'            => true
            ];
        }   
        return response()->json($scheduleData,200);
    }
}
