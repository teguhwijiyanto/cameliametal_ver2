<?php

namespace App\Http\Controllers;

use App\Models\Downtime;
use Illuminate\Http\Request;
use App\Models\DowntimeRemark;

class DowntimeRemarkController extends Controller
{
    //

    public function submitDowntimeRemark(Request $request)
    {
        $downtime = Downtime::where('downtime_number',$request->downtimeNumber);
        
        if(count($downtime->get())==0)
        {
            return response()->json([
                'message' => 'Downtime Data Not Found'
            ],404);
        }

        $validated = $request->validate([
            'downtimeNumber'    => 'required|numeric',
            'downtimeCategory'  => 'required',
            'downtimeReason'    => 'required',
        ]);

        DowntimeRemark::where('downtime_id',$downtime->get()[0]->id)->delete();

        DowntimeRemark::create([
            'downtime_id'       => $downtime->get()[0]->id,
            'is_waste_downtime' => ($request->downtimeCategory == 'waste')?true:false,
            'downtime_reason'   => $request->downtimeReason,
            'remarks'           => $request->downtimeRemarks,
        ]);

        $downtime->update([
            'is_remark_filled' => true,
        ]);
        
        return response()->json([
            'message' => 'data updated successfully',
        ],200);
    }
}
