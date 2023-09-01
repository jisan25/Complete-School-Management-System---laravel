<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\FeeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_category', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.fee_category.create_fee_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:fee_categories,name'
        ]);
        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee_category.view')->with($notification);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $all['data'] = FeeCategory::findOrFail($id);
        return view('backend.setup.fee_category.edit_fee_category', $all);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|unique:fee_categories,name,' . $id,
        ]);

        FeeCategory::findOrFail($id)->update([
            'name' => $request->name
        ]);
        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('fee_category.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FeeCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
