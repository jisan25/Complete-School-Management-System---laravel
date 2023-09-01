<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function index()
    {
        $all['data'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id', 'DESC')->get();
        // $all['data'] = EmployeeAttendance::orderBy('id', 'DESC')->get();
        return view('backend.employee.employee_attendance.index_employee_attendance', $all);
    }
    public function create()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_attendance.create_employee_attendance', $data);
    }
    public function store(Request $request)
    {
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        $count = count($request->employee_id);
        for ($i = 0; $i < $count; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.attendance.index')->with($notification);
    }
    public function edit($date)
    {
        $all['data'] = EmployeeAttendance::where('date', $date)->get();
        $all['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_attendance.edit_employee_attendance', $all);
    }
    public function show($date)
    {
        $all['data'] = EmployeeAttendance::where('date', $date)->get();
        // $all['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_attendance.show_employee_attendance', $all);
    }
}
