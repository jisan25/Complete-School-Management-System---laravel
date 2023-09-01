<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = StudentGroup::all();
        return view('backend.setup.student_group.view_group', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.student_group.create_group');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:student_groups,name'
        ]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student_group.view')->with($notification);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $all['data'] = StudentGroup::findOrFail($id);
        return view('backend.setup.student_group.edit_group', $all);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|unique:student_groups,name,' . $id,
        ]);

        StudentGroup::findOrFail($id)->update([
            'name' => $request->name
        ]);
        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student_group.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StudentGroup::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
