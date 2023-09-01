<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\ExamType;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;
use PDF;

class ExamFeeController extends Controller
{
    public function index()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exams'] = ExamType::all();
        return view('backend.student.exam_fee.index_exam_fee', $data);
    }
    public function student_exam_fee_classwise_get(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam = $request->exam;
        if ($year_id != '') {
            $where[] = ['year_id', 'like', $year_id . '%'];
        }
        if ($class_id != '') {
            $where[] = ['class_id', 'like', $class_id . '%'];
        }
        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Exam Fee</th>';
        $html['thsource'] .= '<th>Discount </th>';
        $html['thsource'] .= '<th>Student Fee </th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($allStudent as $key => $v) {
            $exam_fee = FeeCategoryAmount::where('fee_category_id', '2')->where('class_id', $v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['id_no'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->roll . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $exam_fee->amount . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['discount']['discount'] . '%' . '</td>';

            $originalfee = $exam_fee->amount;
            $discount = $v['discount']['discount'];
            $discounttablefee = $discount / 100 * $originalfee;
            $finalfee = (float)$originalfee - (float)$discounttablefee;

            $html[$key]['tdsource'] .= '<td>' . $finalfee . '$' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route("student.exam_fee.payslip") . '?class_id=' . $v->class_id . '&student_id=' . $v->student_id . '&exam_type=' . $exam . '">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }
    public function student_exam_fee_payslip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $all['exam'] = $request->exam_type;
        $all['data'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->where('class_id', $class_id)->first();

        $pdf = PDF::loadView('backend.student.exam_fee.show_exam_fee_pdf', $all);
        $pdf->setPaper('a4', 'potrait');
        $name = $all['data']['student']['name'];
        return $pdf->stream("$name exam_fee-details.pdf");
    }
}
