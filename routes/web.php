<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\Report\IdCardController;
use App\Http\Controllers\Backend\Report\ProfitController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Report\MarkSheetController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Employee\EmployeeController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Setup\DesignnationController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Report\AttendReportController;
use App\Http\Controllers\Backend\Report\ResultReportController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Student\StudentRollGenController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'], function () {




    Route::get('/', function () {
        return view('auth.login');
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('dashboard');
    });

    Route::get('/admin/logout', [AdminController::class, 'LogOut'])->name('admin.logout');


    Route::group(['middleware' => 'auth'], function () {


        // User Management All Routes

        Route::prefix('user')->group(function () {
            Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
            Route::get('/add', [UserController::class, 'AddUser'])->name('user.add');
            Route::post('/store', [UserController::class, 'StoreUser'])->name('user.store');
            Route::get('/edit/{id}', [UserController::class, 'EditUser'])->name('user.edit');
            Route::post('/update', [UserController::class, 'UpdateUser'])->name('user.update');
            Route::get('/delete/{id}', [UserController::class, 'DeleteUser'])->name('user.delete');
        });


        // User Profile and Change Password

        Route::prefix('profile')->group(function () {
            Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
            Route::get('/edit', [ProfileController::class, 'EditProfile'])->name('profile.edit');
            Route::post('/update', [ProfileController::class, 'UpdateProfile'])->name('profile.update');
            Route::get('/password_view', [ProfileController::class, 'PasswordView'])->name('password.view');
            Route::post('/password_update', [ProfileController::class, 'UpdatePassword'])->name('password.update');
        });

        // Setup 

        Route::prefix('setups')->group(function () {

            // Student Class Routes

            Route::get('student_class/view', [StudentClassController::class, 'index'])->name('student_class.view');
            Route::get('student_class/create', [StudentClassController::class, 'create'])->name('student_class.create');
            Route::post('student_class/store', [StudentClassController::class, 'store'])->name('student_class.store');
            Route::get('student_class/edit/{id}', [StudentClassController::class, 'edit'])->name('student_class.edit');
            Route::post('student_class/update/{id}', [StudentClassController::class, 'update'])->name('student_class.update');
            Route::get('student_class/destroy/{id}', [StudentClassController::class, 'destroy'])->name('student_class.destroy');

            // Student Year Routes

            Route::get('student_year/view', [StudentYearController::class, 'index'])->name('student_year.view');
            Route::get('student_year/create', [StudentYearController::class, 'create'])->name('student_year.create');
            Route::post('student_year/store', [StudentYearController::class, 'store'])->name('student_year.store');
            Route::get('student_year/edit/{id}', [StudentYearController::class, 'edit'])->name('student_year.edit');
            Route::post('student_year/update/{id}', [StudentYearController::class, 'update'])->name('student_year.update');
            Route::get('student_year/destroy/{id}', [StudentYearController::class, 'destroy'])->name('student_year.destroy');

            // Student Group Routes

            Route::get('student_group/view', [StudentGroupController::class, 'index'])->name('student_group.view');
            Route::get('student_group/create', [StudentGroupController::class, 'create'])->name('student_group.create');
            Route::post('student_group/store', [StudentGroupController::class, 'store'])->name('student_group.store');
            Route::get('student_group/edit/{id}', [StudentGroupController::class, 'edit'])->name('student_group.edit');
            Route::post('student_group/update/{id}', [StudentGroupController::class, 'update'])->name('student_group.update');
            Route::get('student_group/destroy/{id}', [StudentGroupController::class, 'destroy'])->name('student_group.destroy');

            // Student Shift Routes

            Route::get('student_shift/view', [StudentShiftController::class, 'index'])->name('student_shift.view');
            Route::get('student_shift/create', [StudentShiftController::class, 'create'])->name('student_shift.create');
            Route::post('student_shift/store', [StudentShiftController::class, 'store'])->name('student_shift.store');
            Route::get('student_shift/edit/{id}', [StudentShiftController::class, 'edit'])->name('student_shift.edit');
            Route::post('student_shift/update/{id}', [StudentShiftController::class, 'update'])->name('student_shift.update');
            Route::get('student_shift/destroy/{id}', [StudentShiftController::class, 'destroy'])->name('student_shift.destroy');

            // Fee Category Routes

            Route::get('fee_category/view', [FeeCategoryController::class, 'index'])->name('fee_category.view');
            Route::get('fee_category/create', [FeeCategoryController::class, 'create'])->name('fee_category.create');
            Route::post('fee_category/store', [FeeCategoryController::class, 'store'])->name('fee_category.store');
            Route::get('fee_category/edit/{id}', [FeeCategoryController::class, 'edit'])->name('fee_category.edit');
            Route::post('fee_category/update/{id}', [FeeCategoryController::class, 'update'])->name('fee_category.update');
            Route::get('fee_category/destroy/{id}', [FeeCategoryController::class, 'destroy'])->name('fee_category.destroy');

            // Fee Category Amount Routes

            Route::get('fee_amount/view', [FeeAmountController::class, 'index'])->name('fee_amount.view');
            Route::get('fee_amount/create', [FeeAmountController::class, 'create'])->name('fee_amount.create');
            Route::post('fee_amount/store', [FeeAmountController::class, 'store'])->name('fee_amount.store');
            Route::get('fee_amount/edit/{id}', [FeeAmountController::class, 'edit'])->name('fee_amount.edit');
            Route::post('fee_amount/update/{id}', [FeeAmountController::class, 'update'])->name('fee_amount.update');
            Route::get('fee_amount/show/{id}', [FeeAmountController::class, 'show'])->name('fee_amount.show');

            // exam type routes

            Route::get('exam_type/index', [ExamTypeController::class, 'index'])->name('exam_type.index');
            Route::get('exam_type/create', [ExamTypeController::class, 'create'])->name('exam_type.create');
            Route::post('exam_type/store', [ExamTypeController::class, 'store'])->name('exam_type.store');
            Route::get('exam_type/edit/{id}', [ExamTypeController::class, 'edit'])->name('exam_type.edit');
            Route::post('exam_type/update/{id}', [ExamTypeController::class, 'update'])->name('exam_type.update');
            Route::get('exam_type/destroy/{id}', [ExamTypeController::class, 'destroy'])->name('exam_type.destroy');

            // school subject routes

            Route::get('school_subject/index', [SchoolSubjectController::class, 'index'])->name('school_subject.index');
            Route::get('school_subject/create', [SchoolSubjectController::class, 'create'])->name('school_subject.create');
            Route::post('school_subject/store', [SchoolSubjectController::class, 'store'])->name('school_subject.store');
            Route::get('school_subject/edit/{id}', [SchoolSubjectController::class, 'edit'])->name('school_subject.edit');
            Route::post('school_subject/update/{id}', [SchoolSubjectController::class, 'update'])->name('school_subject.update');
            Route::get('school_subject/destroy/{id}', [SchoolSubjectController::class, 'destroy'])->name('school_subject.destroy');

            // assign subject routes

            Route::get('assign_subject/index', [AssignSubjectController::class, 'index'])->name('assign_subject.index');
            Route::get('assign_subject/create', [AssignSubjectController::class, 'create'])->name('assign_subject.create');
            Route::post('assign_subject/store', [AssignSubjectController::class, 'store'])->name('assign_subject.store');
            Route::get('assign_subject/edit/{id}', [AssignSubjectController::class, 'edit'])->name('assign_subject.edit');
            Route::post('assign_subject/update/{id}', [AssignSubjectController::class, 'update'])->name('assign_subject.update');
            Route::get('assign_subject/show/{id}', [AssignSubjectController::class, 'show'])->name('assign_subject.show');

            // Designation routes

            Route::get('designation/index', [DesignnationController::class, 'index'])->name('designation.index');
            Route::get('designation/create', [DesignnationController::class, 'create'])->name('designation.create');
            Route::post('designation/store', [DesignnationController::class, 'store'])->name('designation.store');
            Route::get('designation/edit/{id}', [DesignnationController::class, 'edit'])->name('designation.edit');
            Route::post('designation/update/{id}', [DesignnationController::class, 'update'])->name('designation.update');
            Route::get('designation/destroy/{id}', [DesignnationController::class, 'destroy'])->name('designation.destroy');
        });

        // Student Registration Routes

        Route::prefix('student')->group(function () {
            Route::get('/reg/index', [StudentRegController::class, 'index'])->name('student_registration.index');
            Route::get('/reg/create', [StudentRegController::class, 'create'])->name('student_registration.create');
            Route::post('/reg/store', [StudentRegController::class, 'store'])->name('student_registration.store');
            Route::get('/filter', [StudentRegController::class, 'filter'])->name('student.filter');
            Route::get('/reg/edit/{id}', [StudentRegController::class, 'edit'])->name('student_registration.edit');
            Route::post('/reg/update/{id}', [StudentRegController::class, 'update'])->name('student_registration.update');
            Route::get('/reg/promote/{id}', [StudentRegController::class, 'promote'])->name('student_registration.promote');
            Route::post('/reg/update_promote/{id}', [StudentRegController::class, 'update_promote'])->name('student_registration.update_promote');
            Route::get('/reg/show/{id}', [StudentRegController::class, 'show'])->name('student_registration.show');



            // Student Roll Generate Routes

            Route::get('/roll_generate/index', [StudentRollGenController::class, 'index'])->name('roll_generate.index');
            Route::post('/roll_generate/store', [StudentRollGenController::class, 'store'])->name('roll_generate.store');
            // api routes for getting students for roll generate
            Route::get('/reg/get_students', [StudentRollGenController::class, 'get_students'])->name('student_registration.get_students');

            // Registration Fee Routes
            Route::get('/reg_fee/index', [RegistrationFeeController::class, 'index'])->name('reg_fee.index');
            Route::get('/reg_fee/classwise_get', [RegistrationFeeController::class, 'student_reg_fee_classwise_get'])->name('student.registration.fee.classwise.get');
            Route::get('/reg_fee/payslip', [RegistrationFeeController::class, 'student_reg_fee_payslip'])->name('student.registration.fee.payslip');

            // Monthly Fee Routes

            Route::get('/monthly_fee/index', [MonthlyFeeController::class, 'index'])->name('monthly_fee.index');

            Route::get('/monthly_fee/classwise_get', [MonthlyFeeController::class, 'student_monthly_fee_classwise_get'])->name('student.monthly_fee.classwise.get');
            Route::get('/monthly_fee/payslip', [MonthlyFeeController::class, 'student_monthly_fee_payslip'])->name('student.monthly.fee.payslip');

            // Exam Fee Routes
            Route::get('/exam_fee/index', [ExamFeeController::class, 'index'])->name('exam_fee.index');
            Route::get('/exam_fee/classwise_get', [ExamFeeController::class, 'student_exam_fee_classwise_get'])->name('student.registration.fee.classwise.get');
            Route::get('/exam_fee/payslip', [ExamFeeController::class, 'student_exam_fee_payslip'])->name('student.exam_fee.payslip');
        });


        // Employe Managemnet Routes

        Route::prefix('employee')->group(function () {
            Route::get('/reg/index', [EmployeeController::class, 'index'])->name('employee.reg.index');
            Route::get('/reg/create', [EmployeeController::class, 'create'])->name('employee.reg.create');
            Route::post('/reg/store', [EmployeeController::class, 'store'])->name('employee.reg.store');
            Route::get('/reg/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.reg.edit');
            Route::post('/reg/update/{id}', [EmployeeController::class, 'update'])->name('employee.reg.update');
            Route::get('/reg/show/{id}', [EmployeeController::class, 'show'])->name('employee.reg.show');

            // Employee Salary Routes

            Route::get('/salary/index', [EmployeeSalaryController::class, 'index'])->name('employee.salary.index');
            Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'increment'])->name('employee.salary.increment');
            Route::post('/salary/update/{id}', [EmployeeSalaryController::class, 'update'])->name('employee.salary.update');
            Route::get('/salary/show/{id}', [EmployeeSalaryController::class, 'show'])->name('employee.salary.show');

            // Employee Leave Routes
            Route::get('/leave/index', [EmployeeLeaveController::class, 'index'])->name('employee.leave.index');
            Route::get('/leave/create', [EmployeeLeaveController::class, 'create'])->name('employee.leave.create');
            Route::post('/leave/store', [EmployeeLeaveController::class, 'store'])->name('employee.leave.store');
            Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'edit'])->name('employee.leave.edit');
            Route::post('/leave/update/{id}', [EmployeeLeaveController::class, 'update'])->name('employee.leave.update');
            Route::get('/leave/destroy/{id}', [EmployeeLeaveController::class, 'destroy'])->name('employee.leave.destroy');

            // Employee Attendance Routes
            Route::get('/attendance/index', [EmployeeAttendanceController::class, 'index'])->name('employee.attendance.index');
            Route::get('/attendance/create', [EmployeeAttendanceController::class, 'create'])->name('employee.attendance.create');
            Route::post('/attendance/store', [EmployeeAttendanceController::class, 'store'])->name('employee.attendance.store');
            Route::get('/attendance/edit/{id}', [EmployeeAttendanceController::class, 'edit'])->name('employee.attendance.edit');
            Route::get('/attendance/show/{id}', [EmployeeAttendanceController::class, 'show'])->name('employee.attendance.show');

            // Employee Monthly Salary Routes
            Route::get('/monthly_salary/index', [MonthlySalaryController::class, 'index'])->name('employee.monthly_salary.index');
            Route::get('/monthly_salary/show', [MonthlySalaryController::class, 'show'])->name('employee.monthly_salary.show');
            Route::get('/monthly_salary/payslip/{id}', [MonthlySalaryController::class, 'payslip'])->name('employee.monthly_salary.payslip');


            Route::post('/attendance/store', [EmployeeAttendanceController::class, 'store'])->name('employee.attendance.store');
            Route::get('/attendance/edit/{id}', [EmployeeAttendanceController::class, 'edit'])->name('employee.attendance.edit');
            Route::get('/attendance/show/{id}', [EmployeeAttendanceController::class, 'show'])->name('employee.attendance.show');
            Route::get('/attendance/show/{id}', [EmployeeAttendanceController::class, 'show'])->name('employee.attendance.show');
        });

        // Marks Managemnet Routes

        Route::prefix('mark')->group(function () {
            Route::get('/entry/create', [MarksController::class, 'create'])->name('marks.entry.create');
            Route::post('/entry/store', [MarksController::class, 'store'])->name('marks.entry.store');
            Route::get('/entry/edit', [MarksController::class, 'edit'])->name('marks.entry.edit');
            Route::post('/entry/update', [MarksController::class, 'update'])->name('marks.entry.update');

            Route::get('/subject/get', [MarksController::class, 'get_subject'])->name('marks.getsubject');
            Route::get('/students/get', [MarksController::class, 'get_students'])->name('marks.getstudents');
            Route::get('/students/get/edit', [MarksController::class, 'edit_get_students'])->name('marks.getstudents.edit');


            // Marks Entry Grade Routes

            Route::get('/entry/grade/index', [GradeController::class, 'index'])->name('marks_entry.grade.index');
            Route::get('/entry/grade/create', [GradeController::class, 'create'])->name('marks_entry.grade.create');
            Route::post('/entry/grade/store', [GradeController::class, 'store'])->name('marks_entry.grade.store');
            Route::get('/entry/grade/edit/{id}', [GradeController::class, 'edit'])->name('marks_entry.grade.edit');
            Route::post('/entry/grade/update/{id}', [GradeController::class, 'update'])->name('marks_entry.grade.update');
        });

        // Accounts Managemnet Routes

        Route::prefix('accounts')->group(function () {

            Route::get('/student_fee/index', [StudentFeeController::class, 'index'])->name('student_fee.index');
            Route::get('/student_fee/create', [StudentFeeController::class, 'create'])->name('student_fee.create');
            Route::post('/student_fee/store', [StudentFeeController::class, 'store'])->name('account.fee.store');

            Route::get('/student_fee/get_students', [StudentFeeController::class, 'get_students'])->name('account.fee.get_students');

            // Employee Salary Routes

            Route::get('/salary/index', [AccountSalaryController::class, 'index'])->name('account.salary.index');

            Route::get('/salary/create', [AccountSalaryController::class, 'create'])->name('account_salary.create');

            Route::post('/salary/store', [AccountSalaryController::class, 'store'])->name('account_salary.store');

            Route::get('/salary/get_employees', [AccountSalaryController::class, 'get_employees'])->name('account_salary.get_employees');

            // Othe Cost Routes

            Route::get('/other_cost/index', [OtherCostController::class, 'index'])->name('other_cost.index');
            Route::get('/other_cost/create', [OtherCostController::class, 'create'])->name('other_cost.create');
            Route::post('/other_cost/store', [OtherCostController::class, 'store'])->name('other_cost.store');
            Route::get('/other_cost/edit/{id}', [OtherCostController::class, 'edit'])->name('other_cost.edit');
            Route::post('/other_cost/update/{id}', [OtherCostController::class, 'update'])->name('other_cost.update');
        });

        // Reports Managemnet Routes

        Route::prefix('reports')->group(function () {

            Route::get('/monthly_profit/index', [ProfitController::class, 'index'])->name('monthly_profit.index');

            Route::get('/monthly_profit/show', [ProfitController::class, 'show'])->name('report.profit.datewise.show');

            Route::get('/monthly_profit/pdf', [ProfitController::class, 'pdf'])->name('report.profit.pdf');

            // marksheet generate routes

            Route::get('/marksheet_generate/index', [MarkSheetController::class, 'index'])->name('marksheet_generate.index');
            Route::get('/marksheet/get', [MarkSheetController::class, 'marksheet_get'])->name('report.marksheet.get');

            // attendance report routes

            Route::get('/attendance_report/index', [AttendReportController::class, 'index'])->name('attendance_report.index');
            Route::get('/attendance_report/get', [AttendReportController::class, 'get'])->name('attendance_report.get');

            // all students results

            Route::get('/student_result/index', [ResultReportController::class, 'index'])->name('student_result.index');
            Route::get('/student_result/get', [ResultReportController::class, 'get'])->name('student_result.report.get');

            // all students results

            Route::get('/student_id_card/index', [IdCardController::class, 'index'])->name('student_id_card.index');
            Route::get('/student_id_card/get', [IdCardController::class, 'get'])->name('student_id_card.report.get');
        });
    }); // End Middleware Auth Route

}); // Prevent Back Button After Logout
