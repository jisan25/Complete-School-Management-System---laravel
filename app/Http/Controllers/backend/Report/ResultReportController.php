<?php

namespace App\Http\Controllers\Backend\Report;

use App\Models\ExamType;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class ResultReportController extends Controller
{
    public function index()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.report.student_result.index_student_result', $data);
    }
    public function get(Request $request)
    {
        $year_id = $request->year_id;
        $class_id =  $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $singleResult = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->first();
        if ($singleResult == true) {



            $data['allData'] = StudentMarks::select('year_id', 'class_id', 'exam_type_id', 'student_id')->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();



            // dd($data['allData']->toArray());

            $pdf = PDF::loadView('backend.report.student_result.pdf_student_result', $data);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream("Monthly/Yearly_Profit_Report.pdf");
        } else {
            $notification = array(
                'message' => 'Sorry This Criteria Does not Match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
