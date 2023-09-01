<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    public function index()
    {
        $all['data'] = AccountOtherCost::orderBy('id', 'desc')->get();
        return view('backend.account.other_cost.index_other_cost', $all);
    }
    public function create()
    {
        return view('backend.account.other_cost.create_other_cost');
    }
    public function store(Request $request)
    {
        $db = new AccountOtherCost();
        $db->date = date('Y-m-d', strtotime($request->date));
        $db->amount = $request->amount;
        $db->description = $request->description;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalName();
            $file->move(public_path('upload/other_cost'), $filename);
            $db['image'] = $filename;
        }

        $db->save();

        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('other_cost.index')->with($notification);
    }
    public function edit($id)
    {
        $all['data'] = AccountOtherCost::findOrFail($id);
        return view('backend.account.other_cost.edit_other_cost', $all);
    }
    public function update(Request $request, $id)
    {
        $db = AccountOtherCost::find($id);
        $db->date = date('Y-m-d', strtotime($request->date));
        $db->amount = $request->amount;
        $db->description = $request->description;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/other_cost/' . $db->image));
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalName();
            $file->move(public_path('upload/other_cost'), $filename);
            $db['image'] = $filename;
        }

        $db->save();

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('other_cost.index')->with($notification);
    }
}
