<?php

namespace App\Http\Controllers;

use App\Models\Smelting;
use PDF;
use App\Models\Workorder;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function displayToPdf(Workorder $wo_id)
    {
        $smeltings = Smelting::where('workorder_id',$wo_id->id)->get();
        $data = [
            'title'     => 'Camellia Metal',
            'data'      => $wo_id,
            'smeltings' => $smeltings
        ];
           
        $pdf = PDF::loadView('user.pdf.index', $data);
        $pdf->setPaper('A4','potrait');
        $pdf->render();
     
        return $pdf->stream('camellia_metal_label.pdf');
    }

    public function printPage(Workorder $wo_id)
    {
        $data = [
            'data'      => $wo_id,
        ];
        $pdf = PDF::loadView('user.workorder.details',$data);
        $pdf->setPaper('A4','potrait');
        $pdf->render();
     
        return $pdf->stream('details_page.pdf');
    }
}
