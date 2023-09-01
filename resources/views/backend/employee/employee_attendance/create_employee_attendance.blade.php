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
								<li class="breadcrumb-item active" aria-current="page">employee attendance</li>
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
                 <h4 class="box-title">Insert Employee Attendance</h4>
                
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                <form method="post" action="{{route('employee.attendance.store')}}">
                        @csrf

                    <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <h5>Attendance Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" required> 
                                    </div>
                                </div>

                            </div> <!-- end col-md-6 -->

                    </div> <!-- end row -->

                    <div class="row">

                        <div class="col-md-12">
                           <table class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">SI</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">Employee List</th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle;width:30%">Attendance Status</th>
                                </tr>
                                <tr>
                                    <th class="text-center btn present_all" style="display: table-cell;background-color: green">Present</th>
                                    <th class="text-center btn leave_all" style="display: table-cell;background-color: yellow;color:black">Leave</th>
                                    <th class="text-center btn absent_all" style="display: table-cell;background-color: red">Absent</th>
                                </tr>

                            </thead>
            <tbody>
                @foreach ($employees as $key => $value)
                    
            <tr id="div{{$value->id}}" class="text-center">
                <input type="hidden" name="employee_id[]" value="{{$value->id}}">
                <td>{{$key+1}}</td>  
                <td>{{$value['name']}}</td>  
                <td colspan="3">
                    <div class="switch-toggle switch-3 switch-candy text-center">
                        <input name="attend_status{{$key}}" value="present" type="radio" id="present{{$key}}" checked>
                        <label for="present{{$key}}">present</label>

                        <input name="attend_status{{$key}}" value="leave" type="radio" id="leave{{$key}}">
                        <label for="leave{{$key}}">leave</label>

                        <input name="attend_status{{$key}}" value="absent" type="radio" id="absent{{$key}}">
                        <label for="absent{{$key}}">absent</label>
                    </div>  
                </td>  
            </tr>
            @endforeach

            </tbody>
                        </table>
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