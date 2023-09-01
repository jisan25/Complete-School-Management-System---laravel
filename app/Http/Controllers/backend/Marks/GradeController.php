<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $all['data'] = MarksGrade::all();
        return view('backend.marks.index_grade_marks', $all);
    }
    public function create()
    {
        return view('backend.marks.create_grade_marks');
    }
    public function store(Request $request)
    {
        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('marks_entry.grade.index')->with($notification);
    }
    public function edit($id)
    {
        $all['data'] = MarksGrade::find($id);
        return view('backend.marks.edit_grade_marks', $all);
    }
    public function update(Request $request, $id)
    {
        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('marks_entry.grade.index')->with($notification);
    }
}
