<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;

class AccountSalaryController extends Controller
{
    public function index()
    {
        $all['data'] = AccountEmployeeSalary::all();
        return view('backend.account.employee_salary.index_employee_salary', $all);
    }
    public function create()
    {
        return view('backend.account.employee_salary.create_employee_salary');
    }
    public function get_employees(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['employee'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource']  = '<th>ID NO</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Select</th>';


        foreach ($data as $key => $attend) {

            $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)->where('date', $date)->first();

            if ($account_salary != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $totalAttend = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentCount = count($totalAttend->where('attend_status', 'absent'));
            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['employee']['id_no'] . '<input type="hidden" name="date" value="' . $date . '"/>' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['employee']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['employee']['salary'] . '</td>';


            $salary = (float)$attend['employee']['salary'];
            $salaryPerDay = (float)$salary / 30;
            $totalSalaryMinus =  (float)$absentCount * (float)($salaryPerDay);
            $totalSalary = (float)$salary - (float)$totalSalaryMinus;

            $html[$key]['tdsource'] .= '<td>' . $totalSalary . '<input type="hidden" name="amount[]" value="' . $totalSalary . '"/>' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="employee_id[]" value="' . $attend->employee_id . '">' . '<input type="checkbox" name="checkmanage[]" id="' . $key . '" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left: 10px;"> <label for="' . $key . '"> </label> ' . '</td>';
        }
        return response()->json(@$html);
    }
    public function store(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        AccountEmployeeSalary::where('date', $date)->delete();

        $checkData = $request->checkmanage;

        if ($checkData != null) {
            for ($i = 0; $i < count($checkData); $i++) {
                $data = new AccountEmployeeSalary();
                $data->date = $request->date;
                $data->employee_id = $request->employee_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            }
        }

        if (!empty(@$data) || empty($checkData)) {
            $notification = array(
                'message' => 'Information Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('account.salary.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Sorry Data not saved',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
