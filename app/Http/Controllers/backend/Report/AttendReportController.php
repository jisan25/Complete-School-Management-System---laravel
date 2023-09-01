<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class AttendReportController extends Controller
{
    public function index()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.report.attend_report.index_attend_report', $data);
    }
    public function get(Request $request)
    {
        $employee_id = $request->employee_id;
        if ($employee_id != '') {
            $where[] = ['employee_id', $employee_id];
        }

        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }
        $singleAttendance = EmployeeAttendance::with(['employee'])->where($where)->get();

        if ($singleAttendance == true) {
            $data['allData'] = EmployeeAttendance::with(['employee'])->where($where)->get();
            // dd($data['allData']->toArray());

            $data['absents'] = EmployeeAttendance::with(['employee'])->where($where)->where('attend_status', 'absent')->get()->count();
            $data['leaves'] = EmployeeAttendance::with(['employee'])->where($where)->where('attend_status', 'leave')->get()->count();

            $data['month'] = date('m-y', strtotime($request->date));

            $pdf = PDF::loadView('backend.report.attend_report.pdf_attend_report', $data);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream("Employee_Attendance_Report.pdf");
        } else {
            $notification = array(
                'message' => 'Sorry this criteria does not matched',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
