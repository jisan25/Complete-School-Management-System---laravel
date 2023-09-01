@php 
$prefix = Route::current()->getPrefix();
$route = Route::current()->getName();
@endphp 


<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
						  <h3><b>D</b> PATHSHALA</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li class="{{ ($route == 'dashboard') ? 'active':''}}">
          <a href="{{route('dashboard')}}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>  
		
        @if(Auth::user()->role=='admin')

        <li class="treeview {{ ($prefix == '/user') ? 'active':''}}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Manage User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('user.view')}}"><i class="ti-more"></i>View</a></li>
            <li><a href="{{route('user.add')}}"><i class="ti-more"></i>Add</a></li>
          </ul>
        </li> 
		  
        @endif
        <li class="treeview {{ ($prefix == '/profile') ? 'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
            <li><a href="{{route('password.view')}}"><i class="ti-more"></i>Change Password</a></li>
          </ul>
        </li>
		
        <li class="treeview {{ ($prefix == '/setups') ? 'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Setup Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('student_class.view') }}"><i class="ti-more"></i>Student Class</a></li>
            <li><a href="{{ route('student_year.view') }}"><i class="ti-more"></i>Student Year</a></li>
            <li><a href="{{ route('student_group.view') }}"><i class="ti-more"></i>Student Group</a></li>
            <li><a href="{{ route('student_shift.view') }}"><i class="ti-more"></i>Student Shift</a></li>
            <li><a href="{{ route('fee_category.view') }}"><i class="ti-more"></i>Fee Category</a></li>
            <li><a href="{{ route('fee_amount.view') }}"><i class="ti-more"></i>Fee Category Amount</a></li>
            <li><a href="{{ route('exam_type.index') }}"><i class="ti-more"></i>Exam Type</a></li>
            <li><a href="{{ route('school_subject.index') }}"><i class="ti-more"></i>School Subject</a></li>
            <li><a href="{{ route('assign_subject.index') }}"><i class="ti-more"></i>Assign Subject</a></li>
            <li><a href="{{ route('designation.index') }}"><i class="ti-more"></i>Designation</a></li>

          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/students') ? 'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('student_registration.index') }}"><i class="ti-more"></i>Student Registration</a></li>

            <li><a href="{{ route('roll_generate.index') }}"><i class="ti-more"></i>Roll Generate</a></li>

            <li><a href="{{ route('reg_fee.index') }}"><i class="ti-more"></i>Registration Fee</a></li>
            <li><a href="{{ route('monthly_fee.index') }}"><i class="ti-more"></i>Monthly Fee</a></li>
            <li><a href="{{ route('exam_fee.index') }}"><i class="ti-more"></i>Exam Fee</a></li>
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/student') ? 'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('student_registration.index') }}"><i class="ti-more"></i>Student Registration</a></li>

            <li><a href="{{ route('roll_generate.index') }}"><i class="ti-more"></i>Roll Generate</a></li>

            <li><a href="{{ route('reg_fee.index') }}"><i class="ti-more"></i>Registration Fee</a></li>
            <li><a href="{{ route('monthly_fee.index') }}"><i class="ti-more"></i>Monthly Fee</a></li>
            <li><a href="{{ route('exam_fee.index') }}"><i class="ti-more"></i>Exam Fee</a></li>
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/employee') ? 'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Employee Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route == 'employee.reg.index') ? 'active': ''}}" ><a href="{{ route('employee.reg.index') }}"><i class="ti-more"></i>Employee Registration</a></li>
            <li class="{{($route == 'employee.salary.index') ? 'active': ''}}"><a href="{{ route('employee.salary.index') }}"><i class="ti-more"></i>Employee Salary</a></li>
            <li class="{{($route == 'employee.leave.index') ? 'active': ''}}"><a href="{{ route('employee.leave.index') }}"><i class="ti-more"></i>Employee Leave</a></li>
            <li class="{{($route == 'employee.attendance.index') ? 'active': ''}}"><a href="{{ route('employee.attendance.index') }}"><i class="ti-more"></i>Employee Attendance</a></li>
            <li class="{{($route == 'employee.monthly_salary.index') ? 'active': ''}}"><a href="{{ route('employee.monthly_salary.index') }}"><i class="ti-more"></i>Employee Monthly Salary</a></li>

            
          </ul>
        </li>
    
        <li class="treeview {{ ($prefix == '/mark') ? 'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Marks Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route == 'marks.entry.create') ? 'active': ''}}"><a href="{{ route('marks.entry.create') }}"><i class="ti-more"></i>Marks Entry</a></li>
            <li class="{{($route == 'marks.entry.edit') ? 'active': ''}}"><a href="{{ route('marks.entry.edit') }}"><i class="ti-more"></i>Marks Edit</a></li>
            <li class="{{($route == 'marks_entry.grade.index') ? 'active': ''}}"><a href="{{ route('marks_entry.grade.index') }}"><i class="ti-more"></i>Marks Grade</a></li>

            
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/accounts') ? 'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Accounts Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route == 'student_fee.index') ? 'active': ''}}"><a href="{{ route('student_fee.index') }}"><i class="ti-more"></i>Student Fee</a></li>
            <li class="{{($route == 'account.salary.index') ? 'active': ''}}"><a href="{{ route('account.salary.index') }}"><i class="ti-more"></i>Employee Salary</a></li>
            <li class="{{($route == 'other_cost.index') ? 'active': ''}}"><a href="{{ route('other_cost.index') }}"><i class="ti-more"></i>Other Cost</a></li>

            
          </ul>
        </li>

		 
        <li class="header nav-small-cap">Report Interface</li>
		  
        <li class="treeview {{ ($prefix == '/reports') ? 'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Reports Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route == 'monthly_profit.index') ? 'active': ''}}"><a href="{{ route('monthly_profit.index') }}"><i class="ti-more"></i>Monthly/Yearly Profit</a></li>

            <li class="{{($route == 'marksheet_generate.index') ? 'active': ''}}"><a href="{{ route('marksheet_generate.index') }}"><i class="ti-more"></i>Marksheet Genrate</a></li>

            <li class="{{($route == 'attendance_report.index') ? 'active': ''}}"><a href="{{ route('attendance_report.index') }}"><i class="ti-more"></i>Attendance Report</a></li>

            <li class="{{($route == 'student_result.index') ? 'active': ''}}"><a href="{{ route('student_result.index') }}"><i class="ti-more"></i>Student Result</a></li>

            <li class="{{($route == 'student_id_card.index') ? 'active': ''}}"><a href="{{ route('student_id_card.index') }}"><i class="ti-more"></i>Student Id Card</a></li>
         

            
          </ul>
        </li>
		
		
        
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>