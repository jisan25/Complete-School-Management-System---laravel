<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\ExamType;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Response;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function create()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exams'] = ExamType::all();

        return view('backend.marks.create_marks', $data);
    }


    public function store(Request $request)
    {
        $totalStudent = count($request->student_id);
        if ($request->student_id) {
            for ($i = 0; $i < $totalStudent; $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
        }
        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exams'] = ExamType::all();

        return view('backend.marks.edit_marks', $data);
    }

    public function update(Request $request)
    {
        StudentMarks::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('assign_subject_id', $request->assign_subject_id)->where('exam_type_id', $request->exam_type_id)->delete();

        $totalStudent = count($request->student_id);
        if ($request->student_id) {
            for ($i = 0; $i < $totalStudent; $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
        }
        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $data = AssignSubject::with(['get_subject'])->where('class_id', $class_id)->get();
        return response()->json($data);
    }
    public function get_students(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $data = AssignStudent::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)->get();
        return response()->json($data);
    }
    public function edit_get_students(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $data = StudentMarks::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)->where('assign_subject_id', $assign_subject_id)->where('exam_type_id', $exam_type_id)->get();
        return response()->json($data);



        return response()->json($data);
    }
}
