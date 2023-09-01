<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;

class IdCardController extends Controller
{
    public function index()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.report.id_card.index_id_card', $data);
    }
    public function get(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $check_data = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->first();
        if ($check_data == true) {
            $all['data'] = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();


            $pdf = PDF::loadView('backend.report.id_card.pdf_id_card', $all);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream("Student_Id_Card_Report.pdf");
        } else {
            $notification = array(
                'message' => 'Sorry this criteria does not matched',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
