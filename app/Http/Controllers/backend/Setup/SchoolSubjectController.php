<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SchoolSubject::all();
        return view('backend.setup.school_subject.index_school_subject', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.school_subject.create_school_subject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:school_subjects,name'
        ]);
        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school_subject.index')->with($notification);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $all['data'] = SchoolSubject::findOrFail($id);
        return view('backend.setup.school_subject.edit_school_subject', $all);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|unique:school_subjects,name,' . $id,
        ]);

        SchoolSubject::findOrFail($id)->update([
            'name' => $request->name
        ]);
        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('school_subject.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SchoolSubject::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
