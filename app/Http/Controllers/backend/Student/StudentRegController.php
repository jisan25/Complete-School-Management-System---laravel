<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB as FacadesDB;
use PDF;


class StudentRegController extends Controller
{
    public function index()
    {
        $all['years'] = StudentYear::all();
        $all['classes'] = StudentClass::all();
        $all['year_id'] = StudentYear::orderBy('id', 'desc')->first()->id;
        $all['class_id'] = StudentClass::orderBy('id', 'desc')->first()->id;
        $all['assignStudentData'] = AssignStudent::where('year_id', $all['year_id'])->where('class_id', $all['class_id'])->get();
        return view('backend.student.student_reg.index_student', $all);
    }

    public function filter(Request $request)
    {
        $all['years'] = StudentYear::all();
        $all['classes'] = StudentClass::all();

        $all['year_id'] = $request->year_id;
        $all['class_id'] = $request->class_id;

        $all['assignStudentData'] = AssignStudent::where('year_id', $all['year_id'])->where('class_id', $all['class_id'])->get();
        return view('backend.student.student_reg.index_student', $all);
    }

    public function create()
    {
        $all['years'] = StudentYear::all();
        $all['classes'] = StudentClass::all();
        $all['groups'] = StudentGroup::all();
        $all['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.create_student', $all);
    }

    public function store(Request $request)
    {
        FacadesDB::transaction(function () use ($request) {
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first();

            if ($student == null) {
                $firstReg = 0;
                $studentId = $firstReg + 1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            } else {
                $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student + 1;

                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            }
            $final_id_no = $checkYear . $id_no;
            $user = new User();
            $code = rand(00000, 99999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->usertype = 'student';
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = hexdec(uniqid()) . '.' . str_replace(' ', '', $file->getClientOriginalName());
                $file->move(public_path('upload/students'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->save();

            $discount = new DiscountStudent();
            $discount->assign_student_id = $assign_student->id;
            $discount->fee_category_id = '1';
            $discount->discount = $request->discount;
            $discount->save();
        });
        $notification = array(
            'message' => 'Information Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student_registration.index')->with($notification);
    }
    public function edit($student_id)
    {
        $all['years'] = StudentYear::all();
        $all['classes'] = StudentClass::all();
        $all['groups'] = StudentGroup::all();
        $all['shifts'] = StudentShift::all();
        $all['data'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        return view('backend.student.student_reg.edit_student', $all);
    }

    public function update(Request $request, $student_id)
    {
        FacadesDB::transaction(function () use ($request, $student_id) {

            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/students/' . $user->image));
                $filename = hexdec(uniqid()) . '.' . str_replace(' ', '', $file->getClientOriginalName());
                $file->move(public_path('upload/students'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();
            // dd($assign_student);
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->save();

            $discount = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount->discount = $request->discount;
            $discount->save();
        });
        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student_registration.index')->with($notification);
    }
    public function promote($student_id)
    {
        $all['years'] = StudentYear::all();
        $all['classes'] = StudentClass::all();
        $all['groups'] = StudentGroup::all();
        $all['shifts'] = StudentShift::all();
        $all['data'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        return view('backend.student.student_reg.promote_student', $all);
    }

    public function update_promote(Request $request, $student_id)
    {
        FacadesDB::transaction(function () use ($request, $student_id) {

            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/students/' . $user->image));
                $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalName();
                $file->move(public_path('upload/students'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount = new DiscountStudent();
            $discount->assign_student_id = $assign_student->id;
            $discount->fee_category_id = '1';
            $discount->discount = $request->discount;
            $discount->save();
        });
        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student_registration.index')->with($notification);
    }
    public function show($student_id)
    {
        // dd('ok');
        $all['data'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        // view()->share($all);
        $pdf = PDF::loadView('backend.student.student_reg.show_student_pdf', $all);
        $pdf->setPaper('a4', 'potrait');
        $name = $all['data']['student']['name'];
        return $pdf->stream("$name student_details.pdf");
    }
}
