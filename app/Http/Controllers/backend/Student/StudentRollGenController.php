<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentRollGenController extends Controller
{
    public function index()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.student.roll_generate.index_roll_generate', $data);
    }
    public function get_students(Request $request)
    {
        // dd('ok');
        $data = AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return response()->json($data);
        // dd($data->toArray());
    }
    public function store(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->student_id != null) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->where('student_id', $request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }
        } else {
            $notification = array(
                'message' => 'Sorry! You have not selected any student',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Informtion updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('roll_generate.index')->with($notification);
    }
}
