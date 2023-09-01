<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use PDF;


class EmployeeController extends Controller
{
    public function index()
    {
        $all['data'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_reg.index_employee_reg', $all);
    }
    public function create()
    {
        $all['designations'] = Designation::all();
        return view('backend.employee.employee_reg.create_employee_reg', $all);
    }
    public function store(Request $request)
    {
        FacadesDB::transaction(function () use ($request) {
            $checkYear = date('Ym', strtotime($request->join_date));
            $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first();

            if ($employee == null) {
                $firstReg = 0;
                $employeeId = $firstReg + 1;
                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            } else {
                $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first()->id;
                $employeeId = $employee + 1;

                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            }
            $final_id_no = $checkYear . $id_no;
            $user = new User();
            $code = rand(00000, 99999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->usertype = 'employee';
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->join_date = date('Y-m-d', strtotime($request->join_date));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = hexdec(uniqid()) . '.' . str_replace(' ', '', $file->getClientOriginalName());
                $file->move(public_path('upload/employees'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $db_salary = new EmployeeSalaryLog();
            $db_salary->employee_id = $user->id;
            $db_salary->effected_salary = date('Y-m-d', strtotime($request->join_date));
            $db_salary->previous_salary = $request->salary;
            $db_salary->present_salary = $request->salary;
            $db_salary->increment_salary = '0';
            $db_salary->save();
        });
        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.reg.index')->with($notification);
    }
    public function edit($employee_id)
    {
        $all['data'] = User::find($employee_id);
        $all['designations'] = Designation::all();
        return view('backend.employee.employee_reg.edit_employee_reg', $all);
    }
    public function update(Request $request, $employee_id)
    {

        $user = User::find($employee_id);
        $user->name = $request->name;
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->designation_id = $request->designation_id;
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->join_date = date('Y-m-d', strtotime($request->join_date));

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/employees/' . $user->image));
            $filename = hexdec(uniqid()) . '.' . str_replace(' ', '', $file->getClientOriginalName());
            $file->move(public_path('upload/employees'), $filename);
            $user['image'] = $filename;
        }
        $user->save();



        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.reg.index')->with($notification);
    }
    public function show($employee_id)
    {
        $all['data'] = User::find($employee_id);
        $pdf = PDF::loadView('backend.employee.employee_reg.show_employee_pdf', $all);
        $pdf->setPaper('a4', 'potrait');
        $name = $all['data']['name'];
        return $pdf->stream("$name employee_details.pdf");
    }
}
