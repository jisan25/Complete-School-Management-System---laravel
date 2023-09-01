<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;

class EmployeeSalaryController extends Controller
{
    public function index()
    {
        $all['data'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_salary.index_employee_salary', $all);
    }
    public function increment($id)
    {
        $all['data'] = User::find($id);
        return view('backend.employee.employee_salary.increment_employee_salary', $all);
    }
    public function update(Request $request, $id)
    {
        $employee = User::find($id);
        $previous_salary = $employee->salary;
        $present_salary = (float)$previous_salary + (float)$request->increment_salary;
        $employee->salary = $present_salary;
        $employee->save();

        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salaryData->save();

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.salary.index')->with($notification);
    }
    public function show($id)
    {
        $all['data'] = User::find($id);
        $all['salary_log'] = EmployeeSalaryLog::where('employee_id', $all['data']->id)->get();
        return view('backend.employee.employee_salary.details_employee_salary', $all);
    }
}
