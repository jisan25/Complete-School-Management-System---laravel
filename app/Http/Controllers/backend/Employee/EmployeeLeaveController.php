<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeLeave;
use App\Http\Controllers\Controller;
use App\Models\LeavePurpose;

class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $all['data'] = EmployeeLeave::orderBy('id', 'desc')->get();
        return view('backend.employee.employee_leave.index_employee_leave', $all);
    }
    public function create()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['purposes'] = LeavePurpose::all();
        return view('backend.employee.employee_leave.create_employee_leave', $data);
    }
    public function store(Request $request)
    {
        if ($request->leave_purpose_id == '0') {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leavepurpose_id = $leavepurpose->id;
        } else {
            $leavepurpose_id = $request->leave_purpose_id;
        }
        $data = new EmployeeLeave();
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leavepurpose_id;
        $data->start_date = date('Y-m-d', strtotime($request->start_date));
        $data->end_date = date('Y-m-d', strtotime($request->end_date));
        $data->save();

        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.leave.index')->with($notification);
    }
    public function edit($id)
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['purposes'] = LeavePurpose::all();
        $data['editData'] = EmployeeLeave::where('id', $id)->first();
        return view('backend.employee.employee_leave.edit_employee_leave', $data);
    }
    public function update(Request $request, $id)
    {

        if ($request->leave_purpose_id == '0') {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leavepurpose_id = $leavepurpose->id;
        } else {
            $leavepurpose_id = $request->leave_purpose_id;
        }
        $data = EmployeeLeave::find($id);
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leavepurpose_id;
        $data->start_date = date('Y-m-d', strtotime($request->start_date));
        $data->end_date = date('Y-m-d', strtotime($request->end_date));
        $data->save();

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.leave.index')->with($notification);
    }
    public function destroy($id)
    {
        $delete = EmployeeLeave::find($id)->delete();

        $notification = array(
            'message' => 'Information Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
