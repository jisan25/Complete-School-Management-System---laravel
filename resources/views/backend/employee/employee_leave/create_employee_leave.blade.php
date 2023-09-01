@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="content-wrapper">
    <div class="container-full">

        {{-- Section Header --}}

        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Setup Management</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">D-PathShala</li>
								<li class="breadcrumb-item active" aria-current="page">employee leave</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

        {{-- end section header --}}

       
        <section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title">Employee Leave</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                <form method="post" action="{{route('employee.leave.store')}}">
                        @csrf

                    <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Employee Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="employee_id" id="employee_id" required class="form-control">
                                            <option selected disabled >Select Employee</option>
                                            @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                           
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- end col-md-6 -->

                            <div class="col-md-6">

                                <div class="form-group">
                                    <h5>Start Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="start_date" class="form-control" required> 
                                    </div>
                                </div>

                            </div> <!-- end col-md-6 -->

                    </div> <!-- end row -->

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Leave Purpose <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="leave_purpose_id" id="leave_purpose_id" required class="form-control">
                                        <option selected disabled >Select Leave Reason</option>
                                        @foreach ($purposes as $purpose)
                                        <option value="{{$purpose->id}}">{{$purpose->name}}</option>
                                        @endforeach
                                        <option value="0">New Purpose</option>
                                       
                                    </select>
                                    <input type="text" name="name" id="add_another" class="form-control" placeholder="Write Purpose" style="display: none">
                                </div>
                            </div>
                        </div> <!-- end col-md-6 -->

                        <div class="col-md-6">

                            <div class="form-group">
                                <h5>End Date <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="end_date" class="form-control" required> 
                                </div>
                            </div>

                        </div> <!-- end col-md-6 -->

                </div> <!-- end row -->


                                

                 				
                            
                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info" value="submit"/>
                           </div>
                       </form>
   
                   </div>
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
   
           </section>


    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '#leave_purpose_id',function(){
            var leave_purpose_id = $(this).val();
            if(leave_purpose_id == '0'){
                $('#add_another').show();
            }else{
                $('#add_another').hide();
            }
        })
    });
</script>

@endsection