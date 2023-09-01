<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;

class AssignSubjectController extends Controller
{
    public function index()
    {
        // $all['data'] = AssignSubject::all();
        $all['data'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.index_assign_subject', $all);
    }
    public function create()
    {
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.create_assign_subject', $data);
    }

    public function store(Request $request)
    {
        $countSubject = count($request->subject_id);
        if ($countSubject != NULL) {
            for ($i = 0; $i < $countSubject; $i++) {
                $db = new AssignSubject();
                $db->class_id = $request->class_id;
                $db->subject_id = $request->subject_id[$i];
                $db->full_mark = $request->full_mark[$i];
                $db->pass_mark = $request->pass_mark[$i];
                $db->subjective_mark = $request->subjective_mark[$i];
                $db->save();
            }

            $notification = array(
                'message' => 'Information Inserted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('assign_subject.index')->with($notification);
        }
    }

    public function edit($class_id)
    {
        $all['data'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        // dd($all['data']->toArray());
        $all['classes'] = StudentClass::all();
        $all['subjects'] = SchoolSubject::all();
        return view('backend.setup.assign_subject.edit_assign_subject', $all);
    }
    public function update(Request $request, $class_id)
    {
        if ($request->subject_id == NULL) {
            $notification = array(
                'message' => 'Sorry You do not select any subject',
                'alert-type' => 'error'
            );
            return redirect()->route('assign_subject.edit', $class_id)->with($notification);
        } else {
            $countSubject = count($request->subject_id);
            AssignSubject::where('class_id', $class_id)->delete();
            for ($i = 0; $i < $countSubject; $i++) {
                $db = new AssignSubject();
                $db->class_id = $request->class_id;
                $db->subject_id = $request->subject_id[$i];
                $db->full_mark = $request->full_mark[$i];
                $db->pass_mark = $request->pass_mark[$i];
                $db->subjective_mark = $request->subjective_mark[$i];
                $db->save();
            }
            $notification = array(
                'message' => 'Information Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('assign_subject.index')->with($notification);
        }
    }
    public function show($class_id)
    {
        $all['data'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assign_subject.show_assign_subject', $all);
    }
}
