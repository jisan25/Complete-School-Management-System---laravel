<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use PDF;

class MonthlySalaryController extends Controller
{
    public function index()
    {
        return view('backend.employee.monthly_salary.index_monthly_salary');
    }
    public function show(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['employee'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($data as $key => $attend) {
            $totalAttend = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentCount = count($totalAttend->where('attend_status', 'absent'));
            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['employee']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['employee']['salary'] . '</td>';


            $salary = (float)$attend['employee']['salary'];
            $salaryPerDay = (float)$salary / 30;
            $totalSalaryMinus =  (float)$absentCount * (float)($salaryPerDay);
            $totalSalary = (float)$salary - (float)$totalSalaryMinus;

            $html[$key]['tdsource'] .= '<td>' . $totalSalary . '$' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route("employee.monthly_salary.payslip", $attend->employee_id) . '">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }
    public function payslip(Request $request, $employee_id)
    {
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();

        $date = date('Y-m', strtotime($id->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data['details'] = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id', $id->employee_id)->get();
        $pdf = PDF::loadView('backend.employee.monthly_salary.show_monthly_salary_pdf', $data);
        $pdf->setPaper('a4', 'potrait');
        $name = $data['details']['0']['employee']['name'];
        return $pdf->stream("$name - Monthly Salary.pdf");
    }
}
